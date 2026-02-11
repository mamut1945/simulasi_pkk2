<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="bg-white rounded-2xl shadow-sm">
                <form action="{{ route('kamar.store') }}" method="POST" class="p-8">
                    @csrf
                    <div class="mb-10">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br bg-black rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900">Case Information</h2>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Kamar</label>
                                <input type="number" name="no_kamar"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 transition"
                                    placeholder="10">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                                <select name="tipe"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 transition bg-white">
                                @foreach ($tipe as $t)
                                <option value="{{ $t }}">{{ $t }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                                <input type="text" name="harga" id="harga" 
                                    value="{{ old('harga', $kamar->harga ?? '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    placeholder="200000">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">status</label>
                                <select name="status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 transition bg-white">
                                @foreach ($statuses as $s)
                                <option value="{{ $s }}">{{ $s }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-8 mt-8 border-t border-gray-200">
                        <div></div>
                        <div class="flex space-x-3">
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r bg-black text-white rounded-lg font-medium transition hover:bg-gray-600">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
</x-app-layout>
