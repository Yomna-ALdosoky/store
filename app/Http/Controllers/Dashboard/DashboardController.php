<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index() {
        
        $title= 'store';

        $user= Auth::user();

        return view('dashboard.index', [
            'user'  =>'yomna',
            'title' =>$title
        ]);
    }
}
