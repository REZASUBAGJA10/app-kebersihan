<x-app-layout>
    <div class="py-12 bg-[#f8fafc] min-h-screen font-sans">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf

                <div class="mb-10 px-2">
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Tambah Kelas Baru</h2>
                    <p class="text-slate-500 text-sm mt-1">Masukkan data identitas kelas dan nama wali kelas pengampu.</p>
                </div>

                <div class="bg-white border border-slate-100 rounded-[32px] p-10 shadow-sm relative">
                    
                    <div class="flex items-center gap-2 mb-8">
                        <span class="w-1 h-5 bg-indigo-600 rounded-full"></span>
                        <h3 class="text-[11px] font-bold text-slate-800 uppercase tracking-widest">Identitas Kelas</h3>
                    </div>

                    <div class="space-y-8">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase ml-1">Nama Kelas</label>
                            <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" required 
                                class="w-full border-slate-100 bg-slate-50/50 rounded-2xl focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 text-sm py-4 px-6 font-medium transition-all outline-none"
                                placeholder="Misal: XII RPL 1">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-slate-400 uppercase ml-1">Nama Wali Kelas</label>
                            <input type="text" name="wali_kelas" value="{{ old('wali_kelas') }}" required 
                                class="w-full border-slate-100 bg-slate-50/50 rounded-2xl focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 text-sm py-4 px-6 font-medium transition-all outline-none"
                                placeholder="Masukkan nama lengkap wali kelas">
                        </div>

                        <div class="bg-indigo-50/50 border border-indigo-100/50 rounded-2xl p-6 flex items-start gap-4 mt-10">
                            <div class="w-5 h-5 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="text-indigo-600 font-bold text-[10px]">i</span>
                            </div>
                            <p class="text-[11px] leading-relaxed text-indigo-900/70 font-medium">
                                <strong class="text-indigo-600">Info:</strong> Data kelas yang Anda tambahkan akan langsung tersedia dalam daftar pilihan unit kelas pada formulir penilaian harian.
                            </p>
                        </div>
                    </div>

                    <div class="mt-12 flex items-center justify-end gap-8">
                        <a href="{{ route('kelas.index') }}" class="text-[11px] font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-[0.2em]">
                            Batal
                        </a>
                        <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-[11px] font-bold rounded-2xl shadow-lg shadow-indigo-200 transition-all active:scale-95 uppercase tracking-[0.2em]">
                            Simpan Data Kelas
                        </button>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-8 px-4 opacity-40">
                    <p class="text-[10px] text-slate-400 font-medium tracking-wide italic">SMKN 1 Maja | Sistem Penilaian Kelas</p>
                    <p class="text-[10px] text-slate-400 font-medium">© 2026 Reza Subagja</p>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>