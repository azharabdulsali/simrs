<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard Rumah Sakit</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <div class="text-sm text-gray-500">Total Patients</div>
                <div class="text-2xl font-semibold">{{ $totalPatients ?? 0 }}</div>
                <a href="{{ route('patients.index') }}" class="text-indigo-600 text-sm">Manage Patients</a>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <div class="text-sm text-gray-500">Total Doctors</div>
                <div class="text-2xl font-semibold">{{ $totalDoctors ?? 0 }}</div>
                <a href="{{ route('doctors.index') }}" class="text-indigo-600 text-sm">Manage Doctors</a>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <div class="text-sm text-gray-500">Total Appointments</div>
                <div class="text-2xl font-semibold">{{ $totalAppointments ?? 0 }}</div>
                <a href="{{ route('appointments.index') }}" class="text-indigo-600 text-sm">Manage Appointments</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="font-semibold mb-2">Grafik Janji Temu (7 hari terakhir)</h2>
                <div style="height:220px;">
                    <canvas id="appointmentsChart" height="150"></canvas>
                </div>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h2 class="font-semibold mb-2">Recent Activity</h2>

                <div class="mb-4">
                    <h3 class="font-medium">Recent Patients</h3>
                    <ul class="list-disc ps-5">
                        @if(!empty($recentPatients))
                            @foreach($recentPatients as $p)
                                <li class="py-1"><a href="{{ route('patients.show', $p) }}" class="text-indigo-600">{{ $p->name }}</a></li>
                            @endforeach
                        @else
                            <li class="py-1 text-gray-500">No patients yet</li>
                        @endif
                    </ul>
                </div>

                <div class="mb-4">
                    <h3 class="font-medium">Recent Doctors</h3>
                    <ul class="list-disc ps-5">
                        @if(!empty($recentDoctors))
                            @foreach($recentDoctors as $d)
                                <li class="py-1"><a href="{{ route('doctors.show', $d) }}" class="text-indigo-600">{{ $d->name }}</a></li>
                            @endforeach
                        @else
                            <li class="py-1 text-gray-500">No doctors yet</li>
                        @endif
                    </ul>
                </div>

                <div>
                    <h3 class="font-medium">Recent Appointments</h3>
                    <ul class="list-disc ps-5">
                        @if(!empty($recentAppointments))
                            @foreach($recentAppointments as $a)
                                <li class="py-1">
                                    <a href="{{ route('appointments.show', $a) }}" class="text-indigo-600">{{ optional($a->scheduled_at)->format('Y-m-d H:i') ?? '-' }} — {{ $a->patient->name ?? '-' }} with {{ $a->doctor->name ?? '-' }}</a>
                                </li>
                            @endforeach
                        @else
                            <li class="py-1 text-gray-500">No appointments yet</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-6 bg-white p-4 rounded shadow">
            <h2 class="font-semibold mb-2">Quick Actions</h2>
            <div class="flex gap-2">
                <a href="{{ route('patients.create') }}" class="px-3 py-2 bg-green-600 text-white rounded">New Patient</a>
                <a href="{{ route('doctors.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">New Doctor</a>
                <a href="{{ route('appointments.create') }}" class="px-3 py-2 bg-indigo-600 text-white rounded">New Appointment</a>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const chartLabels = @json($labels ?? []);
            const chartData = @json($data ?? []);

            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('appointmentsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: 'Appointments',
                            data: chartData,
                            borderColor: 'rgba(59,130,246,1)',
                            backgroundColor: 'rgba(59,130,246,0.2)',
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: { y: { beginAtZero: true } }
                    }
                });
            });
        </script>
    @endpush

</x-app-layout>
