<x-app-layout title="{{ $announcement->title }}">
  <div class="min-h-screen py-6 bg-light-4 bg-gradient-to-t from-light-4 to-white">
    <div class="max-w-5xl px-1 mx-auto sm:px-6 lg:px-8">
      <article class="relative px-4 py-6 rounded-lg shadow-lg bg-blue-sidebar lg:px-8">
        <header class="mb-5">
          <h1 class="mt-5 mb-2 text-2xl font-bold text-center text-black font-archivo-narrow lg:text-5xl md:text-4xl">
            {{ $announcement->title }}
          </h1>
          <div class="text-center text-black">{{$announcement->published_at->format('M j, Y . h:i A')}}</div>
        </header>
        <div class="prose announcement lg:prose-lg max-w-none">
          {!! Str::markdown($announcement->content) !!}
        </div>
      </article>
    </div>
  </div>
</x-app-layout>