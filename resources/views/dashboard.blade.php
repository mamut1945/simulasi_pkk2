<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="max-w-7xl mx-auto p-4">

    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

    <!-- Total Kamar -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 rounded shadow text-center">
            <h2 class="text-lg font-semibold">Total Kamar</h2>
            <p class="text-2xl font-bold">{{ $totalKamar }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <h2 class="text-lg font-semibold">Kamar Tersedia</h2>
            <p class="text-2xl font-bold">{{ $totalKamarTersedia }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <h2 class="text-lg font-semibold">Kamar Tidak Tersedia</h2>
            <p class="text-2xl font-bold">{{ $totalKamarTidakTersedia }}</p>
        </div>
    </div>

    <!-- Total Reservasi -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-4 rounded shadow text-center">
            <h2 class="text-lg font-semibold">Total Reservasi</h2>
            <p class="text-2xl font-bold">{{ $totalReservasi }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <h2 class="text-lg font-semibold">Booking</h2>
            <p class="text-2xl font-bold">{{ $totalBooking }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <h2 class="text-lg font-semibold">Check-in</h2>
            <p class="text-2xl font-bold">{{ $totalCheckin }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <h2 class="text-lg font-semibold">Selesai</h2>
            <p class="text-2xl font-bold">{{ $totalSelesai }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow text-center">
            <h2 class="text-lg font-semibold">Batal</h2>
            <p class="text-2xl font-bold">{{ $totalBatal }}</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const kamarChart = new Chart(document.getElementById('chart-kamar'), {
        type: 'doughnut',
        data: {
            labels: ['Tersedia', 'Tidak Tersedia'],
            datasets: [{
                label: 'Status Kamar',
                data: [{{ $totalKamarTersedia }}, {{ $totalKamarTidakTersedia }}],
                backgroundColor: ['#10B981', '#EF4444']
            }]
        },
    });

    const reservasiChart = new Chart(document.getElementById('chart-reservasi'), {
        type: 'doughnut',
        data: {
            labels: ['Booking', 'Check-in', 'Selesai', 'Batal'],
            datasets: [{
                label: 'Status Reservasi',
                data: [{{ $totalBooking }}, {{ $totalCheckin }}, {{ $totalSelesai }}, {{ $totalBatal }}],
                backgroundColor: ['#3B82F6', '#FBBF24', '#10B981', '#EF4444']
            }]
        },
    });
</script>

</x-app-layout>
