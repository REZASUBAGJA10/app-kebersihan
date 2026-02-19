<x-app-layout>
    <div class="py-12 bg-[#f8fafc] min-h-screen font-sans">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Form Action menggunakan $kelas->id yang dikirim dari Controller --}}
            <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-10 px-2 flex justify-between items-end">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 tracking-tight text-indigo-600">Perbarui Kelas</h2>
                        <p class="text-slate-500 text-sm mt-1">Ubah informasi untuk kelas <span class="font-bold text-slate-700">{{ $kelas->nama_kelas }}</span>.</p>
                    </div>
                    <div class="hidden sm:block">
                        <span class="px-4 py-2 bg-amber-50 text-amber-600 text-[10px] font-bold uppercase tracking-widest rounded-xl border border-amber-100">
                            Mode Edit
                        </span>
                    </div>
                </div>

                <div class="bg-white border border-slate-100 rounded-[32px] p-10 shadow-sm relative">
                    
                    <div class="flex items-center gap-2 mb-8">
                        <span class="w-1 h-5 bg-indigo-600 rounded-full"></span>
                        <h3 class="text-[11px] font-bold text-slate-800 uppercase tracking-widest">Identitas Kelas</h3>
                    </div>

                    <div class="space-y-8">
                        {{-- Nama Kelas --}}
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase ml-1">Nama Kelas</label>
                            {{-- old('field', $default) akan mengambil data asli dari database jika belum ada input baru --}}
                            <input type="text" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required 
                                class="w-full border-slate-100 bg-slate-50/50 rounded-2xl focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 text-sm py-4 px-6 font-medium transition-all outline-none"
                                placeholder="Misal: XII RPL 1">
                            @error('nama_kelas')
                                <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nama Wali Kelas --}}
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase ml-1">Nama Wali Kelas</label>
                            <input type="text" name="wali_kelas" value="{{ old('wali_kelas', $kelas->wali_kelas) }}" required 
                                class="w-full border-slate-100 bg-slate-50/50 rounded-2xl focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 text-sm py-4 px-6 font-medium transition-all outline-none"
                                placeholder="Masukkan nama lengkap wali kelas">
                            @error('wali_kelas')
                                <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Warning Box --}}
                        <div class="bg-amber-50/50 border border-amber-100/50 rounded-2xl p-6 flex items-start gap-4 mt-10">
                            <div class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="text-amber-600 font-bold text-[10px]">!</span>
                            </div>
                            <p class="text-[11px] leading-relaxed text-amber-900/70 font-medium">
                                <strong class="text-amber-600">Perhatian:</strong> Perubahan nama kelas akan langsung sinkron dengan seluruh laporan penilaian yang sudah ada di sistem.
                            </p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-12 flex items-center justify-end gap-8">
                        <a href="{{ route('kelas.index') }}" class="text-[11px] font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-[0.2em]">
                            Batal
                        </a>
                        <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-[11px] font-bold rounded-2xl shadow-lg shadow-indigo-200 transition-all active:scale-95 uppercase tracking-[0.2em] flex items-center gap-3">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

                {{-- Footer Info --}}
                <div class="flex justify-between items-center mt-8 px-4 opacity-40">
                    <p class="text-[10px] text-slate-400 font-medium tracking-wide italic">SMKN 1 Maja | Sistem Penilaian Kelas</p>
                    <p class="text-[10px] text-slate-400 font-medium">© 2026 Reza Subagja</p>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>