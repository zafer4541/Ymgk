
<link rel="stylesheet" href="https://md-aqil.github.io/images/swiper.min.css">

    <section class="spacer ">
    <div class="testimonial-section">
        <div class="testi-user-img">
            <div class="swiper-container gallery-thumbs">
                <div class="swiper-wrapper">

                        @foreach($newss as $news)
                        @if($news->isPublished == 1)
                        <div class="swiper-slide">
                            <img class="u3" src="{{$news->image}}" alt="">
                        </div>
                        @endif
                        @endforeach


                </div>
            </div>
        </div>
        <div class="user-saying">
            <div class="swiper-container testimonial">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper ">
                    <!-- Slides -->

                        @foreach($newss as $news)
                        @if($news->isPublished == 1)
                        <div class="swiper-slide">
                            <div class="quote">
                            <img class="quote-icon" src="https://md-aqil.github.io/images/quote.png" alt="">
                            <div class="name">{{$news->title}}</div>
                            <p>
                                “{!!\Illuminate\Support\Str::limit($news->description,200)!!}“
                            </p>
                            <div class="designation"><a class="text-white text-decoration-underline" href="#">Haberin Devamı...</a></div>
                        </div>
                        </div>
                        @endif
                        @endforeach

                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination swiper-pagination-white"></div>

            </div>
        </div>
    </div>
</section>

<script src="https://md-aqil.github.io/images/swiper.min.js"></script>
<script>
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: '2',
        // coverflowEffect: {
        //   rotate: 50,
        //   stretch: 0,
        //   depth: 100,
        //   modifier: 1,
        //   slideShadows : true,
        // },

        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 50,
            modifier: 6,
            slideShadows : false,
        },

    });


    var galleryTop = new Swiper('.swiper-container.testimonial', {
        speed: 400,
        spaceBetween: 50,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        direction: 'vertical',
        pagination: {
            clickable: true,
            el: '.swiper-pagination',
            type: 'bullets',
        },
        thumbs: {
            swiper: galleryThumbs
        }
    });

</script>



