<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserHierarchy;



class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role->name;
        $subordinates = $user->subordinates()->with('user')->get();
        $userHierarchy = UserHierarchy::where('subordinate_id', $user->id)->first();
        $supervisor = $userHierarchy ? $userHierarchy->supervisor : null;
    
            switch ($role) {
                case 'Direktur':
                    return view('dashboard.directur', compact('user','subordinates'));
                case 'Manager':
                    return view('dashboard.manager', compact('user', 'subordinates'));
                case 'Staff':
                    return view('dashboard.employee', compact('user','supervisor'));
                default:
                    return redirect('/');
            }
            
        }
    
}
