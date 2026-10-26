@extends('layouts.app')

@section('title', 'All Bangla Newspapers, TV, Radio & News Sites')

@section('content')
    @include('components.section-nav', ['categories' => $categories])

    @forelse ($categories as $category)
        @include('components.newspaper-section', ['category' => $category])

        @if (($loop->iteration % $adEvery) === 0 && !$loop->last)
            @include('components.advertisement', [
                'slot' => 'home-feed-' . $loop->iteration,
                'className' => 'ad-feed',
                'label' => 'Advertisement · 970×120'
            ])
        @endif
    @empty
        <div class="panel empty">No categories available yet. Please add categories from the admin panel.</div>
    @endforelse
@endsection
