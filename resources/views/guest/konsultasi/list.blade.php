<div>
    <div class="grid grid-cols-12 md:gap-x-3 gap-x-1 gap-y-0 items-center max-w-6xl mx-auto">
        <div class="md:col-span-2 col-span-6 md:mb-0 mb-2 mt-0">
            <x-input.select>
                <option value="all">Semua Tipe</option>
                <option value="{{ AppKonsul::TYPE_AKADEMIK }}">{{ ucfirst(AppKonsul::TYPE_AKADEMIK) }}</option>
                <option value="{{ AppKonsul::TYPE_UMUM }}">{{ ucfirst(AppKonsul::TYPE_UMUM) }}</option>
            </x-input.select>
        </div>

        <div class="md:col-span-2 col-span-6 md:mb-0 mb-2 mt-0">
            <x-input.select>
                <option value="all">Semua Jurusan</option>
                @foreach (AppKonsul::allJurusan() as $jurusan)
                    <option value="{{ $jurusan }}">{{ $jurusan }}</option>
                @endforeach
            </x-input.select>
        </div>

        <div class="lg:col-span-7 md:col-span-6 col-span-9 mb-0 mt-0">
            <x-input.text id="search" placeholder="Awali dengan # jika ingin mencari berdasarkan hastags.." />
        </div>

        <div class="lg:col-span-1 md:col-span-2 col-span-3">
            <x-button.black class="flex justify-center w-full">Cari</x-button.black>
        </div>

    </div>

    <div class="mt-8 max-w-5xl mx-auto">
        @foreach ([1, 2, 3, 4, 5] as $a)
            <div class="mb-8">
                <div class="flex items-center">
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="Eko Putra"
                        class="rounded-full mr-3 border border-gray-200 shadow-md sm:h-12 sm:w-12 w-10 h-10">
                    <div class="flex flex-col">
                        <h2 class="leading-tight md:text-2xl text-lg">Lorem ipsum dolor, sit amet consectetur
                            adipisicing
                            elit.
                            Eligendi,
                            repellat?
                            <x-badge.primary text="Akademik" />
                        </h2>
                        <small class="text-gray-500">Anonim | Jurusan SD | 23-Jul-2000 23:27</small>
                    </div>
                </div>

                <div class="bg-light-4 bg-opacity-30 p-5 rounded-lg mt-3 shadow-lg border border-gray-300">
                    <article class="text-gray-800">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus cum architecto repellat ipsum,
                        quia
                        similique magnam odit! Harum consequuntur veniam eius. Quam reiciendis totam unde ducimus
                        molestias
                        fugiat sequi dicta. Aspernatur deserunt libero quia cum odit ex repellendus illo laboriosam!
                        Commodi,
                        debitis! Distinctio doloremque quo rem laborum alias reprehenderit eum omnis maiores ab
                        molestias
                        nostrum dicta velit, sapiente enim, quibusdam aliquam hic facilis perspiciatis natus culpa
                        deserunt
                        eos
                        ipsa. Adipisci similique molestias porro sunt, tenetur corporis eius fugiat impedit dicta
                        reiciendis
                        eos
                        consequatur odit iste. Ullam ratione perspiciatis, quibusdam aliquam facilis sint, tempore
                        accusamus
                        nulla quasi fugit eos. Perferendis iste expedita est dignissimos, nemo cumque, ut quos sunt
                        temporibus
                        saepe exercitationem explicabo hic autem, voluptatem atque. Cupiditate iure possimus tenetur
                        dolore
                        dicta ratione molestias delectus est, doloremque repellendus enim accusantium natus totam
                        voluptas,
                        consectetur ut praesentium! Labore temporibus quisquam quam, quos iure, nemo cum repudiandae
                        repellat
                        dolore est id, obcaecati neque at expedita iusto laboriosam earum ea sequi iste debitis
                        inventore
                        veniam. Assumenda recusandae mollitia provident quod, pariatur neque officiis. Ipsa, ad
                        quisquam!
                        Voluptates repellendus magnam laudantium dolores sapiente aut quaerat similique. Facere quaerat
                        molestias, vero natus deleniti ratione unde ab! Modi, quibusdam! Culpa quam iste tempore
                        praesentium
                        consequatur minus?
                    </article>
                    <div class="flex justify-between items-center mt-3">
                        <div>
                            @foreach ([1, 2, 3, 4, 5] as $tag)
                                <x-badge.success text="hallooooo0000000" class="mr-0" />
                            @endforeach
                        </div>
                        <x-anchor.black target="_blank" class="ml-3"
                            href="{{ route('konsultasi.detail', ['konsul_id' => 1]) }}">Lihat
                        </x-anchor.black>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
