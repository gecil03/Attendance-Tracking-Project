<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function clockIn()
    {
        $userId = Auth::id();
        $attendance = Attendance::create([
            'user_id' => $userId,
            'time_in' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Clocked in successfully!');
    }

    public function clockOut()
    {
        $userId = Auth::id();
        $attendance = Attendance::where('user_id', $userId)
                                ->whereNull('time_out')
                                ->orderBy('time_in', 'desc')
                                ->first();

        if ($attendance) {
            $attendance->update([
                'time_out' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'Clocked out successfully!');
        }

        return redirect()->back()->with('error', 'You need to clock in first!');
    }

    public function index()
    {
        $attendances = Attendance::where('user_id', Auth::id())->get();

        return view('attendance.index', compact('attendances'));
    }
}
