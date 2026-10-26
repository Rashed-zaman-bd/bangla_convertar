@php
    $isExternalUrl = $newspaper->url !== '#' && filter_var($newspaper->url, FILTER_VALIDATE_URL);
@endphp
<a class="item"
   href="{{ $newspaper->url }}"
   @if ($isExternalUrl) target="_blank" rel="noopener noreferrer nofollow" @endif
   title="{{ $newspaper->name }}">
    <div class="logo">
        <img src="{{ $newspaper->logo_url }}" alt="{{ $newspaper->name }}" loading="lazy"
             onerror="this.hidden=true; this.nextElementSibling.hidden=false">
        <span class="logo-text" hidden>{{ $newspaper->name }}</span>
    </div>
    <div class="name">{{ $newspaper->name }}</div>
</a>
