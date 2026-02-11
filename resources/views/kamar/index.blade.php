<x-app-layout>
    <x-slot name="header">
    </x-slot>
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">Suggested Knowledge</h3>
                <div class="flex space-x-2">
                    <a href="{{ route('kamar.create') }}">
                        <button class="p-2 hover:bg-gray-100 rounded-lg">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-gray-200">
                            <th class="pb-3 text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="pb-3 text-xs font-medium text-gray-500 uppercase">Nomor Kamar</th>
                            <th class="pb-3 text-xs font-medium text-gray-500 uppercase">Tipe</th>
                            <th class="pb-3 text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="pb-3 text-xs font-medium text-gray-500 uppercase">Satatus</th>
                            <th class="pb-3 text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kamars as $k)
                            <tr class="border-b border-gray-100">
                                <td class="py-4 text-sm text-gray-600">{{ $k->id }}</td>
                                <td class="py-4 text-sm text-gray-600">{{ $k->no_kamar }}</td>
                                <td class="py-4 text-sm text-gray-600">{{ $k->tipe }}</td>
                                <td class="py-4 text-sm text-gray-600">{{ $k->harga }}</td>
                                <td class="py-4 text-sm text-gray-600">{{ $k->status }}</td>
                                <td class="py-4 text-sm text-gray-600">
                                    <div class="flex items-center space-x-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('kamar.edit', $k->id) }}"
                                        class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition">
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('kamar.destroy', $k->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin mau hapus kamar ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="px-3 py-1 text-xs bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>
 