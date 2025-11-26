! function() {
    "use strict";
    let e = document.querySelector("#preloader");

    function t() {
        AOS.init({
            duration: 600,
            easing: "ease-in-out",
            once: !0,
            mirror: !1
        })
    }
    e && window.addEventListener("load", (() => {
        e.remove()
    })), window.addEventListener("load", t);
    let o = document.querySelector(".typed");
    if (o) {
        let e = o.getAttribute("data-typed-items");
        e = e.split(","), new Typed(".typed", {
            strings: e,
            loop: !0,
            typeSpeed: 100,
            backSpeed: 50,
            backDelay: 2e3
        })
    }
    let n = document.querySelector(".scroll-top");
    n.addEventListener("click", (e => {
        e.preventDefault(), window.scrollTo({
            top: 0,
            behavior: "smooth"
        })
    })), document.addEventListener("scroll", (function() {
        n && (window.scrollY > 100 ? n.classList.add("active") : n.classList.remove("active"))
    })), document.querySelectorAll(".skills-animation").forEach((e => {
        new Waypoint({
            element: e,
            offset: "80%",
            handler: function(t) {
                e.querySelectorAll(".progress .progress-bar").forEach((e => {
                    e.style.width = e.getAttribute("aria-valuenow") + "%"
                }))
            }
        })
    })), document.querySelectorAll(".isotope-layout").forEach((function(e) {
        let o, n = e.getAttribute("data-layout") ?? "masonry",
            i = e.getAttribute("data-default-filter") ?? "*",
            r = e.getAttribute("data-sort") ?? "original-order";
        imagesLoaded(e.querySelector(".isotope-container"), (function() {
            o = new Isotope(e.querySelector(".isotope-container"), {
                itemSelector: ".isotope-item",
                layoutMode: n,
                filter: i,
                sortBy: r
            })
        })), e.querySelectorAll(".isotope-filters li").forEach((function(n) {
            n.addEventListener("click", (function() {
                e.querySelector(".isotope-filters .filter-active").classList.remove("filter-active"), this.classList.add("filter-active"), o.arrange({
                    filter: this.getAttribute("data-filter")
                }), t()
            }), !1)
        }))
    })), window.addEventListener("load", (function() {
        document.querySelectorAll(".init-swiper").forEach((function(e) {
            let t = JSON.parse(e.querySelector(".swiper-config").innerHTML.trim());
            e.classList.contains("swiper-tab") ? initSwiperWithCustomPagination(e, t) : new Swiper(e, t)
        }))
    })), window.addEventListener("load", (function(e) {
        window.location.hash && document.querySelector(window.location.hash) && setTimeout((() => {
            let e = document.querySelector(window.location.hash),
                t = getComputedStyle(e).scrollMarginTop;
            window.scrollTo({
                top: e.offsetTop - parseInt(t),
                behavior: "smooth"
            })
        }), 100)
    }));
    let i = document.querySelectorAll(".navmenu a");

    function r() {
        i.forEach((e => {
            if (!e.hash) return;
            let t = document.querySelector(e.hash);
            if (!t) return;
            let o = window.scrollY + 200;
            o >= t.offsetTop && o <= t.offsetTop + t.offsetHeight ? (document.querySelectorAll(".navmenu a.active").forEach((e => e.classList.remove("active"))), e.classList.add("active")) : e.classList.remove("active")
        }))
    }
    window.addEventListener("load", r), document.addEventListener("scroll", r), window.addEventListener("load", (function() {
        document.addEventListener("scroll", (function() {
            let e = document.querySelector(".laptop-parallax");
            if (!e) return;
            let t = document.querySelector(".content-project"),
                o = t.getBoundingClientRect().top;
            if (o < window.innerHeight && o > -t.offsetHeight) {
                let t = .3 * o;
                t = Math.max(-15, Math.min(15, t)), e.style.transform = `translateY(${t}px)`
            }
        }))
    }));

    function l() {
        if (window.innerWidth <= 885) {
            document.querySelectorAll("[data-aos]").forEach((e => {
                e.removeAttribute("data-aos"), e.removeAttribute("data-aos-delay"), e.classList.remove("aos-animate", "aos-init")
            }));
            let e = document.createElement("style");
            e.innerHTML = "\n              \n          ", document.head.appendChild(e), "undefined" != typeof AOS && AOS.refresh && AOS.refresh()
        }
    }
    document.addEventListener("DOMContentLoaded", l), window.addEventListener("resize", l),
        document.addEventListener("DOMContentLoaded", (function() {
            document.querySelectorAll('a[href^="#"]').forEach((function(e) {
                e.addEventListener("click", (function(e) {
                    e.preventDefault();
                    let t = this.getAttribute("href");
                    if (t.length > 1) {
                        let e = document.querySelector(t);
                        e && window.scrollTo({
                            top: e.offsetTop,
                            behavior: "smooth"
                        })
                    } else window.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    })
                }))
            }))
        }))

    document.addEventListener('DOMContentLoaded', function() {
        const swiperAnuncio = new Swiper('.announcement-mobile', {
            loop: true,
            speed: 1200,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
        const swiperAnuncioDesk = new Swiper('.announcement-desktop', {
            loop: true,
            speed: 1200,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });

        const swiperAnuncioVertical = new Swiper('.announcementVertical', {
            loop: true,
            speed: 1200,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    });

    document.querySelectorAll('[id^="shareBtn-"]').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.id.replace('shareBtn-', '');
            const links = document.getElementById('socialLinks-' + itemId);
            if (links) {
                links.classList.toggle('opacity-0');
            }
        });
    });

    
    //Menu mobile
    const s = document.getElementById("menu-toggle"),
        a = document.getElementById("menu-mobile"),
        c = document.getElementById("menu-close"),
        d = document.querySelector(".btn_sidebar"); // botão do menu inferior

    s.addEventListener("click", function () {
        const e = a.classList.toggle("active");
        document.body.style.overflow = e ? "hidden" : "";
    });

    c.addEventListener("click", function () {
        a.classList.remove("active");
        document.body.style.overflow = "";
    });

    d.addEventListener("click", function () {
        const e = a.classList.toggle("active");
        document.body.style.overflow = e ? "hidden" : "";
    });

    a.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", function(e) {
            const href = this.getAttribute("href");
            if (href && href.startsWith("#")) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: "smooth" });
                }
                a.classList.remove("active");
                document.body.style.overflow = "";
            }
        });
    });

    //Mascara de telefone
    const phoneInput = document.getElementById("phone");
    phoneInput && phoneInput.addEventListener("input", (function(e) {
        let t = e.target.value.replace(/\D/g, "");
        t.length > 11 && (t = t.slice(0, 11));
        t.length > 0 && (t = "(" + t);
        t.length > 3 && (t = t.slice(0, 3) + ") " + t.slice(3));
        t.length > 10 && (t = t.slice(0, 10) + "-" + t.slice(10));
        e.target.value = t;
    }));

    //Ckeditor do comentario
    document.addEventListener('DOMContentLoaded', function () {
        const textarea = document.getElementById('message');

        if (textarea && !CKEDITOR.instances[textarea.id]) {
            CKEDITOR.replace(textarea.id, {
                toolbar: [
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', 'Blockquote'] }
                ],
                removePlugins: 'link,image,flash,table,iframe,uploadimage,uploadfile,mediaembed,cloudservices,ckbox,notification,clipboard'
            });

            CKEDITOR.instances[textarea.id].on('instanceReady', function () {
                const tryRemoveNotification = setInterval(() => {
                    const notif = document.querySelector('#cke_notifications_area_message');
                    if (notif) {
                        notif.remove();
                        clearInterval(tryRemoveNotification);
                    }
                }, 100);
                setTimeout(() => clearInterval(tryRemoveNotification), 2000);
            });
        }

        const form = document.querySelector('#commentForm');
        if (form) {
            form.addEventListener('submit', function () {
                for (let instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            });
        }
    });

    $("body").on("click", ".dropify-clear", function () {
        var nameInput = $(this).parent().find("input:first").attr("name");
        $(this).parent().find(`input[name=delete_${nameInput}]`).remove();
        $(this)
            .parent()
            .find(`.preview-image`)
            .css("background-image", "url()");
        $(this).parent().find(`.content-area-image-crop`).show();
        $(this)
            .parent()
            .append(
                `<input type="hidden" name="delete_${nameInput}" value="${nameInput}" />`
            );
    });

    //Script de audio do blog
    document.addEventListener('DOMContentLoaded', function() {
        let isPaused = false;
        let isReading = false;
        let progressInterval;
        let estimatedDuration = 0;
        let progressPercentage = 0;
        let synth = window.speechSynthesis;
        let currentBlockIndex = 0;
        let utterance;
        let textBlocks = [];
        let rate = 1; 
        let volume = 1; 

        const icon = document.getElementById('audioIcon');
        const progressBar = document.getElementById('progressBar');
        const statusText = document.getElementById('audioStatus');
        const speedLabel = document.getElementById('speedLabel');
        const increaseSpeedBtn = document.getElementById('increaseSpeed');
        const decreaseSpeedBtn = document.getElementById('decreaseSpeed');

        // Volume
        const volumeSlider = document.getElementById('volumeSlider');

        window.addEventListener('beforeunload', function() {
            if (synth) synth.cancel();
        });

        function splitTextIntoBlocks(text, wordsPerBlock = 100) {
            const words = text.split(/\s+/);
            let blocks = [];
            for (let i = 0; i < words.length; i += wordsPerBlock) {
                blocks.push(words.slice(i, i + wordsPerBlock).join(' '));
            }
            return blocks;
        }

        function updateProgressBar(duration) {
            const intervalTime = 100;
            const totalTicks = duration / intervalTime;
            let currentTick = progressPercentage / 100 * totalTicks;

            clearInterval(progressInterval);
            progressInterval = setInterval(() => {
                if (currentTick >= totalTicks || isPaused) {
                    clearInterval(progressInterval);
                } else {
                    currentTick++;
                    progressPercentage = (currentTick / totalTicks) * 100;
                    progressBar.style.width = progressPercentage + '%';
                }
            }, intervalTime);
        }

        async function speakBlock(block) {
            if (!('speechSynthesis' in window)) {
                alert('Seu navegador não suporta texto para fala.');
                return;
            }

            statusText.innerText = "Carregando áudio...";
            icon.classList.add('fa-spin');

            await new Promise(resolve => {
                const voices = synth.getVoices();
                if (voices.length === 0) {
                    synth.onvoiceschanged = resolve;
                } else {
                    resolve();
                }
            });

            icon.classList.remove('fa-spin');
            statusText.innerText = "Lendo...";

            utterance = new SpeechSynthesisUtterance(block);
            const voices = synth.getVoices();
            utterance.voice = voices.find(v => v.name === 'Google português do Brasil') || voices[0];
            utterance.lang = 'pt-BR';
            utterance.rate = rate; 
            utterance.volume = volume; // aplica volume

            utterance.onend = function() {
                currentBlockIndex++;
                if (currentBlockIndex < textBlocks.length && !isPaused) {
                    speakBlock(textBlocks[currentBlockIndex]);
                } else {
                    isReading = false;
                    isPaused = false;
                    icon.classList.remove('fa-pause');
                    icon.classList.add('fa-play');
                    clearInterval(progressInterval);
                    progressBar.style.width = '100%';
                    statusText.innerText = "Clique para ouvir";
                }
            };

            synth.speak(utterance);
            isReading = true;
            updateProgressBar(estimatedDuration / textBlocks.length);
        }

        function readAllTextByClass(className) {
            if (synth) synth.cancel();

            const elements = document.getElementsByClassName(className);
            let fullText = '';
            for (let i = 0; i < elements.length; i++) {
                fullText += elements[i].innerText || elements[i].textContent;
                fullText += ' ';
            }

            const wordCount = fullText.split(/\s+/).length;
            estimatedDuration = (wordCount / 150) * 60 * 1000;

            textBlocks = splitTextIntoBlocks(fullText, 200);
            currentBlockIndex = 0;

            speakBlock(textBlocks[currentBlockIndex]);
        }

        window.togglePlayPause = function() {
            if (isReading && !isPaused) {
                synth.pause();
                isPaused = true;
                icon.classList.remove('fa-pause');
                icon.classList.add('fa-play');
                statusText.innerText = "Pausado";
            } else if (isPaused) {
                synth.resume();
                isPaused = false;
                icon.classList.remove('fa-play');
                icon.classList.add('fa-pause');
                statusText.innerText = "Lendo...";
                updateProgressBar(estimatedDuration * (1 - progressPercentage / 100));
            } else if (!isReading) {
                readAllTextByClass('text-audio');
                icon.classList.remove('fa-play');
                icon.classList.add('fa-pause');
                statusText.innerText = "Carregando áudio...";
            }
        };

        // Controles de velocidade
        increaseSpeedBtn.addEventListener('click', () => {
            rate = Math.min(rate + 0.1, 3); 
            speedLabel.innerText = rate.toFixed(1) + 'x';
            if (isReading) {
                synth.cancel();
                speakBlock(textBlocks[currentBlockIndex]);
            }
        });

        decreaseSpeedBtn.addEventListener('click', () => {
            rate = Math.max(rate - 0.1, 0.5); 
            speedLabel.innerText = rate.toFixed(1) + 'x';
            if (isReading) {
                synth.cancel();
                speakBlock(textBlocks[currentBlockIndex]);
            }
        });

        // Controle de volume via slider
        volumeSlider.addEventListener('input', () => {
            volume = parseFloat(volumeSlider.value);
            if (isReading) {
                synth.cancel();
                speakBlock(textBlocks[currentBlockIndex]);
            }
        });

    });
}();