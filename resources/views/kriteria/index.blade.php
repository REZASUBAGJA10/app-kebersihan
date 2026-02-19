<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-indigo-900 leading-tight flex items-center gap-2">
            <span></span> {{ __('Manajemen Kriteria Penilaian') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div id="notif" class="mb-4 p-3 bg-emerald-500 text-white rounded-xl shadow-lg flex justify-between items-center transition-all duration-500">
                    <div class="flex items-center text-xs">
                        <span class="bg-white/20 p-1 rounded-lg mr-2">✨</span>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('notif').remove()" class="hover:bg-white/20 p-1 rounded-full transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl shadow-gray-200/50 sm:rounded-3xl p-5 border border-gray-100">
                
                <div class="flex flex-col md:flex-row justify-between items-end mb-6 gap-4 border-b border-gray-100 pb-5">
                    <div class="space-y-0.5">
                        <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">Daftar Kriteria</h3>
                        <p class="text-indigo-600 font-bold text-xs flex items-center gap-2">
                            <span class="w-6 h-1 bg-indigo-600 rounded-full"></span>
                            Standar Penilaian
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('kriteria.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white hover:bg-indigo-700 active:scale-95 transition-all shadow-md shadow-indigo-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Kriteria
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm">
                    <table class="w-full text-xs text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 uppercase text-[10px] font-black tracking-widest">
                                <th class="p-3 text-center w-12">No</th>
                                <th class="p-3">Indikator Kriteria</th>
                                <th class="p-3 text-center">Bobot</th>
                                <th class="p-3 text-center w-28">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($kriteria as $item)
                            <tr class="hover:bg-indigo-50/50 transition duration-300 group">
                                <td class="p-3 text-center font-semibold text-gray-400 group-hover:text-indigo-600 transition">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="p-3">
                                    <span class="font-black text-gray-800 uppercase tracking-tight text-sm">{{ $item->nama_kriteria }}</span>
                                </td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded-lg font-bold text-[10px]">
                                        {{ $item->bobot }}%
                                    </span>
                                </td>
                                <td class="p-3 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center gap-1.5">
                                        <a href="{{ route('kriteria.edit', $item->id) }}" class="p-1.5 bg-white border border-gray-200 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition shadow-sm" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <form action="{{ route('kriteria.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kriteria ini?')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 bg-white border border-gray-200 text-rose-500 rounded-lg hover:bg-rose-600 hover:text-white transition shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-10 text-center text-gray-400 italic">Belum ada data kriteria.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end">
                    <div class="bg-indigo-900 text-white px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider shadow-md">
                        Total: {{ $kriteria->count() }} Kriteria
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>