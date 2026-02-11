@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto p-4" x-data="reservasiModal()">

    <div class="flex flex-col lg:flex-row gap-6">
        <div class="flex-1">
            @foreach ($kamars as $kamar)
            <div class="bg-white rounded-lg shadow-sm mb-4 overflow-hidden hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row">
                    <div class="relative w-full md:w-48 h-48">
                        <img src="https://picsum.photos/200/300?random={{ $kamar->id }}"
                             alt="Kamar {{ $kamar->no_kamar }}"
                             class="w-full h-full object-cover">

                        @if($kamar->status == 'Tersedia')
                        <span class="absolute bottom-3 left-3 bg-green-500 text-white px-2 py-1 rounded text-xs font-semibold">
                            Tersedia
                        </span>
                        @else
                        <span class="absolute bottom-3 left-3 bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold">
                            Tidak Tersedia
                        </span>
                        @endif
                    </div>

                    <div class="flex-1 p-4 flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-bold mb-1">Kamar No {{ $kamar->no_kamar }}</h3>
                            <p class="text-sm text-gray-600 mb-2">Tipe: {{ $kamar->tipe }}</p>
                            <div class="text-2xl font-bold text-gray-900 mb-2">
                                Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="text-right">
                            @if($kamar->status == 'Tersedia')
                            <button 
                                @click="openModal({{ $kamar->id }}, {{ $kamar->harga }})"
                                class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                                Pesan Sekarang
                            </button>
                            @else
                            <button disabled
                                class="mt-2 bg-gray-400 text-white px-4 py-2 rounded-lg text-sm cursor-not-allowed">
                                Tidak Tersedia
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div 
            x-show="open"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            x-transition
            @click.away="closeModal()"
        >
            <div class="bg-white w-full max-w-lg rounded-lg p-6 relative">

                <button @click="closeModal()"
                    class="absolute top-3 right-3 text-gray-500 hover:text-black">✕</button>

                <h2 class="text-xl font-bold mb-4">Form Reservasi</h2>

                <form method="POST" action="{{ route('reservasi.store') }}">
                    @csrf
                    <input type="hidden" name="kamar_id" :value="kamarId">

                    <div class="mb-3">
                        <label class="block text-sm">Nama Tamu</label>
                        <input type="text" name="nama_tamu" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm">No HP</label>
                        <input type="text" name="no_hp" class="w-full border rounded p-2" required>
                    </div>

<div class="grid grid-cols-2 gap-3 mb-3">
    <div>
        <label class="block text-sm">Check In</label>
        <input type="date" name="check_in" x-model="checkIn" @change="updateCheckOutMin()" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block text-sm">Check Out</label>
        <input type="date" name="check_out" x-model="checkOut" :min="checkIn" @change="calculateTotal()" class="w-full border rounded p-2" required>
    </div>
</div>

                    <div class="mb-3">
                        <label class="block text-sm">Jumlah Tamu</label>
                        <input type="number" name="jumlah_tamu" min="1" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm">Estimasi Total Bayar</label>
                        <input type="text" readonly :value="!isNaN(total) && total > 0 ? 'Rp ' + total.toLocaleString('id-ID') : ''" 
                               class="w-full border rounded p-2 bg-gray-100">
                    </div>

                    <button type="submit" class="w-full mt-4 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Booking Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function reservasiModal() {
            return {
                open: false,
                kamarId: null,
                harga: 0,
                checkIn: '',
                checkOut: '',
                total: 0,

                openModal(id, harga) {
                    this.kamarId = id;
                    this.harga = harga;
                    this.checkIn = '';
                    this.checkOut = '';
                    this.total = 0;
                    this.open = true;
                },

                closeModal() {
                    this.open = false;
                },

                calculateTotal() {
                    if (this.checkIn && this.checkOut) {
                        // Split tanggal agar aman dari timezone
                        let partsIn = this.checkIn.split('-');
                        let partsOut = this.checkOut.split('-');

                        let inDate = new Date(Date.UTC(partsIn[0], partsIn[1]-1, partsIn[2]));
                        let outDate = new Date(Date.UTC(partsOut[0], partsOut[1]-1, partsOut[2]));

                        if (!isNaN(inDate) && !isNaN(outDate)) {
                            let diff = (outDate - inDate) / (1000*60*60*24);
                            this.total = diff > 0 ? diff * this.harga : 0;
                        } else {
                            this.total = 0;
                        }
                    } else {
                        this.total = 0;
                    }
                }
            }
        }
    </script>

</div>
@endsection
