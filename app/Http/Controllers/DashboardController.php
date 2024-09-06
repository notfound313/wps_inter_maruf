<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role->name;
    
            switch ($role) {
                case 'Direktur':
                    return view('dashboard.directur', compact('user'));
                case 'Manager':
                    return view('dashboard.employee', compact('user'));
                case 'Staff':
                    return view('dashboard.employee', compact('user'));
                default:
                    return redirect('/');
            }
            
        }
    
}
