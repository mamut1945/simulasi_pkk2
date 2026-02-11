<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="bg-white rounded-2xl p-6 shadow-sm max-w-xl mx-auto">
        <h3 class="text-lg font-semibold mb-6">Form Reservasi</h3>

        <form action="{{ route('reservasi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">

            <div class="mb-4">
                <label>Tipe Kamar</label>
                <input type="text" value="{{ $kamar->tipe }}" readonly
                       class="w-full border px-3 py-2 bg-gray-100 rounded-lg">
            </div>

            <div class="mb-4">
                <label>Harga / Malam</label>
                <input type="text" value="Rp {{ number_format($kamar->harga,0,',','.') }}" readonly
                       class="w-full border px-3 py-2 bg-gray-100 rounded-lg">
            </div>

            <div class="mb-4">
                <label>Nama Tamu</label>
                <input type="text" name="nama_tamu" required
                       class="w-full border px-3 py-2 rounded-lg">
            </div>

            <div class="mb-4">
                <label>No HP</label>
                <input type="text" name="no_hp" required
                       class="w-full border px-3 py-2 rounded-lg">
            </div>

            <div class="mb-4">
                <label>Check-in</label>
                <input type="date" name="check_in" id="check_in" required
                       class="w-full border px-3 py-2 rounded-lg">
            </div>

            <div class="mb-4">
                <label>Check-out</label>
                <input type="date" name="check_out" id="check_out" required
                       class="w-full border px-3 py-2 rounded-lg">
            </div>

            <div class="mb-4">
                <label>Jumlah Tamu</label>
                <input type="number" name="jumlah_tamu" min="1" required
                       class="w-full border px-3 py-2 rounded-lg">
            </div>

            <div class="mb-4">
                <label>Estimasi Total Bayar</label>
                <input type="text" id="total_preview" readonly
                       class="w-full border px-3 py-2 bg-gray-100 rounded-lg">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">
                Reservasi Sekarang
            </button>
        </form>
    </div>

    <script>
        const harga = {{ $kamar->harga }};
        const checkIn = document.getElementById('check_in');
        const checkOut = document.getElementById('check_out');
        const totalPreview = document.getElementById('total_preview');

        function hitungTotal() {
            if(checkIn.value && checkOut.value){
                const tglIn = new Date(checkIn.value);
                const tglOut = new Date(checkOut.value);
                const diffDays = (tglOut - tglIn)/(1000*60*60*24);
                totalPreview.value = diffDays>0 ? "Rp "+(diffDays*harga).toLocaleString('id-ID') : "";
            }
        }

        checkIn.addEventListener('change', hitungTotal);
        checkOut.addEventListener('change', hitungTotal);
    </script>
</x-app-layout>
