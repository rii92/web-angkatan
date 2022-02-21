<x-app-layout title="Sambat">
    <x-landingpage.wrapper title="Sambat">
        @livewire('guest.sambat.lists')
    </x-landingpage.wrapper>

    @push('bottom-menu')
        <div class="h-12 w-12 bg-main rounded-full border-2 border-white">
            <a href="{{ route('user.sambat.add') }}" class="relative flex justify-center items-center h-full w-full cursor-pointer">
                <x-icons.plus class="text-white hover:text-orange-200 transition duration-150 w-10 h-10 mx-2 my-2" stroke-width='1.5' />
            </a>
        </div>
    @endpush

    @push('scripts')
        <script src="{{ mix('js/viewer.js') }}" defer></script>
        <script src="{{ mix('js/sambat.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('sambat-pagination').addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('page-link-scroll-to-top')) {
                        window.scrollTo({
                            top: 70,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
