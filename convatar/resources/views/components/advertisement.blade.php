
@php
    $advertisement = $advertisements[$slot] ?? null;
@endphp

@if ($advertisement && $advertisement->is_active)
    <div class="ad-container {{ $className ?? '' }}">
        @if ($advertisement->url)
            <a
                href="{{ $advertisement->url }}"
                target="_blank"
                rel="noopener sponsored"
                class="ad-link"
            >
        @endif

        @if ($advertisement->image)
            <img
                src="{{ asset('storage/' . $advertisement->image) }}"
                alt="{{ $advertisement->title ?: 'Advertisement' }}"
                class="ad-banner"
                loading="lazy"
            >
        @else
            <div class="ad-placeholder">
                {{ $advertisement->title ?: 'Advertisement' }}
            </div>
        @endif

        @if ($advertisement->url)
            </a>
        @endif
    </div>
@endif

