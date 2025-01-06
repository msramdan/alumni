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
            ->paginate(100);
        return view('frontend.list', compact('alumnis'));
    }

    public function detail($randomNoReg, Request $request)
    {
        // Find the alumni by the hashed no_reg
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
            ->whereRaw('substr(md5(alumni.no_reg), 1, 8) = ?', [$randomNoReg])
            ->first();

        if (!$alumni) {
            // Redirect to the 404 Not Found page
            abort(404);
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
                    'url' => route('web.detail', ['randomNoReg' => substr(md5($item->no_absen), 0, 8)])
                ];
            });


            return response()->json(['suggestions' => $suggestions]);
        }
    }
}
