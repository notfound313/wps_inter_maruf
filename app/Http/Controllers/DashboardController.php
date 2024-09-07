<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserHierarchy;
use App\Models\DailyLog;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role->name;
        $subordinates = $user->subordinates()->with('user')->get();
        $userHierarchy = UserHierarchy::where('subordinate_id', $user->id)->first();
        $supervisor = $userHierarchy ? $userHierarchy->supervisor : null;
        
        $logs = DailyLog::where('status_id', 1)
        ->whereIn('user_id', $subordinates->pluck('user.id'))
        ->get();

        $formattedLogs = $logs->map(function ($log) {
            return [
                'title' => $log->title ?? 'No data',
                'start' => $log->start_date?? 'No start date', 
                'end' => $log->end_date ?? 'No data',
                'description' => $log->description ?? 'No data'
            ];
        });
    
            switch ($role) {
                case 'Direktur':
                    return view('dashboard.directur', compact('user','subordinates','formattedLogs'));
                case 'Manager':
                    return view('dashboard.manager', compact('user', 'subordinates','formattedLogs'));
                case 'Staff':
                    return view('dashboard.employee', compact('user','supervisor'));
                default:
                    return redirect('/');
            }
            
        }
    
}
