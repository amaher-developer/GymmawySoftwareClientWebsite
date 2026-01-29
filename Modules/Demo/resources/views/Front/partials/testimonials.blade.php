<!-- TESTIMONIALS SECTION -->
<section class="section testimonials-section section-colored" data-bg="#f5f5f5" id="testimonials">
    <div class="page-section-content overflow-hidden">
        <div class="container">
            <!-- TITLE -->
            <div class="section-header">
                <h2 class="uppercase" data-animate="fadeInDown" data-delay="0">
                    {{$lang == 'ar' ? 'آراء عملائنا' : 'What Our Clients Say'}}
                </h2>
                <div class="line-hr"></div>
                <p data-animate="fadeInUp" data-delay="100">
                    {{$lang == 'ar' ? 'استمع لتجارب عملائنا الناجحة مع نظام جيماوي' : 'Listen to our clients\' success stories with Gymmawy system'}}
                </p>
            </div>
            <!--! TITLE -->

            <div class="ok-row">
                @foreach($testimonials as $testimonial)
                <div class="ok-md-6 ok-xsd-12" data-animate="fadeInUp" data-delay="{{$loop->iteration * 150}}">
                    <div class="testimonial-card">
                        @if($testimonial['type'] == 'video' && isset($testimonial['youtube_url']))
                        <div class="testimonial-video-wrapper">
                            <iframe src="{{$testimonial['youtube_url']}}" style="width: 100%;height: 320px"
                                    title="{{$lang == 'ar' ? $testimonial['name_ar'] : $testimonial['name_en']}}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                            </iframe>
                        </div>
                        @endif

                        <div class="testimonial-content">
                            <br/><br/>
                            <div class="testimonial-text">
                                {{$lang == 'ar' ? $testimonial['content_ar'] : $testimonial['content_en']}}
                            </div>
                            <div class="testimonial-author">
                                @if(isset($testimonial['image']) && $testimonial['image'])
                                <img src="{{asset($testimonial['image'])}}"
                                     alt="{{$lang == 'ar' ? $testimonial['name_ar'] : $testimonial['name_en']}}"
                                     class="testimonial-avatar">
                                @else
                                <div class="testimonial-avatar" style="background: var(--primary-gradient); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 24px;">
                                    {{substr($lang == 'ar' ? $testimonial['name_ar'] : $testimonial['name_en'], 0, 1)}}
                                </div>
                                @endif
                                <div class="testimonial-info">
                                    <h5>{{$lang == 'ar' ? $testimonial['name_ar'] : $testimonial['name_en']}}</h5>
                                    <p>{{$lang == 'ar' ? $testimonial['title_ar'] : $testimonial['title_en']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--! TESTIMONIALS SECTION -->
