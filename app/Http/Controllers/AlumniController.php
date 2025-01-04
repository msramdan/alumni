<?php

namespace App\Http\Controllers;

use App\Models\alumni;
use App\Http\Requests\{StorealumniRequest, UpdatealumniRequest};
use App\Models\PelaksaanDiklat;
use Yajra\DataTables\Facades\DataTables;
use Image;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlumniExport;
use App\FormatImport\GenerateAlumniMultiSheet;
use App\Imports\ImportAlumniMultiSheet;
use Illuminate\Support\Facades\DB;


class AlumniController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:alumni view')->only('index', 'show');
        $this->middleware('permission:alumni create')->only('create', 'store');
        $this->middleware('permission:alumni edit')->only('edit', 'update');
        $this->middleware('permission:alumni delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            // Query the alumni data and add order by no_absen
            $alumni = DB::table('alumni')
                ->leftJoin('pelaksaan_diklats', 'alumni.pelaksaan_diklat_id', '=', 'pelaksaan_diklats.id')
                ->select(
                    'alumni.*',
                    'pelaksaan_diklats.judul_diklat'
                )
                ->orderBy('alumni.no_reg', 'asc');  // Add order by 'no_absen'

            return Datatables::of($alumni)
                ->addIndexColumn()
                ->addColumn('judul_diklat', function ($row) {
                    return $row->judul_diklat ?? '';
                })
                ->addColumn('photo', function ($row) {
                    if ($row->photo == null) {
                        return 'https://via.placeholder.com/350?text=No+Image+Available';
                    }
                    return asset('uploads/photos/' . $row->photo);
                })
                ->addColumn('action', 'alumni.include.action')
                ->toJson();
        }

        return view('alumni.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelaksaanDiklats = PelaksaanDiklat::all();
        return view('alumni.create', compact('pelaksaanDiklats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorealumniRequest $request)
    {
        $attr = $request->validated();

        if ($request->file('photo') && $request->file('photo')->isValid()) {

            $path = public_path('uploads/photos/');
            $filename = $request->file('photo')->hashName();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            Image::make($request->file('photo')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            $attr['photo'] = $filename;
        }

        alumni::create($attr);

        return redirect()
            ->route('alumni.index')
            ->with('success', __('The alumni was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\alumni $alumni
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumni = DB::table('alumni')
            ->leftJoin('pelaksaan_diklats', 'alumni.pelaksaan_diklat_id', '=', 'pelaksaan_diklats.id')
            ->select(
                'alumni.*',
                'pelaksaan_diklats.judul_diklat'
            )
            ->where('alumni.id', $id) // Add where condition for the specific alumni id
            ->first(); // Use first() to get a single result

        return view('alumni.show', compact('alumni'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\alumni $alumni
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        $pelaksaanDiklats = PelaksaanDiklat::all();
        return view('alumni.edit', compact('alumni', 'pelaksaanDiklats'));
    }

    public function update(Request $request, $id)
    {
        // Mendapatkan alumni berdasarkan ID yang dikirimkan
        $alumni = Alumni::findOrFail($id);

        // Validasi input secara langsung di controller
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'no_absen' => 'required|numeric',
            'no_reg' => 'required|numeric|unique:alumni,no_reg,' . $id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'photo' => 'nullable|image|max:4024',
            'pelaksaan_diklat_id' => 'nullable|exists:pelaksaan_diklats,id',
        ]);

        // Mengecek jika ada file foto yang di-upload dan valid
        if ($request->file('photo') && $request->file('photo')->isValid()) {
            $path = public_path('uploads/photos/');
            $filename = $request->file('photo')->hashName();

            // Membuat folder jika belum ada
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Mengubah ukuran gambar dengan menggunakan Intervention Image
            Image::make($request->file('photo')->getRealPath())->resize(500, 500, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->save($path . $filename);

            // Menghapus foto lama jika ada
            if ($alumni->photo && file_exists($path . $alumni->photo)) {
                unlink($path . $alumni->photo);
            }

            // Menambahkan nama file baru ke dalam data yang akan di-update
            $validatedData['photo'] = $filename;
        }

        // Melakukan update pada data alumni
        $alumni->update($validatedData);

        // Redirect ke halaman index alumni dengan pesan sukses
        return redirect()
            ->route('alumni.index')
            ->with('success', __('The alumni was updated successfully.'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\alumni $alumni
     * @return \Illuminate\Http\Response
     */
    public function destroy(alumni $alumni)
    {
        try {
            $path = public_path('uploads/photos/');

            if ($alumni->photo != null && file_exists($path . $alumni->photo)) {
                unlink($path . $alumni->photo);
            }

            $alumni->delete();

            return redirect()
                ->route('alumni.index')
                ->with('success', __('The alumni was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('alumni.index')
                ->with('error', __("The alumni can't be deleted because it's related to another table."));
        }
    }

    public function exportData()
    {
        return Excel::download(new AlumniExport, 'alumni_data.xlsx');
    }

    public function formatData()
    {
        return Excel::download(new GenerateAlumniMultiSheet(), 'format_import_alumni.xlsx');
    }

    public function importData(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new ImportAlumniMultiSheet, $request->file('file'));

            return redirect()
                ->route('alumni.index')
                ->with('success', __('Alumni data imported successfully.'));
        } catch (\Exception $e) {
            return redirect()
                ->route('alumni.index')
                ->with('error', __('There was an error importing the alumni data: ') . $e->getMessage());
        }
    }
}
