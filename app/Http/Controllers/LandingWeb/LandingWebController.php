<?php

namespace App\Http\Controllers\LandingWeb;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LandingWebController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function list()
    {
        $alumnis = DB::table('alumni')
            ->orderBy('no_absen', 'asc')
            ->paginate(9);
        return view('frontend.list', compact('alumnis'));
    }

    public function detail($randomNoAbsen, Request $request)
    {
        // Find the alumni by the hashed no_absen
        $alumni = DB::table('alumni')
            ->leftJoin('pelaksaan_diklats', 'alumni.pelaksaan_diklat_id', '=', 'pelaksaan_diklats.id')
            ->select(
                'alumni.*',
                'pelaksaan_diklats.judul_diklat',
                'pelaksaan_diklats.angkatan',
                'pelaksaan_diklats.tanggal_mulai',
                'pelaksaan_diklats.tanggal_selesai',
                'pelaksaan_diklats.kota',
                'pelaksaan_diklats.provinsi'
            )
            // Compare the hash of the no_absen field
            ->whereRaw('substr(md5(alumni.no_absen), 1, 8) = ?', [$randomNoAbsen])
            ->first();

        if (!$alumni) {
            // Handle the case where no alumni was found with the provided randomNoAbsen
            return redirect()->route('web.list')->with('error', 'Alumni not found.');
        }

        return view('frontend.detail', compact('alumni'));
    }

    public function search(Request $request)
    {
        if ($request->has('query')) {
            $query = $request->get('query');
            $suggestions = DB::table('alumni')
                ->where('nama', 'like', "%{$query}%")
                ->limit(5)
                ->get(['nama', 'id', 'no_absen']);
            $suggestions = $suggestions->map(function ($item) {
                return [
                    'nama' => $item->nama,
                    'url' => route('web.detail', ['randomNoAbsen' => substr(md5($item->no_absen), 0, 8)])
                ];
            });


            return response()->json(['suggestions' => $suggestions]);
        }
    }
}
