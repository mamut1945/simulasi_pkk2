<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold">Riwayat Reservasi</h3>
            <div class="flex space-x-2">
                {{-- Contoh tombol tambah reservasi, kalau mau --}}
                {{-- <a href="{{ route('reservasi.create') }}">
                    <button class="p-2 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </button>
                </a> --}}
            </div>
            <div class="mb-4">
    <form action="{{ route('reservasi.riwayat') }}" method="GET">
        <input type="text" name="search" placeholder="Cari nama tamu, nomor kamar atau tipe..." 
               value="{{ $search ?? '' }}" 
               class="border rounded p-2 w-full md:w-1/3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 ml-2">
            Cari
        </button>
    </form>
</div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-3 text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="pb-3 text-xs font-medium text-gray-500 uppercase">Nama Tamu</th>
                        <th class="pb-3 text-xs font-medium text-gray-500 uppercase">No Kamar</th>
                        <th class="pb-3 text-xs font-medium text-gray-500 uppercase">Check In</th>
                        <th class="pb-3 text-xs font-medium text-gray-500 uppercase">Check Out</th>
                        <th class="pb-3 text-xs font-medium text-gray-500 uppercase">Total Bayar</th>
                        <th class="pb-3 text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservasis as $r)
                        <tr class="border-b border-gray-100">
                            <td class="py-4 text-sm text-gray-600">{{ $r->id }}</td>
                            <td class="py-4 text-sm text-gray-600">{{ $r->nama_tamu }}</td>
                            <td class="py-4 text-sm text-gray-600">{{ $r->kamar->no_kamar }}</td>
                            <td class="py-4 text-sm text-gray-600">{{ $r->check_in }}</td>
                            <td class="py-4 text-sm text-gray-600">{{ $r->check_out }}</td>
<td>
    Rp {{ number_format(abs($r->total_bayar), 0, ',', '.') }}
</td>
<td class="py-4 text-sm text-gray-600">
    <form action="{{ route('reservasi.updateStatus', $r->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <select name="status_reservasi" onchange="this.form.submit()" class="border rounded p-1 text-sm">
            @foreach(['Booking', 'Check-in', 'Selesai', 'Batal'] as $status)
<option class="
    {{ $status == 'Booking' ? 'bg-blue-100' : '' }}
    {{ $status == 'Check-in' ? 'bg-green-100' : '' }}
    {{ $status == 'Check-out' ? 'bg-gray-100' : '' }}
    {{ $status == 'Cancelled' ? 'bg-red-100' : '' }}
"
value="{{ $status }}" {{ $r->status_reservasi == $status ? 'selected' : '' }}>
    {{ $status }}
</option>
            @endforeach
        </select>
    </form>
</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500">
                                Belum ada reservasi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
