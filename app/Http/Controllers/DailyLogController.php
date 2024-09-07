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

            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        DailyLog::updateOrCreate(

            ['user_id' => Auth::id(), 'start_date' => $request->start_date, 'end_date' => $request->end_date],
            [
                'title' => $request->title,
                'description' => $request->description,
                'status_id' => 1 //default for ech input data
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
    
        public function getLogById(Request $request)
        {
            $log = DailyLog::findOrFail($request->id);
            return response()->json($log);
        }
    
}
