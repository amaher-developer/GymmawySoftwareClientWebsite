<!-- TRUST BADGES SECTION -->
<section class="section trust-badges-section section-colored" data-bg="#f9f9f9" id="trust-badges">
    <div class="page-section-content overflow-hidden">
        <div class="container">
            <!-- TITLE -->
            <div class="section-header">
                <h2 class="uppercase" data-animate="fadeInDown" data-delay="0">
                    {{$lang == 'ar' ? 'شهادات وشراكات' : 'Certifications & Partnerships'}}
                </h2>
                <div class="line-hr"></div>
                <p data-animate="fadeInUp" data-delay="100">
                    {{$lang == 'ar' ? 'نفخر بشهاداتنا وشراكاتنا مع كبرى الشركات العالمية' : 'We are proud of our certifications and partnerships with leading global companies'}}
                </p>
            </div>
            <!--! TITLE -->

            <div class="ok-row">
                @foreach($trust_badges as $badge)
                <div class="ok-md-3 ok-xsd-6 ok-sd-6" data-animate="fadeInUp" data-delay="{{$loop->iteration * 100}}">
                    <div class="badge-card">
                        @if(isset($badge['url']) && $badge['url'])
                        <a href="{{$badge['url']}}" target="_blank" data-animated-link="fadeOut" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: inherit;">
                        @endif
                            <img src="{{asset($badge['image'])}}"
                                 alt="{{$lang == 'ar' ? $badge['title_ar'] : $badge['title_en']}}"
                                 class="badge-image"
                                 onerror="this.src='{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/images/favicon.ico')}}'">
                            <div class="badge-title">
                                {{$lang == 'ar' ? $badge['title_ar'] : $badge['title_en']}}
                            </div>
                            @if((isset($badge['description_ar']) && $badge['description_ar']) || (isset($badge['description_en']) && $badge['description_en']))
                            <div class="badge-description">
                                {{$lang == 'ar' ? $badge['description_ar'] : $badge['description_en']}}
                            </div>
                            @endif
                        @if(isset($badge['url']) && $badge['url'])
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--! TRUST BADGES SECTION -->
