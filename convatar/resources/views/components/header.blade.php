<header class="topbar">
    <div class="topbar-inner">
        <a href="{{ route('home') }}" class="brand">ALL BANGLA<small>NEWSPAPER</small></a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-menu" onclick="const m=document.getElementById('main-menu'); const open=m.classList.toggle('is-open'); this.setAttribute('aria-expanded', open ? 'true' : 'false');">
            <span aria-hidden="true">☰</span> Menu
        </button>
        <nav class="menu" id="main-menu" aria-label="Main navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#daily-newspapers">Newspapers</a>
            <a href="{{ route('home') }}#epapers">E-Papers</a>
            <a href="{{ route('home') }}#tv-channels">TV Channels</a>
            <a href="{{ route('home') }}#fm-radio">Radio</a>
            <a href="{{ url('/convatar') }}">Bangla Converter</a>
        </nav>
    </div>
</header>
