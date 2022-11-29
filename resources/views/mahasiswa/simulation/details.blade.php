<x-dashboard-layout title="{{ $simulation->title }}">
    <div class="flex flex-col md:flex-row mb-4">
        <x-card.base class="flex-1">
            <div>
                <h3 class="font-bold">Mekanisme Simulasi Penempatan</h3>
                <ul class="list-disc ml-4">
                    <li>
                        Alokasi penempatan sesuai pilihan mahasiswa dengan mempertimbangkan ranking, dan
                        rangking diperoleh dari Biro SDM BPS RI (no debat).
                    </li>
                    <li>
                        Pilihan 1, 2, 3 hanya menentukan urutan pengecekan. Jika pilihan 1 sudah memenuhi,
                        maka tidak dilanjutkan ke pilihan selanjutnya, dan sebaliknya. Pilihan satker hanya bisa
                        diupdate pada saat sesi berlangsung.
                    </li>
                    <li>
                        Jika mahasiswa memiliki pilihan yang sama dengan urutan prioritas berbeda, maka
                        mahasiswa dengan rangking yang lebih tinggi akan dialokasikan
                    </li>
                    <li>
                        Jika dari ketiga pilihan tidak ada yang masuk, maka hasil final akan dikosongkan.
                    </li>
                    <li>
                        Hasil final akan diupdate pada interval waktu tertentu, stay tune untuk melihat hasilnya :D.
                    </li>
                </ul>
            </div>
            <div class=" mt-2">
                <h3 class="font-bold">Harap Perhatian</h3>
                <ul class="list-disc ml-4">
                    <li>
                        Pilihan Satuan Kerja anda akan berpengaruh pada kehidupan anda beberapa tahun kedepan. 
                        Oleh karena itu, pertimbangkan dengan baik satuan kerja yang anda pilih.
                    </li>
                    <li>
                        Banyak faktor yang dapat menjadi pertimbangan pada saat memilih Satuan Kerja, misalnya:
                        biaya pulang kampung, pasangan (kalo punya :D, kalo ngga skip), biaya hidup, lingkungan 
                        Satker, dan lain sebagainya.
                    </li>
                    <li>
                        Hasil dari simulasi ini, diharapkan dapat memberikan gambaran alokasi CPNS dari
                        Biro SDM BPS RI, dan tidak menutup kemungkinan hasil akhir akan berubah dari hasil simulasi.
                    </li>
                    <li>
                        Jangan Lupa SIPMEN guys, hehe
                    </li>
                </ul>
            </div>
        </x-card.base>
        @livewire('mahasiswa.simulation.selection', ['simulation' => $simulation])
    </div>
    <x-card.base title="Daftar Satker">
        @livewire('mahasiswa.simulation.satker-table', ['simulation_id' => $simulation->id])
    </x-card.base>
    <x-card.base title="Peserta Simulasi">
        @livewire('mahasiswa.simulation.users-table', ['simulation_id' => $simulation->id])
    </x-card.base>
</x-dashboard-layout>
