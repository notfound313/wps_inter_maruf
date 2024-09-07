<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyLog;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;



class DailyLogController extends Controller
{
    public function index()
    {
        $logs = DailyLog::where('user_id', Auth::id())->get();
        return view('dashboard.log.dailylog', [
            'logs' => $logs,
            'statuses' => Status::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'description' => 'required|string',
        ]);

        DailyLog::updateOrCreate(
            ['user_id' => Auth::id(), 'date' => $request->date],
            [
                'description' => $request->description,
                'status_id' => 1 // Default to 'Pending'
            ]
        );

        return redirect()->route('log/daily-log')->with('success', 'Log has been saved successfully.');
    }

    public function updateStatus(Request $request, DailyLog $log)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $log->update([
            'status_id' => $request->status_id,
        ]);

        return redirect()->route('log/daily-log')->with('success', 'Status has been updated successfully.');
    }
}
