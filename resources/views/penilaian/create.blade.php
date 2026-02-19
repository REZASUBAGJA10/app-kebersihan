<x-app-layout>
    <div class="py-12 bg-[#f8fafc] min-h-screen font-sans">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <form id="main-form" action="{{ route('penilaian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-8 px-2">
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Formulir Penilaian Baru</h2>
                    <p class="text-slate-500 text-sm mt-1">Lengkapi data parameter penilaian unit kelas di bawah ini.</p>
                </div>

                <div class="bg-white border border-slate-200 rounded-[24px] overflow-hidden shadow-sm">
                    <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-slate-100">
                        
                        <div class="lg:col-span-4 p-8 bg-slate-50/30">
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-widest mb-5 flex items-center gap-2">
                                        <span class="w-1 h-4 bg-indigo-600 rounded-full"></span>
                                        Data Dasar
                                    </h3>
                                    <div class="space-y-4">
                                        <div class="space-y-1.5">
                                            <label class="text-[11px] font-bold text-slate-400 uppercase ml-1">Unit Kelas</label>
                                            <select name="kelas_id" required class="w-full border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 text-sm py-2.5 font-medium transition-all appearance-none">
                                                <option value="" disabled selected>Pilih Kelas</option>
                                                @foreach($kelas as $k)
                                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="space-y-1.5">
                                            <label class="text-[11px] font-bold text-slate-400 uppercase ml-1">Tanggal Input</label>
                                            <input type="date" name="tanggal_penilaian" value="{{ date('Y-m-d') }}" required 
                                                class="w-full border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 text-sm py-2.5 font-medium transition-all">
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-2">
                                    <label class="text-[11px] font-bold text-slate-400 uppercase ml-1 block mb-3">Dokumentasi</label>
                                    <div onclick="document.getElementById('foto-input').click()" 
                                         class="group relative border-2 border-dashed border-slate-200 rounded-2xl bg-white hover:border-indigo-400 transition-all cursor-pointer aspect-video flex flex-col items-center justify-center overflow-hidden">
                                        <input type="file" name="foto" id="foto-input" accept="image/*" class="hidden">
                                        <div id="placeholder-content" class="text-center p-4">
                                            <div class="w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:bg-indigo-50 transition-colors">
                                                <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                            </div>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">Klik Unggah Foto</p>
                                        </div>
                                        <img id="preview-img" class="absolute inset-0 w-full h-full object-cover hidden group-hover:opacity-90 transition-opacity">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-8 p-8 flex flex-col">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-widest flex items-center gap-2">
                                    <span class="w-1 h-4 bg-indigo-600 rounded-full"></span>
                                    Parameter Skor
                                </h3>
                                <span class="text-[10px] bg-indigo-50 text-indigo-600 font-bold px-3 py-1 rounded-lg uppercase tracking-wider border border-indigo-100">Rentang 0 - 25</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                                @foreach($kriteria as $kr)
                                <div class="p-4 rounded-2xl bg-white border border-slate-100 hover:border-indigo-200 hover:shadow-sm transition-all group">
                                    <div class="flex items-center justify-between gap-4">
                                        <div class="flex-1">
                                            <p class="text-sm font-bold text-slate-700 group-hover:text-indigo-900 transition-colors tracking-tight">{{ $kr->nama_kriteria }}</p>
                                            <p class="text-[10px] font-semibold text-slate-400 uppercase mt-0.5 tracking-wide">Bobot {{ $kr->bobot }}%</p>
                                        </div>
                                        <input type="number" name="nilai[{{ $kr->id }}]" min="0" max="25" placeholder="0" required
                                            class="w-16 border-none bg-slate-50 group-hover:bg-indigo-50 rounded-xl text-center font-black text-indigo-600 focus:ring-2 focus:ring-indigo-500 py-2.5 text-lg transition-all">
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="space-y-2 mb-8">
                                <label class="text-[11px] font-bold text-slate-400 uppercase ml-1">Catatan Tambahan (Opsional)</label>
                                <textarea name="catatan" rows="3" placeholder="Tambahkan keterangan jika diperlukan..."
                                    class="w-full border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 text-sm py-3 px-4 resize-none transition-all bg-slate-50/30"></textarea>
                            </div>

                            <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-end gap-4">
                                <a href="{{ route('penilaian.index') }}" class="text-[11px] font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-[0.2em]">
                                    Batal
                                </a>
                                <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-[11px] font-bold rounded-xl shadow-sm hover:shadow-indigo-200 transition-all active:scale-95 uppercase tracking-[0.2em]">
                                    Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="text-center mt-6 text-[11px] text-slate-400 font-medium italic opacity-60">
                    * Pastikan semua data sudah benar sebelum melakukan penyimpanan data.
                </p>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('foto-input').onchange = evt => {
            const [file] = document.getElementById('foto-input').files
            if (file) {
                document.getElementById('preview-img').src = URL.createObjectURL(file)
                document.getElementById('preview-img').classList.remove('hidden')
                document.getElementById('placeholder-content').classList.add('hidden')
            }
        }
    </script>
</x-app-layout>