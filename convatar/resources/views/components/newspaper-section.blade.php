<section class="block" id="{{ $category->slug }}">
    <h2>{{ $category->title }}</h2>
    <div class="panel">
        <div class="grid">
            @forelse ($category->newspapers as $newspaper)
                @include('components.newspaper-card', ['newspaper' => $newspaper])
            @empty
                <p class="empty">No websites have been added to this category yet.</p>
            @endforelse
        </div>
        @if ($category->note)
            <p class="note">{{ $category->note }}</p>
        @endif
    </div>
</section>
