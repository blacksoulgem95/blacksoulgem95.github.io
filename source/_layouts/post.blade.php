@extends('_layouts.main')

@php
    $page->type = 'article';
@endphp

@push('meta')
    <meta property="og:type" content="article"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@blacksoulgem95" />
    <meta name="twitter:creator" content="@blacksoulgem95" />

    @if ($page->cover_image)
        <meta property="og:image" content="{{$page->baseUrl.$page->cover_image}}"/>
    @endif
    <meta property="og:description" content="{{$page->description}}">

    <x-json-ld-article :article="$page"></x-json-ld-article>
@endpush

@section('body')
    @if ($page->cover_image)
        <img src="{{ $page->cover_image }}" alt="{{ $page->title }} cover image" class="mb-2">
    @endif

    <h1 class="leading-none mb-2">{{ $page->title }}</h1>

    <p class="text-gray-700 text-xl md:mt-0">{{ $page->author }} • {{ date('F j, Y', $page->date) }}</p>

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
    </div>

    <div class="border-b border-pink-200 mb-10 flex justify-center">
        @include("_components.kofi")
    </div>

    <nav class="flex justify-between text-sm md:text-base mb-6">
        <div>
            @if ($next = $page->getNext())
                <a href="{{ $next->getUrl() }}" title="Older Post: {{ $next->title }}">
                    &LeftArrow; {{ $next->title }}
                </a>
            @endif
        </div>

        <div>
            @if ($previous = $page->getPrevious())
                <a href="{{ $previous->getUrl() }}" title="Newer Post: {{ $previous->title }}">
                    {{ $previous->title }} &RightArrow;
                </a>
            @endif
        </div>
    </nav>

    @include("_components.comments")
@endsection
