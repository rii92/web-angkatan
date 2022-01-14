<div> 
    <div class="bg-white m-9 p-9 drop-shadow-2xl rounded-2xl">
        <h2 class="text-2xl font-semibold mb-12">Buat Sambatan</h2>
        <div class="flex flex-col">

            <form action="POST" enctype="multipart/form-data">

                <div class="flex justify-between items-center">
                    <div class="mb-8">
                        <label class="block mb-1 font-semibold" for="">Tag</label>
                        <input class="rounded-lg bg-green-200 text-gray-500" type="text" placeholder="Masukan Tag">
                    </div>

                </div>

                <div class="mb-8">
                    <label class="block mb-1 font-semibold">Pilih Gambar</label>
                    <button class="hover:-translate-y-1 hover:scale-105 duration-300 py-1 text-base font-semibold text-white bg-orange-400 rounded-xl drop-shadow-2xl px-7">Pilih</button>
                </div>

                <div class="mb-8">
                    <label class="block mb-1 font-semibold" for="">Deskripsi</label>
                    <textarea class="w-full h-16 px-3 py-2 text-base  text-gray-500 placeholder-gray-600 border rounded-lg focus:shadow-outline" placeholder="Mau sambat apa?"></textarea>
                    <div class="flex items-center">
                        <input type="checkbox" class="mr-2">
                        <label class="font-medium" for="">Anonim</label>
                    </div>
                </div>

                <button type="submit" class="w-full hover:-translate-y-1 hover:scale-105 duration-300 py-1 text-base font-medium text-white bg-orange-400 rounded-xl drop-shadow-2xl px-7">Kirim</button>
            </form>
            <button wire:click="$emit('closeModal')" class="hover:-translate-y-1 hover:scale-105 duration-300 py-1 text-base font-medium text-white bg-sky-900 rounded-xl drop-shadow-2xl px-7 my-2">Tutup</button>
        </div>
    </div>
</div> 
