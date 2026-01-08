<!-- FAQ SECTION -->
<section class="section faq-section" id="faq">
    <div class="page-section-content overflow-hidden">
        <div class="container">
            <!-- TITLE -->
            <div class="section-header">
                <h2 class="uppercase" data-animate="fadeInDown" data-delay="0">
                    {{$lang == 'ar' ? 'الأسئلة الشائعة' : 'Frequently Asked Questions'}}
                </h2>
                <div class="line-hr"></div>
                <p data-animate="fadeInUp" data-delay="100">
                    {{$lang == 'ar' ? 'إجابات على أكثر الأسئلة شيوعاً حول نظام جيماوي' : 'Answers to the most common questions about Gymmawy system'}}
                </p>
            </div>
            <!--! TITLE -->

            <div class="faq-container">
                @foreach($faqs as $faq)
                <div class="faq-item" data-animate="fadeInUp" data-delay="{{$loop->iteration * 100}}">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <h5>{{$lang == 'ar' ? $faq['question_ar'] : $faq['question_en']}}</h5>
                        <i class="fa fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        <p>{{$lang == 'ar' ? $faq['answer_ar'] : $faq['answer_en']}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--! FAQ SECTION -->
