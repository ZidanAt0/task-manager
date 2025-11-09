<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $schedules = Schedule::orderBy('deadline')->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'deadline_date' => 'required|date',
            'deadline_time' => 'required',
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $deadline = Carbon::parse($request->deadline_date . ' ' . $request->deadline_time);

        Schedule::create([
            'title' => $request->title,
            'course_name' => $request->course_name,
            'description' => $request->description,
            'deadline' => $deadline,
            'status' => $request->status,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'deadline_date' => 'required|date',
            'deadline_time' => 'required',
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $deadline = Carbon::parse($request->deadline_date . ' ' . $request->deadline_time);

        $schedule->update([
            'title' => $request->title,
            'course_name' => $request->course_name,
            'description' => $request->description,
            'deadline' => $deadline,
            'status' => $request->status,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
