<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyLog;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class LogVerificationController extends Controller
{
    public function index()
    {    
        $user = Auth::user();    
        $role = $user->role->name;
        $subordinates = $user->subordinates()->with('user')->get();
        $logs = DailyLog::where('status_id', 1)
        ->whereIn('user_id', $subordinates->pluck('user.id'))
        ->get();
        return view('dashboard\verification\log-verification', [
            'logs' => $logs,
            'statuses' => Status::all()
        ]);
    }
    
    public function getRejectedLogs()
    {
        $user = Auth::user();    
        $role = $user->role->name;
        $subordinates = $user->subordinates()->with('user')->get();
        $rejectedLogs = DailyLog::where('status_id', 3)
        ->whereIn('user_id', $subordinates->pluck('user.id'))
        ->get(); 
        return view('dashboard\verification\log-verification', [
            'logs' => $rejectedLogs,
            'statuses' => Status::all()
        ]);
    }     
    
    public function getAcceptedLogs()
    {
        $user = Auth::user();    
        $role = $user->role->name;
        $subordinates = $user->subordinates()->with('user')->get();
        $acceptedLogs = DailyLog::where('status_id', 2)
        ->whereIn('user_id', $subordinates->pluck('user.id'))
        ->get(); 
        return view('dashboard\verification\log-verification', [
            'logs' => $acceptedLogs,
            'statuses' => Status::all()
        ]);
    }
    

    public function update(Request $request, DailyLog $log)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $log->update([
            'status_id' => $request->status_id,
        ]);

        return redirect()->route('log-verification.index')->with('success', 'Log status has been updated successfully.');
    }
    // craete api
    public function getEmployeeLogs()
        {
            $user = Auth::user();    
            if (!$user->role) {
                return response()->json([
                    'success' => false,
                    'message' => 'User role not found'
                ], 404);
            }
            $role = $user->role->name;
            $subordinates = $user->subordinates()->with('user')->get();
            $logs = DailyLog::where('status_id', 1)
            ->whereIn('user_id', $subordinates->pluck('user.id'))
            ->get();
    
            $formattedLogs = $logs->map(function ($log) {
                return [
                    'title' => $log->name,
                    'start' => $log->date, 
                    'end' => $log->date,
                    'description' => $log->description
                ];
            });
        
            return response()->json([
                'success' => true,
                'data' => $formattedLogs
            ]);
            }
    
}
