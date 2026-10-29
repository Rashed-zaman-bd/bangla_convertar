@extends('layouts.app')

@section('title', 'All Bangla Newspapers, TV, Radio & News Sites')

@section('content')
    
    
    @forelse ($categories as $category)

        {{-- Newspaper Category --}}
        @include('components.newspaper-section', [
            'category' => $category
        ])

        {{-- Advertisement Under Every Category --}}
        @include('components.advertisement', [
            'slot' => 'home-feed-' . $loop->iteration,
            'className' => 'ad-feed',
            'label' => 'Advertisement · 970×120'
        ])

    @empty
        <div class="panel empty">
            No categories available yet. Please add categories from the admin panel.
        </div>
    @endforelse

@endsection
