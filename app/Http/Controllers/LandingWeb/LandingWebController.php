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

    public function detail()
    {
        return view('frontend.detail');
    }

}
