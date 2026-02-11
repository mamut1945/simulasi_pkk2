<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Kamar') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-2xl shadow-sm">
        <form action="{{ route('kamar.update', $kamar->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div class="mb-10">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Edit Kamar</h2>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    {{-- Nomor Kamar --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Kamar</label>
                        <input type="number" name="no_kamar"
                            value="{{ old('no_kamar', $kamar->no_kamar) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 transition">
                    </div>

                    {{-- Tipe --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                        <select name="tipe"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white">
                            @foreach ($tipe as $t)
                                <option value="{{ $t }}" {{ $kamar->tipe == $t ? 'selected' : '' }}>
                                    {{ $t }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Harga --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                            <input type="text" name="harga" id="harga" 
           value="{{ old('harga', $kamar->harga ?? '') }}"
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
           placeholder="200.000">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white">
                            @foreach ($statuses as $s)
                                <option value="{{ $s }}" {{ $kamar->status == $s ? 'selected' : '' }}>
                                    {{ $s }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-8 border-t">
                <button type="submit"
                    class="px-8 py-3 bg-black text-white rounded-lg font-medium hover:bg-gray-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
