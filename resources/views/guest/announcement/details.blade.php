<x-app-layout title="{{ $announcement->title }}">
  <div class="py-6 bg-light-4 bg-gradient-to-t from-light-4 to-white min-h-screen">
    <div class="max-w-5xl mx-auto px-1 sm:px-6 lg:px-8">
      <article class="shadow-lg rounded-lg bg-darker py-6 px-4 lg:px-8 relative">
        <header class="mb-5">
          <h1 class="mb-2 mt-5 font-archivo-narrow font-bold lg:text-5xl text-2xl md:text-4xl text-center text-subtle">
            {{ $announcement->title }}
          </h1>
          <div class="text-center text-orange-300">{{$announcement->published_at->format('M j, Y . h:i A')}}</div>
        </header>
        <div class="announcement prose lg:prose-lg max-w-none">
          {!! Str::markdown($announcement->content) !!}
        </div>
      </article>
    </div>
  </div>
</x-app-layout>