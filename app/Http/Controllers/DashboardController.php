<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function showDashboard(){
        
        $usercount = User::count();
        $bookcount = Books::count();

        return view('dashboard', compact('usercount', 'bookcount'));
    }
}
