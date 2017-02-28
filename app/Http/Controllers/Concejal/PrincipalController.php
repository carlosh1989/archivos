<?php

namespace App\Http\Controllers\Concejal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrincipalController extends Controller
{
    public function __construct()
    {
        define('COUNCILORID', Auth::user()->councilor_id);
    }
    
    public function index()
    {
    	return view('concejal.home.inicio');
    }
}
