<!-- STATS SECTION -->
<section class="section stats-section" id="stats">
    <div class="page-section-content overflow-hidden">
        <div class="container">
            <!-- TITLE -->
            <div class="section-header">
                <h2 class="uppercase" data-animate="fadeInDown" data-delay="0">
                    {{$lang == 'ar' ? 'أرقامنا تتحدث' : 'Our Numbers Speak'}}
                </h2>
                <div class="line-hr"></div>
                <p data-animate="fadeInUp" data-delay="100">
                    {{$lang == 'ar' ? 'نفخر بثقة عملائنا ونجاحهم المستمر معنا' : 'We are proud of our clients\' trust and their continuous success with us'}}
                </p>
            </div>
            <!--! TITLE -->

            <div class="ok-row">
                @foreach($stats as $stat)
                <div class="ok-md-3 ok-xsd-6" data-animate="fadeInUp" data-delay="{{$loop->iteration * 100}}">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="{{$stat['icon']}}"></i>
                        </div>
                        <div class="stat-number" data-target="{{$stat['value']}}" data-suffix="{{$stat['suffix']}}">
                            0{{$stat['suffix']}}
                        </div>
                        <div class="stat-label">
                            {{$lang == 'ar' ? $stat['label_ar'] : $stat['label_en']}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--! STATS SECTION -->
