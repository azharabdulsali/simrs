<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $totalAppointments = Appointment::count();

        $recentPatients = Patient::latest()->limit(5)->get();
        $recentDoctors = Doctor::latest()->limit(5)->get();
        $recentAppointments = Appointment::with(['patient','doctor'])->latest()->limit(6)->get();

        $start = Carbon::now()->subDays(6)->startOfDay();
        $appointmentsByDay = Appointment::where('scheduled_at', '>=', $start)
            ->selectRaw("DATE(scheduled_at) as date, count(*) as count")
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        $labels = [];
        $data = [];
        for ($i = 0; $i < 7; $i++) {
            $d = $start->copy()->addDays($i);
            $labels[] = $d->format('M d');
            $data[] = $appointmentsByDay->get($d->toDateString(), 0);
        }

        return view('dashboard', compact(
            'totalPatients',
            'totalDoctors',
            'totalAppointments',
            'recentPatients',
            'recentDoctors',
            'recentAppointments',
            'labels',
            'data'
        ));
    }
}
