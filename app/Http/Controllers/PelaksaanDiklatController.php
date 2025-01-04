<?php

namespace App\Http\Controllers;

use App\Models\PelaksaanDiklat;
use App\Http\Requests\{StorePelaksaanDiklatRequest, UpdatePelaksaanDiklatRequest};
use App\Models\Diklat;
use Yajra\DataTables\Facades\DataTables;

class PelaksaanDiklatController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pelaksaan diklat view')->only('index', 'show');
        $this->middleware('permission:pelaksaan diklat create')->only('create', 'store');
        $this->middleware('permission:pelaksaan diklat edit')->only('edit', 'update');
        $this->middleware('permission:pelaksaan diklat delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $pelaksaanDiklats = PelaksaanDiklat::with('diklat:id,nama_diklat');

            return DataTables::of($pelaksaanDiklats)
                ->addColumn('diklat', function ($row) {
                    return $row->diklat ? $row->diklat->nama_diklat : '';
                })->addColumn('action', 'pelaksaan-diklats.include.action')
                ->toJson();
        }

        return view('pelaksaan-diklats.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil data diklats dari database
        $diklats = Diklat::all();

        return view('pelaksaan-diklats.create', compact('diklats'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePelaksaanDiklatRequest $request)
    {

        PelaksaanDiklat::create($request->validated());

        return redirect()
            ->route('pelaksaan-diklats.index')
            ->with('success', __('The pelaksaanDiklat was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PelaksaanDiklat  $pelaksaanDiklat
     * @return \Illuminate\Http\Response
     */
    public function show(PelaksaanDiklat $pelaksaanDiklat)
    {
        $pelaksaanDiklat->load('diklat:id,nama_diklat');

        return view('pelaksaan-diklats.show', compact('pelaksaanDiklat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PelaksaanDiklat  $pelaksaanDiklat
     * @return \Illuminate\Http\Response
     */
    public function edit(PelaksaanDiklat $pelaksaanDiklat)
    {
        $pelaksaanDiklat->load('diklat:id,nama_diklat');
        $diklats = Diklat::all();
        return view('pelaksaan-diklats.edit', compact('pelaksaanDiklat', 'diklats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PelaksaanDiklat  $pelaksaanDiklat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePelaksaanDiklatRequest $request, PelaksaanDiklat $pelaksaanDiklat)
    {

        $pelaksaanDiklat->update($request->validated());

        return redirect()
            ->route('pelaksaan-diklats.index')
            ->with('success', __('The pelaksaanDiklat was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PelaksaanDiklat  $pelaksaanDiklat
     * @return \Illuminate\Http\Response
     */
    public function destroy(PelaksaanDiklat $pelaksaanDiklat)
    {
        try {
            $pelaksaanDiklat->delete();

            return redirect()
                ->route('pelaksaan-diklats.index')
                ->with('success', __('The pelaksaanDiklat was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('pelaksaan-diklats.index')
                ->with('error', __("The pelaksaanDiklat can't be deleted because it's related to another table."));
        }
    }
}
