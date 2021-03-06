@extends('_layouts.main')

@php
    $page->type = 'article';
@endphp

@section('body')
    @if ($page->cover_image)
        <img src="{{ $page->cover_image }}" alt="{{ $page->name }} cover image" class="mb-2">
    @endif

    <h1 class="leading-none mb-2">{{ $page->name }}</h1>

    <p class="text-gray-700 text-xl md:mt-0">
        <span>Since {{ date('F, Y', $page->date) }}</span>
        @if ($page->end_date)
            <span>to {{ date('F, Y', $page->end_date) }}</span>
        @endif
    </p>

    @if ($page->categories)
        @foreach ($page->categories as $i => $category)
            <a
                    href="{{ '/categories/' . $category }}"
                    title="View posts in {{ $category }}"
                    class="inline-block bg-gray-300 hover:bg-pink-200 leading-loose tracking-wide text-gray-800 uppercase text-xs font-semibold rounded mr-4 px-3 pt-px"
            >{{ $category }}</a>
        @endforeach
    @endif

    <div class="border-b border-pink-200 mb-10 pb-4" v-pre>
        @yield('content')
        <x-ads.article></x-ads.article>
        @if ($page->link)
            <p class="mt-6 text-2xl text-center">
                <a target="_blank" class="btn btn-pink" href="{{$page->link}}">Visit project's website</a>
            </p>
        @endif
    </div>

    <nav class="flex justify-between text-sm md:text-base">
        <div>
            @if ($next = $page->getNext())
                <a href="{{ $next->getUrl() }}" title="Older Post: {{ $next->name }}">
                    &LeftArrow; {{ $next->name }}
                </a>
            @endif
        </div>

        <div>
            @if ($previous = $page->getPrevious())
                <a href="{{ $previous->getUrl() }}" title="Newer Post: {{ $previous->name }}">
                    {{ $previous->name }} &RightArrow;
                </a>
            @endif
        </div>
    </nav>
@endsection
