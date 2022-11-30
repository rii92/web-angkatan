<x-dashboard-layout title="{{ $simulation->title }}">
    <div class="flex flex-col md:flex-row mb-4">
        <x-card.base class="flex-1">
            <div class="text-sm">
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

            <div class=" mt-2 text-sm">
                <h3 class="font-bold">⚠️ Harap Perhatian ⚠️</h3>
                <ul class="list-disc ml-4">
                    <li>
                        Pilihan Satuan Kerja anda akan berpengaruh pada kehidupan anda <b>beberapa tahun kedepan</b>.
                        Oleh karena itu, pertimbangkan dengan baik satuan kerja yang anda pilih.
                    </li>
                    <li>
                        Banyak faktor yang dapat menjadi pertimbangan pada saat memilih Satuan Kerja, misalnya:
                        biaya pulang kampung, pasangan (kalo punya :D, kalo ngga skip), biaya hidup, lingkungan
                        Satker, akses ke luar-masuk, ongkir Shopee, dan lain sebagainya.
                    </li>
                    <li>
                        Hasil dari simulasi ini, diharapkan dapat memberikan gambaran alokasi CPNS dari
                        Biro SDM BPS RI, dan tidak menutup kemungkinan hasil akhir akan berubah dari hasil simulasi.
                    </li>
                    <li>
                        Bagi yang memiliki "priviledge" gunakan sebaik-baiknya, dan diharapkan untuk mengisi lebih cepat
                    </li>
                    <li>
                        <b>Pilihlah dengan bijak, dan sadar diri 😉, pilihan anda bisa berpengaruh terhadap pilihan orang lain.</b>
                    </li>
                    <li>
                        🎝 You only get one shot, do not miss your chance to blow. This opportunity comes once in a lifetime, yo
                    </li>
                </ul>
            </div>

            <div class=" mt-2 text-sm">
                <h3 class="font-bold">Link Penting</h3>
                <ul class="list-disc ml-4">
                    <li>
                        <x-link target="_blank"
                            href="https://docs.google.com/document/d/15lW5TVQ3j3mXWex0Y-D3MAK5fUEaeepZkdh7821MiSY/edit?usp=sharing">
                            Panduan Simulasi
                        </x-link>
                    </li>
                    <li>
                        <x-link
                            href="https://docs.google.com/forms/d/e/1FAIpQLSefcpAIOmIYsaJh3qOzLvkyQa9-tiCa8jAU_bExjChxC9nTJA/viewform">
                            Form QnA
                        </x-link>
                    </li>
                    <li>
                        <x-link
                            href="https://docs.google.com/spreadsheets/d/1l2euR3QnAhD-nBN9oza-pgXQtYBoPDzValmmzZ086qU/edit#gid=1720344264">
                            Jawaban QnA
                        </x-link>
                    </li>
                </ul>
            </div>
        </x-card.base>
        @livewire('mahasiswa.simulation.selection', ['simulation' => $simulation])
    </div>

    <x-card.base title="Daftar Satker">
        @livewire('mahasiswa.simulation.satker-table', ['simulation_id' => $simulation->id])
        <p class="text-gray-400 text-sm mt-3 leading-tight">
            Silahkan klik nama Satker atau Provinsi untuk mengetahui siapa saja yang memilih di Satker atau Provinsi
            tersebut. <b>Untuk tampilan Provinsi masih terdapat kesalahan penghitungan jumlah yang memilih pada provinsi
                tersebut. Hal ini masih kami coba perbaiki. Untuk sekarang silahkan klik saja nama provinsi untuk
                melihat dengan lebih detail siapa saja yang memilih disana</b>
        </p>

    </x-card.base>


    <x-card.base title="Peserta Simulasi">
        @livewire('mahasiswa.simulation.users-table', ['simulation_id' => $simulation->id])
    </x-card.base>
</x-dashboard-layout>
