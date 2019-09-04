<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Quotation;

class BerandaController extends Controller
{
    public function index()
    {
        $blog = DB::table('users')->get();
        
        return view('beranda');
    }
}
