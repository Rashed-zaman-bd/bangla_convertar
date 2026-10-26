@php
    // helper to keep the data short: [name, url, slug]
    $make = fn (array $rows) => collect($rows)->map(fn ($r) => [
        'name' => $r[0],
        'url'  => $r[1] ?? '#',
        'slug' => $r[2] ?? \Illuminate\Support\Str::slug($r[0]),
    ])->all();

    $sections = $sections ?? [
        ['id' => 'daily-newspapers', 'title' => 'All Daily Bangla Newspapers', 'items' => $make([
            ['Daily Prothom Alo', 'https://www.prothomalo.com'],
            ['Bangladesh Pratidin', 'https://www.bd-pratidin.com'],
            ['Jugantor', 'https://www.jugantor.com'],
            ['Kaler Kantho', 'https://www.kalerkantho.com'],
            ['Daily Star', 'https://www.thedailystar.net'],
            ['Samakal', 'https://samakal.com'],
            ['Ittefaq', 'https://www.ittefaq.com.bd'],
            ['Inqilab', 'https://dailyinqilab.com'],
            ['Manab Zamin', 'https://mzamin.com'],
            ['Amader Shomoy', 'https://www.dainikamadershomoy.com'],
        ])],
        ['id' => 'epapers', 'title' => 'All Bangla E-Papers', 'items' => $make([
            ['Prothom Alo ePaper', '#'], ['Jugantor ePaper', '#'], ['Kaler Kantho ePaper', '#'],
            ['Samakal ePaper', '#'], ['Ittefaq ePaper', '#'], ['Bangladesh Pratidin ePaper', '#'],
        ])],
        ['id' => 'online-newspapers', 'title' => 'All Online Bangla Newspapers', 'items' => $make([
            ['BD News 24', 'https://bdnews24.com'],
            ['Bangla News 24', 'https://www.banglanews24.com'],
            ['Jago News 24', 'https://www.jagonews24.com'],
            ['Rising BD', 'https://www.risingbd.com'],
            ['Dhaka Post', 'https://www.dhakapost.com'],
            ['BD 24 Live', 'https://www.bd24live.com'],
            ['BBC Bangla', 'https://www.bbc.com/bengali'],
            ['Banglanews', '#'],
        ])],
        ['id' => 'tv-channels', 'title' => 'All Bangla TV Channels', 'items' => $make([
            ['Jamuna TV', 'https://jamuna.tv'],
            ['Channel 24', 'https://www.channel24bd.tv'],
            ['Desh TV', 'https://www.desh.tv'],
            ['Somoy News', 'https://www.somoynews.tv'],
            ['Rtv online', 'https://www.rtvonline.com'],
            ['NTV', 'https://www.ntvbd.com'],
            ['Channel i', 'https://www.channelionline.com'],
            ['Independent TV', '#'],
            ['ATN Bangla', '#'],
            ['Ekattor TV', '#'],
        ])],
        ['id' => 'local-newspapers', 'title' => 'All Local and District Newspapers in Bangladesh', 'items' => $make([
            ['Dainik Azadi', '#'], ['Dainik Purbokone', '#'], ['Rajshahi News 24', '#'],
            ['Amader Comilla', '#'], ['Dainik Purbanchal', '#'], ['Gramer Kagoj', '#'],
            ['Daily Coxsbazar', '#'], ['Dainik Karatoa', '#'],
        ])],
        ['id' => 'world-english', 'title' => 'Top World Daily English Newspapers', 'items' => $make([
            ['The New York Times', 'https://www.nytimes.com'],
            ['The Guardian', 'https://www.theguardian.com'],
            ['The Washington Post', 'https://www.washingtonpost.com'],
            ['The Times of India', 'https://timesofindia.indiatimes.com'],
            ['The Hindu', 'https://www.thehindu.com'],
            ['Dawn', 'https://www.dawn.com'],
        ])],
        ['id' => 'share-market', 'title' => 'Bangladesh Share Market News Websites', 'items' => $make([
            ['DSE', 'https://www.dsebd.org'],
            ['CSE', 'https://www.cse.com.bd'],
            ['Share Biz', '#'],
            ['Stock Bangladesh', '#'],
        ])],
        ['id' => 'fm-radio', 'title' => 'All Bangla FM Radio', 'items' => $make([
            ['Radio Foorti', '#'], ['Radio Today', '#'], ['ABC Radio', '#'],
            ['Dhaka FM', '#'], ['Radio Shadhin', '#'], ['Bangladesh Betar', '#'],
        ])],
        ['id' => 'international-tv', 'title' => 'Important International TV Channels', 'items' => $make([
            ['BBC News', 'https://www.bbc.com/news'],
            ['Al Jazeera', 'https://www.aljazeera.com'],
            ['CNN', 'https://www.cnn.com'],
            ['Discovery', 'https://www.discovery.com'],
            ['Reuters News', 'https://www.reuters.com'],
            ['NDTV', 'https://www.ndtv.com'],
            ['Geo News', 'https://www.geo.tv'],
            ['Sky News', 'https://news.sky.com'],
            ['Euronews', 'https://www.euronews.com'],
            ['Press TV', 'https://www.presstv.ir'],
            ['CCTV', 'https://english.cctv.com'],
        ])],
        ['id' => 'indian-bengali', 'title' => 'Popular Indian and Kolkata Bengali Newspapers', 'items' => $make([
            ['Ananda Bazar Patrika', 'https://www.anandabazar.com'],
            ['Asomiya Pratidin', '#'], ['Aajkaal', '#'],
            ['Assam Tribune', 'https://www.assamtribune.com'],
            ['Kolkata24x7', '#'], ['Assamiya Khabor', '#'],
            ['ABP Ananda', '#'], ['News18 Assam', '#'],
            ['Sangbad Pratidin', '#'], ['Bartaman Patrika', '#'], ['Ei Samay', '#'],
        ]), 'note' => 'Indian Bengali newspapers, often searched as Kolkata newspapers, are published across West Bengal, Assam and Tripura.'],
        ['id' => 'magazines', 'title' => 'List of Top Bangla Magazines', 'items' => $make([
            ['Anannya', '#'], ['Bichitra', '#'], ['Sananda', '#'],
            ['Desh Patrika', '#'], ['Sachitra Sandhani', '#'], ['Ananda Alo', '#'],
        ])],
        ['id' => 'job-sites', 'title' => 'Top Bangla Job Sites in Bangladesh', 'items' => $make([
            ['Bdjobs', 'https://www.bdjobs.com'],
            ['Chakri.com', '#'],
            ['Skill Jobs', 'https://www.skill.jobs'],
            ['Jobs Bangladesh', '#'],
            ['Govt Job Circular', '#'],
        ])],
        ['id' => 'tech-sites', 'title' => 'Top Bangla Technology Websites', 'items' => $make([
            ['Tech Tunes', '#'], ['Tech Khobor', '#'], ['Bangla Tech News', '#'],
            ['Gadget & Gear', '#'], ['Tech Jagat', '#'], ['Mobile Dokan Blog', '#'],
        ])],
    ];

    // show an in-feed ad after every Nth section
    $adEvery = 2;
@endphp
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Bangla Newspapers, TV, Radio &amp; News Sites</title>
    <meta name="description" content="Read all Bangla newspapers, e-papers, online news portals, TV channels and radio in one place.">
    <style>
        :root {
            --blue: #078d57;
            --blue-dark: #079a36;
            --bg: #f4f5f7;
            --card: #ffffff;
            --line: #d9dde2;
            --text: #1d2733;
            --muted: #6b7684;
            --gold: #f0a63a;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; font-family: Arial, "Noto Sans Bengali", sans-serif; background: var(--bg); color: var(--text); }
        a { color: inherit; text-decoration: none; }

        /* top bar */
        .topbar { background: var(--blue); color: #fff; box-shadow: 0 2px 4px rgba(0,0,0,.25); position: sticky; top: 0; z-index: 20; }
        .topbar .in { max-width: 1240px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; padding: 0 16px; min-height: 54px; gap: 12px; }
        .brand { font-size: 22px; font-weight: 800; letter-spacing: .3px; }
        .brand small { font-size: 11px; font-weight: 600; display: block; line-height: 1; opacity: .9; }
        .menu { display: flex; gap: 4px; flex-wrap: wrap; justify-content: flex-end; }
        .menu a { padding: 16px 12px; font-size: 14px; font-weight: 700; }
        .menu a:hover, .menu a.active { background: rgba(255,255,255,.18); }

        .wrap { max-width: 1240px; margin: 0 auto; padding: 16px; }

        /* quick jump chips */
        .jump { display: flex; flex-wrap: wrap; gap: 8px; margin: 4px 0 18px; }
        .jump a { font-size: 13px; background: #fff; border: 1px solid var(--line); border-radius: 999px; padding: 6px 12px; }
        .jump a:hover { border-color: var(--blue); color: var(--blue); }

        /* sections */
        .block { margin-bottom: 26px; scroll-margin-top: 70px; }
        .block h2 { margin: 0 0 12px; padding-left: 12px; border-left: 6px solid var(--blue); font-size: 22px; color: var(--blue); }
        .panel { background: var(--card); border: 1px solid var(--line); padding: 14px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 12px; }

        .item { display: block; border: 1px solid var(--line); background: #fff; }
        .item:hover { border-color: var(--blue); box-shadow: 0 0 0 1px var(--blue); }
        .item .logo { height: 58px; display: flex; align-items: center; justify-content: center; padding: 6px 10px; }
        .item .logo img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .item .logo .txt { font-weight: 700; text-align: center; font-size: 15px; color: var(--blue-dark); }
        .item .name { background: #f5f5f5; border-top: 1px solid var(--line); text-align: center; font-size: 13px; padding: 6px 4px; }
        .item:hover .name { background: var(--blue); color: #fff; }

        .note { margin: 14px 2px 0; font-size: 14px; line-height: 1.5; color: var(--text); }
        .more { display: inline-block; margin-top: 10px; background: var(--blue); color: #fff; font-size: 13px; padding: 7px 12px; }

        /* ad slots */
        .ad { margin: 0 auto 26px; background: repeating-linear-gradient(45deg,#fafafa,#fafafa 10px,#f0f1f3 10px,#f0f1f3 20px); border: 1px dashed #b8bec6; color: var(--muted); display: flex; align-items: center; justify-content: center; text-align: center; font-size: 12px; overflow: hidden; }
        .ad span { background: rgba(255,255,255,.85); padding: 3px 8px; }
        .ad-leader { max-width: 970px; min-height: 90px; }
        .ad-feed   { max-width: 970px; min-height: 120px; }
        .ad-bottom { max-width: 970px; min-height: 90px; }
        @media (max-width: 600px) {
            .ad-leader, .ad-bottom { min-height: 100px; }
            .menu a { padding: 10px 8px; font-size: 13px; }
        }

        footer { background: #fff; border-top: 1px solid var(--line); text-align: center; padding: 18px 12px; font-size: 13px; color: var(--muted); }
        a:focus-visible { outline: 3px solid var(--gold); outline-offset: 2px; }
    </style>
</head>
<body>

<header class="topbar">
    <div class="in">
        <a href="{{ url('/') }}" class="brand">ALL BANGLA<small>NEWSPAPER</small></a>
        <nav class="menu" aria-label="Main">
            <a href="{{ url('/') }}" class="active">Home</a>
            <a href="#daily-newspapers">All Bangla Newspapers</a>
            <a href="#epapers">All Bangla epapers</a>
            <a href="#tv-channels">TV Channels</a>
            <a href="#fm-radio">Radio</a>
            <a href="/convatar">Bangla Convertar</a>
        </nav>
    </div>
</header>

<main class="wrap">

    {{-- AD: top leaderboard (728x90 / 970x90) --}}
    <div class="ad ad-leader" data-slot="home-top">
        <span>Advertisement &middot; 970&times;90</span>
        {{-- paste ad code here, e.g. AdSense --}}
    </div>

    @foreach ($sections as $section)
        <section class="block" id="{{ $section['id'] }}">
            <h2>{{ $section['title'] }}</h2>
            <div class="panel">
                <div class="grid">
                    @foreach ($section['items'] as $item)
                        <a class="item" href="{{ $item['url'] }}" target="_blank" rel="noopener nofollow" title="{{ $item['name'] }}">
                            <div class="logo">
                                <img src="{{ asset('images/logos/' . $item['slug'] . '.png') }}"
                                     alt="{{ $item['name'] }}" loading="lazy"
                                     onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                                <span class="txt" style="display:none">{{ $item['name'] }}</span>
                            </div>
                            <div class="name">{{ $item['name'] }}</div>
                        </a>
                    @endforeach
                </div>

                @if (!empty($section['note']))
                    <p class="note">{{ $section['note'] }}</p>
                    <a class="more" href="#">Browse more Indian Bengali newspapers</a>
                @endif
            </div>
        </section>

        {{-- AD: in-feed, after every {{ $adEvery }} sections --}}
        @if ($loop->iteration % $adEvery === 0 && !$loop->last)
            <div class="ad ad-feed" data-slot="home-feed-{{ $loop->iteration }}">
                <span>Advertisement &middot; 970&times;120</span>
                {{-- paste ad code here --}}
            </div>
        @endif
    @endforeach

    {{-- AD: bottom --}}
    <div class="ad ad-bottom" data-slot="home-bottom">
        <span>Advertisement &middot; 970&times;90</span>
    </div>
</main>

<footer>&copy; {{ date('Y') }} All Bangla Newspaper. All logos belong to their respective owners.</footer>

</body>
</html>