@extends('client.core.client')
@section('content')

@if (isset($topics) && $topics->count() > 0)
    <section id="topic" class="topic">
        <div class="container py-5">
            <div class="row g-3 justify-content-center">
                @foreach($topics as $topic)                
                    <div class="col-12 col-sm-4 col-md-2 d-flex justify-content-center position-relative">
                        @if (isset($topic->link) && $topic->link <> null)                            
                            <a href="{{$topic->link}}" class="position-absolute top-0 left-0 w-100 h-100" rel="noopener noreferrer"></a>
                        @endif
                        <div class="partner-card {{isset($topics) ? $topic->color : 'dark-background'}} border rounded-2 d-flex flex-column justify-content-center align-items-start gap-3 p-3 w-100">
                            @if ($topic->path_image <> null)                                
                                <img src="{{ asset('storage/' . $topic->path_image) }}" 
                                    alt="Logo do parceiro" 
                                    class="img-fluid" 
                                    loading="lazy"/>
                            @endif
                            <h2 class="montserrat-bold montserrat-bold font-18  mb-0 title-blue text-uppercase mb-0 text-white">{{$topic->title}}</h2>                            
                        </div>                        
                    </div>                                      
                @endforeach
            </div>
        </div>
    </section>
@endif

@if (isset($blogSuperHighlights) && $blogSuperHighlights <> null)
    <section class="blog mb-0 mt-5">
        <div class="container">
            <div class="row g-3 g-lg-4">
                <div class="col-lg-8 pe-0">
                    <!-- Swiper Main Carousel -->
                    <div class="swiper main-swiper">
                        <div class="swiper-wrapper">
                            @foreach($blogSuperHighlights as $blogSuperHighlight)
                                @php
                                    \Carbon\Carbon::setLocale('pt_BR');
                                    $dataFormatada = \Carbon\Carbon::parse($blogSuperHighlight->date)->translatedFormat('d \d\e F \d\e Y');
                                @endphp
                                <div class="swiper-slide">
                                    <article>
                                        <div class="position-relative overflow-hidden" style="height: 500px;">
                                            <img class="img-fluid h-100 w-100"
                                            src="{{ $blogSuperHighlight->path_image_thumbnail ? asset('storage/'.$blogSuperHighlight->path_image_thumbnail) : 'https://placehold.co/600x400?text=Sem+imagem&font=montserrat' }}"
                                            alt="{{ $blogSuperHighlight->path_image_thumbnail ? 'Notícia super destaque' : 'Sem imagem'}}"
                                            style="object-fit: cover; aspect-ratio: 1.91/1;">

                                            <div class="overlay">
                                                <div class="mb-2 d-flex justify-content-center align-items-center gap-1 flex-wrap">
                                                    <span class="badge background-red montserrat-semiBold font-12 text-uppercase py-2 px-2 me-2">{{$blogSuperHighlight->category->title}}</span>
                                                    <p class="text-white mb-0 montserrat-regular font-15">{{$dataFormatada}}</p>
                                                </div>
                                                <a href="{{route('blog-inner', ['slug' => $blogSuperHighlight->slug])}}">
                                                    <h1 class="h2 m-0 text-white text-uppercase montserrat-bold font-32 d-block">{{$blogSuperHighlight->title}}</h1>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach                    
                        </div>
                        <!-- Swiper pagination & navigation (optional) -->
                        <div class="swiper-pagination news"></div>
                    </div>
                </div>
                @if ($blogHighlights->count())            
                    <div class="col-lg-4 ps-2">
                        <div class="row g-2">
                            <!-- Static small boxes as before -->
                            @foreach($blogHighlights as $blogHighlight)
                                @php
                                    \Carbon\Carbon::setLocale('pt_BR');
                                    $dataFormatada = \Carbon\Carbon::parse($blogHighlight->date)->translatedFormat('d \d\e F \d\e Y');
                                @endphp
                                <div class="col-md-12 box-small">
                                    <article>
                                        <div class="position-relative overflow-hidden" style="height: 246px;">
                                            <img class="img-fluid h-100 w-100"
                                            src="{{ $blogHighlight->path_image_thumbnail ? asset('storage/'.$blogHighlight->path_image_thumbnail) : 'https://placehold.co/600x400?text=Sem+imagem&font=montserrat' }}"
                                            alt="{{ $blogHighlight->title ? $blogHighlight->title : 'Sem imagem'}}"
                                            style="object-fit: cover; aspect-ratio: 1 / 1;">
                                            <div class="overlay">
                                                <div class="mb-2 d-flex justify-content-start align-items-center gap-1 flex-wrap">
                                                    <span class="badge background-red text-uppercase montserrat-semiBold font-12 py-2 px-2 me-2">{{$blogHighlight->category->title}}</span>
                                                    <p class="text-white mb-0 montserrat-regular font-12">{{$dataFormatada}}</p>
                                                </div>
                                                <a href="{{route('blog-inner', ['slug' => $blogHighlight->slug])}}">                              
                                                    <h2 class="h6 m-0 text-white text-uppercase montserrat-bold font-16 d-block">{{$blogHighlight->title}}</h2>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif

@if (isset($recentCategories) || isset($events))
    <section class="news-home py-5">
        <div class="container">
            <div class="row">
                @if ($recentCategories->count() > 0)                    
                    <div class="col-12 col-lg-9 animate-on-scroll mb-3" data-animation="animate__fadeInLeft">
                        <div class="border-bottom news mb-4">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end">
                                <h2 class="section-title d-table px-4 py-2 w-auto m-0 montserrat-bold font-18 title-blue text-uppercase rounded-top-left">
                                    Últimas notícias
                                </h2>

                                <nav class="mt-3 mt-md-0">
                                    <ul class="list-unstyled d-flex flex-row flex-wrap gap-2 gap-md-3 justify-content-start justify-content-md-center mb-0">
                                        <li class="py-1 py-sm-2 px-2 px-sm-3 text-uppercase montserrat-semiBold font-14 text-white background-red active">
                                            <a href="javascript:void(0)" class="text-decoration-none text-white category-filter" data-category="todas">
                                                Todas
                                            </a>
                                        </li>
                                        
                                        @foreach($recentCategories as $index => $category)
                                            <li class="py-2 px-1 px-sm-3 text-uppercase montserrat-semiBold font-14 text-black">
                                                <a href="javascript:void(0)" class="text-decoration-none text-black category-filter" data-category="{{ $category->slug }}">
                                                    {{ $category->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div id="news-container">
                            @include('client.ajax.filter-blog-homePage', [
                                'featuredNews' => $featuredNews,
                                'latestNews' => $latestNews
                            ])
                        </div>
                    </div>
                @endif
                @if ($events->count() > 0)                    
                    <div class="col-lg-3" data-aos="fade-left" data-aos-delay="100">
                        <div class="section-title mb-0 rounded-top-left">
                            <h3 class="m-0 text-uppercase montserrat-bold font-18 title-blue">Agenda</h3>
                        </div>

                        <div class="bg-white p-3">      
                            @foreach($events as $event)                        
                                <article>
                                    <div class="d-flex align-items-center bg-white mb-3 overflow-hidden" style="height: 80px;">
                                        <div class="date col-4 h-100 d-flex justify-content-center align-items-center flex-column border border-right-1">
                                            <span class="montserrat-bold w-100 h-50 d-flex justify-content-center align-items-center font-20 title-blue">
                                                {{ \Carbon\Carbon::parse($event->date)->format('d') }}
                                            </span>
                                            <span class="montserrat-medium w-100 h-50 d-flex justify-content-center align-items-center font-14 title-blue background-red text-white">
                                                {{ ucfirst(\Carbon\Carbon::parse($event->date)->translatedFormat('F')) }}
                                            </span>
                                        </div>
                                        <div class="col-8 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                                            @if($event->link)
                                                <a href="{{ $event->link }}" class="underline">
                                            @else
                                                <a href="{{ route('client.event') }}?event_id={{ $event->id }}&scroll=true" class="underline">
                                            @endif
                                                <h3 class="h6 m-0 montserrat-bold font-14 title-blue" title="{{$event->title}}">
                                                    {{ substr(strip_tags($event->title), 0, 50) }}...
                                                </h3>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach              
                            <div class="btn-about d-table m-auto mt-5">
                                <a href="{{route('client.event')}}" class="background-red montserrat-semiBold font-18 py-2 px-4 rounded-5">Ver todos</a>
                            </div>                      
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif

@if ($announcements->count())                        
    <div class="mb-3">
        @include('client.includes.announcement')
    </div>
@endif

@if (!empty($videos) && $videos->count() > 0)
    <section class="video">
        <div class="container-fluid p-0">
            <div class="content-video d-flex justify-content-center align-items-center bg-black">
                <!-- Lista -->
                <div class="left col-5 dark-background h-100 d-flex justify-content-center align-items-end flex-column position-relative">
                    <div class="swiper mySwiper position-relative">
                        <div class="swiper-wrapper py-4 flex-column align-items-start justify-content-start m-auto position-relative">
                            @foreach($videos as $video)
                                <div class="swiper-slide align-items-center mb-3 justify-content-start"
                                    data-video="{{ $video->link }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="external-icon" viewBox="0 0 28.57 20" focusable="false" style="pointer-events: none; display: block; width: 35px; height: auto;">
                                        <svg viewBox="0 0 28.57 20" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="M27.9727 3.12324C27.6435 1.89323 26.6768 0.926623 25.4468 0.597366C23.2197 2.24288e-07 14.285 0 14.285 0C14.285 0 5.35042 2.24288e-07 3.12323 0.597366C1.89323 0.926623 0.926623 1.89323 0.597366 3.12324C2.24288e-07 5.35042 0 10 0 10C0 10 2.24288e-07 14.6496 0.597366 16.8768C0.926623 18.1068 1.89323 19.0734 3.12323 19.4026C5.35042 20 14.285 20 14.285 20C14.285 20 23.2197 20 25.4468 19.4026C26.6768 19.0734 27.6435 18.1068 27.9727 16.8768C28.5701 14.6496 28.5701 10 28.5701 10C28.5701 10 28.5677 5.35042 27.9727 3.12324Z" fill="#FF0000"></path>
                                                <path d="M11.4253 14.2854L18.8477 10.0004L11.4253 5.71533V14.2854Z" fill="white"></path>
                                            </g>
                                        </svg>
                                    </svg>
                                    <h3 class="title montserrat-medium font-16 mb-0 col-10">
                                        {{ $video->title ?? 'Vídeo' }}
                                    </h3>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="nav-video position-absolute d-flex flex-column align-items-end me-5">
                        <div class="swiper-button-up">▲</div>
                        <div class="swiper-button-down">▼</div>
                    </div>
                </div>

                <!-- Player -->
                <div class="right col-7 bg-black d-flex justify-content-center align-items-center">
                    <iframe id="videoPlayer" class="w-100 h-100"
                            src=""
                            title="Vídeo"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
@endif

@if (isset($trendingCategories) && $trendingCategories->count() > 0)
    <section class="category-blog-home py-0 mt-5">
        <div class="container-fluid p-0">
            <div class="row g-3 justify-content-start">
                @foreach($trendingCategories as $trendingCategory)                
                    <div class="col-6 col-sm-4 col-md-2 d-flex justify-content-center p-0 mt-0">
                        <div class="box-category text-center w-100 position-relative overflow-hidden">
                            @if (isset($trendingCategory->path_image) && $trendingCategory->path_image <> null)
                                <img src="{{asset('storage/' . $trendingCategory->path_image)}}" alt="" class="w-100 img-fluid mx-auto">
                                @else
                                <img src="{{asset('build/client/images/category-blog.png')}}" alt="" class="w-100 img-fluid mx-auto">
                            @endif
                            <div class="overlay">
                                <a href="{{ route('blog', ['category' => $trendingCategory->slug]) }}#news" class="w-100 text-center">
                                    <h4 class="title montserrat-semiBold font-18 text-white mt-2">{{$trendingCategory->title}}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@include('client.includes.complaint')

@include('client.includes.social')

<script>
    const section = document.querySelector('section.video');
    if (section) {
        const wrapper = section.querySelector('.mySwiper .swiper-wrapper');
        const slides  = Array.from(section.querySelectorAll(".mySwiper .swiper-slide"));
        const player  = section.querySelector("#videoPlayer");

        let currentIndex = 0;
        let firstLoad = true;

        // Normaliza URL (adiciona protocolo se vier //)
        function norm(url) {
            if (!url) return "";
            return url.startsWith("//") ? window.location.protocol + url : url;
        }

        // Converte para URL de embed (YouTube / Vimeo)
        function toEmbed(rawUrl) {
            const urlStr = norm(rawUrl);
            if (!urlStr) return "";

            let u;
            try { u = new URL(urlStr); } catch { return urlStr; }

            const host = u.hostname.replace(/^www\./, "");

            // YouTube
            if (host.includes("youtube.com") || host.includes("youtu.be")) {
                // Se já for /embed/ mantém
                if (u.pathname.startsWith("/embed/")) return u.toString();

                // youtu.be/<id>
                if (host === "youtu.be" && u.pathname.length > 1) {
                    const id = u.pathname.split("/")[1];
                    return `https://www.youtube.com/embed/${id}`;
                }

                // shorts -> converte para embed
                if (u.pathname.startsWith("/shorts/")) {
                    const id = u.pathname.split("/")[2] || u.pathname.split("/")[1];
                    return `https://www.youtube.com/embed/${id}`;
                }

                // watch?v=<id>
                const v = u.searchParams.get("v");
                if (v) return `https://www.youtube.com/embed/${v}`;

                // /live/<id> ou /v/<id> etc.
                const parts = u.pathname.split("/").filter(Boolean);
                if (parts.length >= 2) {
                    const id = parts.pop();
                    return `https://www.youtube.com/embed/${id}`;
                }
            }

            // Vimeo
            if (host.includes("vimeo.com")) {
                // Se já for player.vimeo.com
                if (host === "player.vimeo.com") return u.toString();

                // Extrai o último segmento numérico como ID
                const parts = u.pathname.split("/").filter(Boolean);
                const last = parts[parts.length - 1];
                if (/^\d+$/.test(last)) {
                    return `https://player.vimeo.com/video/${last}`;
                }
            }

            // Desconhecido: retorna original
            return urlStr;
        }

        function setActiveByIndex(index, userTriggered = false) {
            if (index < 0 || index >= slides.length) return;

            slides.forEach(s => s.classList.remove("active"));
            const slide = slides[index];
            slide.classList.add("active");

            const raw = slide.getAttribute("data-video");
            const embedUrl = toEmbed(raw);
            if (embedUrl) player.src = embedUrl;

            currentIndex = index;

            if (!firstLoad || userTriggered) {
                slide.scrollIntoView({ behavior: "smooth", block: "nearest" });
            }
        }

        // Clique em um item
        slides.forEach((slide, idx) => {
            slide.addEventListener("click", () => setActiveByIndex(idx, true));
        });

        // Inicia no primeiro (sem rolagem)
        if (slides.length > 0) setActiveByIndex(0);

        // Libera rolagem depois do load
        window.addEventListener("load", () => {
            setTimeout(() => { firstLoad = false; }, 500);
        });

        // Navegação ↑ ↓
        const btnUp = section.querySelector(".swiper-button-up");
        const btnDown = section.querySelector(".swiper-button-down");

        btnUp && btnUp.addEventListener("click", () => {
            if (currentIndex > 0) setActiveByIndex(currentIndex - 1, true);
        });
        btnDown && btnDown.addEventListener("click", () => {
            if (currentIndex < slides.length - 1) setActiveByIndex(currentIndex + 1, true);
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryLinks = document.querySelectorAll('.category-filter');
        const newsContainer = document.getElementById('news-container');

        categoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Ativar/desativar classes visuais
                categoryLinks.forEach(l => {
                    l.parentElement.classList.remove('active', 'text-white', 'background-red');
                    l.parentElement.classList.add('text-black');
                    l.classList.remove('text-white');
                    l.classList.add('text-black');
                });

                this.parentElement.classList.add('active', 'text-white', 'background-red');
                this.parentElement.classList.remove('text-black');
                this.classList.add('text-white');
                this.classList.remove('text-black');

                const categorySlug = this.getAttribute('data-category');
                
                // Loading indicator
                newsContainer.innerHTML = `
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-blue" role="status">
                            <span class="visually-hidden montserrat-semiBold font-15">Carregando...</span>
                        </div>
                        <p class="mt-2 montserrat-semiBold font-15">Carregando notícias...</p>
                    </div>
                `;

                // Fazer requisição AJAX
                fetch(`blog/filter/${categorySlug}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na rede');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            newsContainer.innerHTML = data.html;
                        } else {
                            throw new Error(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        newsContainer.innerHTML = `
                            <div class="col-12 text-center py-5">
                                <p class="text-danger montserrat-semiBold font-15">Erro ao carregar notícias: ${error.message}</p>
                            </div>
                        `;
                    });
            });
        });
    });
</script>
@endsection
