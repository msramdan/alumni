<?php

namespace App\Http\Controllers\LandingWeb;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\AduanNotificationMail;
use Illuminate\Support\Facades\Mail;


class LandingWebController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

}
