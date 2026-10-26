<nav class="jump" aria-label="Newspaper categories">
    @foreach ($categories as $category)
        <a href="#{{ $category->slug }}">{{ $category->title }}</a>
    @endforeach
</nav>
