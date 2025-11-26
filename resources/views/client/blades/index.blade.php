@extends('client.core.client')
@section('content')

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
                                                <div class="mb-3 d-flex justify-content-center align-items-center gap-1 flex-wrap">
                                                    <span class="badge rounded-0 background-red montserrat-semiBold font-12 text-uppercase py-2 px-2 me-2">{{$blogSuperHighlight->category->title}}</span>                                   
                                                </div>
                                                <a href="{{route('blog-inner', ['slug' => $blogSuperHighlight->slug])}}">
                                                    <h1 class="h2 m-0 text-white montserrat-bold font-32 d-block">{{$blogSuperHighlight->title}}</h1>
                                                </a>
                                                <div class="description-blog mt-2">{!!substr(strip_tags($blogSuperHighlight->text), 0, 400)!!}...</div>

                                                <div class="d-flex justify-content-between gap-2 align-items-center w-100">
                                                    <p class="text-white mt-3 montserrat-regular font-15 col-8 col-lg-10">{{$dataFormatada}}</p>

                                                    <div id="socialLinks-{{$blogSuperHighlight->id}}" class="social-links home opacity-0">
                                                        <div class="d-flex gap-2">
                                                            <a href="https://api.whatsapp.com/send?text={{ urlencode($blogSuperHighlight->title . ' ' . url()->current()) }}" target="_blank" class="rounded-circle btn btn-sm bg-whatsapp bg-transparent p-0"><i class="fab fa-whatsapp text-white"></i></a>    
                                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blogSuperHighlight->title) }}" target="_blank" class="rounded-circle btn btn-sm btn-twiter bg-transparent p-0"><i class="fab fa-x-twitter text-white"></i></a>
                                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="rounded-circle btn btn-facebook btn-sm bg-transparent p-0"><i class="fab fa-facebook-f text-white"></i></a>
                                                        </div>
                                                    </div>  

                                                    <button id="shareBtn-{{$blogSuperHighlight->id}}" 
                                                            data-target="socialLinks-{{$blogSuperHighlight->id}}"
                                                            class="share-button d-flex">
                                                        <svg width="24" height="26" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.28845 8.58841C1.92459 8.58841 0 10.5692 0 13.002C0 15.4348 1.92459 17.4155 4.28845 17.4155C5.68567 17.4155 6.92779 16.7195 7.70969 15.6506L15.6837 20.0897C15.5186 20.5571 15.4231 21.0603 15.4231 21.5864C15.4231 24.0193 17.3477 26 19.7115 26C22.0754 26 24 24.0193 24 21.5864C24 19.1536 22.0754 17.1729 19.7115 17.1729C18.3143 17.1729 17.0722 17.8689 16.2903 18.9378L8.31633 14.4987C8.48136 14.0313 8.57691 13.5281 8.57691 12.9982C8.57691 12.4682 8.47516 11.9356 8.3002 11.4554L16.2033 6.94346C16.9789 8.08134 18.262 8.82714 19.71 8.82714C22.0739 8.82714 23.9985 6.84639 23.9985 4.41357C23.9985 1.98074 22.0739 0 19.71 0C17.3462 0 15.4216 1.98074 15.4216 4.41357C15.4216 4.88736 15.4973 5.34584 15.6313 5.77367L7.67731 10.3151C6.89306 9.26915 5.66339 8.58848 4.28466 8.58848L4.28845 8.58841ZM19.7148 18.4846C21.3788 18.4846 22.7326 19.8779 22.7326 21.5905C22.7326 23.303 21.3788 24.6963 19.7148 24.6963C18.0508 24.6963 16.697 23.303 16.697 21.5905C16.697 21.0605 16.8273 20.5611 17.0556 20.1231C17.0556 20.1231 17.0594 20.1167 17.0618 20.1167C17.0618 20.1129 17.0618 20.1065 17.068 20.1039C17.583 19.1397 18.5732 18.4859 19.7136 18.4859L19.7148 18.4846ZM19.7148 1.30799C21.3788 1.30799 22.7326 2.70127 22.7326 4.41383C22.7326 6.12639 21.3788 7.51967 19.7148 7.51967C18.0508 7.51967 16.697 6.12639 16.697 4.41383C16.697 2.70127 18.0508 1.30799 19.7148 1.30799ZM4.28845 16.1081C2.62444 16.1081 1.27065 14.7149 1.27065 13.0023C1.27065 11.2897 2.62444 9.89646 4.28845 9.89646C5.95247 9.89646 7.30626 11.2897 7.30626 13.0023C7.30626 13.5348 7.17596 14.0355 6.94393 14.4735C6.94393 14.4735 6.94393 14.4773 6.94021 14.4799C6.94021 14.4799 6.94021 14.4863 6.93648 14.4863C6.42524 15.4504 5.42758 16.1081 4.28724 16.1081L4.28845 16.1081Z" fill="white"/>
                                                        </svg>
                                                    </button>   
                                                </div>
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
                                                    <span class="badge rounded-0 background-red text-uppercase montserrat-semiBold font-12 py-2 px-2 me-2">{{$blogHighlight->category->title}}</span>
                                                </div>
                                                <a href="{{route('blog-inner', ['slug' => $blogHighlight->slug])}}">                              
                                                    <h2 class="h6 m-0 text-white montserrat-bold font-20 d-block">{{$blogHighlight->title}}</h2>
                                                </a>
                                                <div class="d-flex justify-content-between align-items-center w-100">
                                                    <p class="text-white mt-3 montserrat-regular font-14 col-8">{{$dataFormatada}}</p>
                                                    
                                                    <div id="socialLinks-{{$blogHighlight->id}}" class="social-links home opacity-0">
                                                        <div class="d-flex gap-2">
                                                            <a href="https://api.whatsapp.com/send?text={{ urlencode($blogHighlight->title . ' ' . url()->current()) }}" target="_blank" class="rounded-circle btn btn-sm bg-whatsapp bg-transparent p-0"><i class="fab fa-whatsapp text-white"></i></a>    
                                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blogHighlight->title) }}" target="_blank" class="rounded-circle btn btn-sm btn-twiter bg-transparent p-0"><i class="fab fa-x-twitter text-white"></i></a>
                                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="rounded-circle btn btn-facebook btn-sm bg-transparent p-0"><i class="fab fa-facebook-f text-white"></i></a>
                                                        </div>
                                                    </div>  

                                                    <button id="shareBtn-{{$blogHighlight->id}}" 
                                                            data-target="socialLinks-{{$blogHighlight->id}}"
                                                            class="share-button d-flex">
                                                        <svg width="18" height="20" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.28845 8.58841C1.92459 8.58841 0 10.5692 0 13.002C0 15.4348 1.92459 17.4155 4.28845 17.4155C5.68567 17.4155 6.92779 16.7195 7.70969 15.6506L15.6837 20.0897C15.5186 20.5571 15.4231 21.0603 15.4231 21.5864C15.4231 24.0193 17.3477 26 19.7115 26C22.0754 26 24 24.0193 24 21.5864C24 19.1536 22.0754 17.1729 19.7115 17.1729C18.3143 17.1729 17.0722 17.8689 16.2903 18.9378L8.31633 14.4987C8.48136 14.0313 8.57691 13.5281 8.57691 12.9982C8.57691 12.4682 8.47516 11.9356 8.3002 11.4554L16.2033 6.94346C16.9789 8.08134 18.262 8.82714 19.71 8.82714C22.0739 8.82714 23.9985 6.84639 23.9985 4.41357C23.9985 1.98074 22.0739 0 19.71 0C17.3462 0 15.4216 1.98074 15.4216 4.41357C15.4216 4.88736 15.4973 5.34584 15.6313 5.77367L7.67731 10.3151C6.89306 9.26915 5.66339 8.58848 4.28466 8.58848L4.28845 8.58841ZM19.7148 18.4846C21.3788 18.4846 22.7326 19.8779 22.7326 21.5905C22.7326 23.303 21.3788 24.6963 19.7148 24.6963C18.0508 24.6963 16.697 23.303 16.697 21.5905C16.697 21.0605 16.8273 20.5611 17.0556 20.1231C17.0556 20.1231 17.0594 20.1167 17.0618 20.1167C17.0618 20.1129 17.0618 20.1065 17.068 20.1039C17.583 19.1397 18.5732 18.4859 19.7136 18.4859L19.7148 18.4846ZM19.7148 1.30799C21.3788 1.30799 22.7326 2.70127 22.7326 4.41383C22.7326 6.12639 21.3788 7.51967 19.7148 7.51967C18.0508 7.51967 16.697 6.12639 16.697 4.41383C16.697 2.70127 18.0508 1.30799 19.7148 1.30799ZM4.28845 16.1081C2.62444 16.1081 1.27065 14.7149 1.27065 13.0023C1.27065 11.2897 2.62444 9.89646 4.28845 9.89646C5.95247 9.89646 7.30626 11.2897 7.30626 13.0023C7.30626 13.5348 7.17596 14.0355 6.94393 14.4735C6.94393 14.4735 6.94393 14.4773 6.94021 14.4799C6.94021 14.4799 6.94021 14.4863 6.93648 14.4863C6.42524 15.4504 5.42758 16.1081 4.28724 16.1081L4.28845 16.1081Z" fill="white"/>
                                                        </svg>
                                                    </button>                                                                                                      
                                                </div>
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
                        <div class="border-bottom news mb-0">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end">
                                <h2 class="section-title d-table p-0 w-auto m-0 mb-3 montserrat-bold font-18 title-blue text-uppercase">
                                    Últimas notícias
                                </h2>                                
                            </div>
                        </div>
                        <nav class="mt-3">
                            <ul class="list-unstyled d-flex flex-row flex-wrap gap-2 gap-md-3 justify-content-start mb-0">
                                <li class="py-1 py-sm-2 px-2 px-sm-3 text-uppercase montserrat-semiBold font-14 text-white bg-blue-light background-red active">
                                    <a href="javascript:void(0)" class="text-decoration-none text-white category-filter" data-category="todas">
                                        Todas
                                    </a>
                                </li>
                                
                                @foreach($recentCategories as $index => $category)
                                    <li class="py-2 px-1 px-sm-3 text-uppercase montserrat-semiBold font-14 text-black bg-blue-light">
                                        <a href="javascript:void(0)" class="text-decoration-none text-black category-filter" data-category="{{ $category->slug }}">
                                            {{ $category->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>

                        <div id="news-container" class="mt-5 border p-5 bg-white rounded-2">
                            @include('client.ajax.filter-blog-homePage', [
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
