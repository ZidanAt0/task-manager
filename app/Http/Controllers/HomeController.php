<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Tugas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){ $this->middleware('auth'); }

    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $totalCourses = \App\Models\Course::where('user_id',$userId)->count();

        $totalTasks   = \App\Models\Tugas::forUser($userId)->count();
        $doneTasks    = Tugas::forUser($userId)->whereIn('status', ['done','Selesai'])->count();
        $pendingTasks = Tugas::forUser($userId)->whereIn('status', ['pending','Belum Selesai'])->count();
        $progressPercent = $totalTasks ? round($doneTasks / $totalTasks * 100) : 0;

        $dueSoon = Tugas::forUser($userId)
            ->whereIn('status', ['pending','Belum Selesai'])
            ->whereBetween('deadline', [now(), now()->addDays(7)])
            ->with('course')->orderBy('deadline')->take(5)->get();

        $overdue = Tugas::forUser($userId)
            ->whereNotIn('status', ['done','Selesai'])
            ->where('deadline','<', now())
            ->with('course')->orderBy('deadline')->take(5)->get();

        $recent = \App\Models\Tugas::forUser($userId)
            ->with('course')->latest()->take(5)->get();


        return view('home', compact(
            'totalCourses','totalTasks','doneTasks','pendingTasks',
            'progressPercent','dueSoon','overdue','recent'
        ))->with('title','Home • CTM');
    }
}
