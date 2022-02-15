<x-app-layout title="Sambat">
    <x-landingpage.wrapper title="Sambat">
        @livewire('guest.sambat.lists')
    </x-landingpage.wrapper>

    @push('bottom-menu')
        <div class="h-10 w-10 bg-main rounded-full border-2 border-white shadow-md">
            <div class="relative flex justify-center items-center h-full w-full cursor-pointer">
                <a href="{{ route('user.sambat.add') }}">
                    <x-icons.plus class="text-white hover:text-orange-200 transition duration-150" stroke-width='3' />
                </a>
            </div>
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
