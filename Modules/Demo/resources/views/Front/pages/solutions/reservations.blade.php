@extends('demo::Front.layouts.master')

@section('style')
<style>
    #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav>li>a, #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav-end>li>a {
        color: #ff9800;
    }
    .solution-hero {
        background: linear-gradient(135deg, #1a1a2e 0%, #4a0e8f 50%, #6a1bbf 100%);
        padding: 80px 0 60px;
        color: #fff;
        text-align: center;
    }
    .solution-hero h1 { font-size: 2.8rem; font-weight: 700; margin-bottom: 16px; color: #fff !important; }
    .solution-hero p  { font-size: 1.2rem; opacity: .85; max-width: 680px; margin: 0 auto 30px; }
    .solution-hero .badge-pill {
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 50px;
        padding: 6px 18px;
        font-size: .85rem;
        display: inline-block;
        margin-bottom: 24px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .feature-icon-box {
        background: #fff;
        border-radius: 14px;
        padding: 32px 24px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,.07);
        transition: transform .25s, box-shadow .25s;
        height: 100%;
    }
    .feature-icon-box:hover { transform: translateY(-6px); box-shadow: 0 10px 30px rgba(0,0,0,.13); }
    .feature-icon-box i { font-size: 2.4rem; color: #6a1bbf; margin-bottom: 16px; display: block; }
    .feature-icon-box h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
    .feature-icon-box p  { font-size: .92rem; color: #666; line-height: 1.65; margin: 0; }
    .how-step { display: flex; align-items: flex-start; gap: 20px; margin-bottom: 32px; }
    .how-step-num {
        min-width: 48px; height: 48px;
        background: #6a1bbf; color: #fff;
        border-radius: 50%; display: flex;
        align-items: center; justify-content: center;
        font-size: 1.2rem; font-weight: 700; flex-shrink: 0;
    }
    .how-step-body h5 { font-weight: 700; margin-bottom: 6px; }
    .how-step-body p  { color: #666; font-size: .93rem; margin: 0; }
    .cta-solution {
        background: linear-gradient(135deg, #6a1bbf, #4a0e8f);
        padding: 60px 0; text-align: center; color: #fff;
    }
    .cta-solution h2 { font-size: 2rem; font-weight: 700; margin-bottom: 12px; }
    .cta-solution p  { font-size: 1.05rem; opacity: .9; margin-bottom: 28px; }
    .btn-cta-white {
        background: #fff; color: #6a1bbf;
        padding: 14px 40px; border-radius: 50px;
        font-weight: 700; font-size: 1rem;
        text-decoration: none; display: inline-block;
        transition: transform .2s;
    }
    .btn-cta-white:hover { transform: scale(1.04); color: #4a0e8f; text-decoration: none; }
    .solution-img { border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,.15); width: 100%; object-fit: cover; }
    .section-label {
        display: inline-block;
        background: #f3e8ff; color: #6a1bbf;
        border-radius: 50px; padding: 5px 16px;
        font-size: .82rem; font-weight: 600;
        margin-bottom: 14px; letter-spacing: .5px;
        text-transform: uppercase;
    }
    .check-list { list-style: none; padding: 0; margin: 0; }
    .check-list li { padding: 7px 0; font-size: .96rem; color: #444; display: flex; align-items: flex-start; gap: 10px; }
    .check-list li::before { content: "✓"; color: #6a1bbf; font-weight: 700; flex-shrink: 0; margin-top: 1px; }
    .stat-box {
        text-align: center;
        padding: 30px 20px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0,0,0,.07);
        margin-bottom: 24px;
    }
    .stat-box .stat-num { font-size: 2.4rem; font-weight: 800; color: #6a1bbf; line-height: 1; }
    .stat-box p { font-size: .9rem; color: #666; margin: 8px 0 0; }
</style>
@endsection

@section('content')
<main>

    {{-- ═══ HERO ═══ --}}
    <section class="solution-hero">
        <div class="container">
            <span class="badge-pill">
                @if($lang == 'ar') وحدة النظام @else System Module @endif
            </span>
            <h1>
                @if($lang == 'ar') نظام الحجوزات @else Reservations System @endif
            </h1>
            <p>
                @if($lang == 'ar')
                    دع أعضاءك يحجزون الفصول والجلسات والمعدات مباشرة — قلّل حالات الغياب وعظّم الطاقة الاستيعابية.
                @else
                    Let members book classes, sessions, and equipment directly — reduce no-shows and maximize capacity utilization.
                @endif
            </p>
            <a href="{{ route('contact') }}" class="btn_1 rounded">
                @if($lang == 'ar') تواصل معنا @else Get Started @endif
            </a>
        </div>
    </section>

    {{-- ═══ INTRO ═══ --}}
    <div class="container margin_80_55">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="wow">
                    <figure class="block-reveal">
                        <div class="block-horizzontal"></div>
                        <img class="solution-img"
                             src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=800&h=600&fit=crop&q=85"
                             alt="Reservations System">
                    </figure>
                </div>
            </div>
            <div class="col-lg-5">
                <span class="section-label">
                    @if($lang == 'ar') إدارة المواعيد @else Appointment Management @endif
                </span>
                <h2 style="font-weight:700; margin-bottom:16px;">
                    @if($lang == 'ar')
                        احجز، نظّم، واستقطب أكثر
                    @else
                        Book, Organize, and Attract More
                    @endif
                </h2>
                <p style="color:#555; line-height:1.75; margin-bottom:20px;">
                    @if($lang == 'ar')
                        نظام الحجوزات في جيماوي يتيح لأعضائك حجز فصولهم وجلساتهم الخاصة مع المدرب عبر الإنترنت أو من خلال موظف الاستقبال. يُقلّل النظام من حالات الغياب عبر التذكيرات التلقائية، ويعرض لك طاقتك الاستيعابية بوضوح في كل وقت.
                    @else
                        Gymmawy's Reservations system lets members book group classes and personal training sessions online or through reception. The system reduces no-shows via automatic reminders and gives you full visibility into your capacity at all times.
                    @endif
                </p>
                <ul class="check-list">
                    @if($lang == 'ar')
                        <li>حجز الفصول والجلسات الخاصة أونلاين</li>
                        <li>عرض تقويمي للموظفين والأعضاء</li>
                        <li>إشعارات تلقائية قبل الموعد وعند التأكيد</li>
                        <li>إدارة قوائم الانتظار عند امتلاء الفصل</li>
                        <li>حدود استيعابية لكل فصل أو مدرب</li>
                        <li>سياسات الإلغاء وإعادة الجدولة</li>
                    @else
                        <li>Online booking for classes and personal sessions</li>
                        <li>Calendar view for both staff and members</li>
                        <li>Automatic reminders before appointments and on confirmation</li>
                        <li>Waitlist management when classes are full</li>
                        <li>Capacity limits per class or trainer</li>
                        <li>Cancellation and rescheduling policies</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{-- ═══ STATS ═══ --}}
    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="main_title_2 text-center">
                <span><em></em></span>
                <h2>@if($lang == 'ar') لماذا الحجوزات الرقمية؟ @else Why Digital Reservations? @endif</h2>
                <p>@if($lang == 'ar') الأرقام تتكلم @else The numbers speak for themselves @endif</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-box">
                        <div class="stat-num">40%</div>
                        <p>@if($lang == 'ar') تقليل في حالات الغياب مع التذكيرات التلقائية @else Reduction in no-shows with automatic reminders @endif</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-box">
                        <div class="stat-num">3x</div>
                        <p>@if($lang == 'ar') زيادة في كفاءة استخدام الطاقة الاستيعابية @else Increase in capacity utilization efficiency @endif</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-box">
                        <div class="stat-num">24/7</div>
                        <p>@if($lang == 'ar') حجز متاح على مدار الساعة بدون تدخل بشري @else Booking available around the clock without staff intervention @endif</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-box">
                        <div class="stat-num">100%</div>
                        <p>@if($lang == 'ar') رؤية كاملة لجدول المدربين والفصول في الوقت الفعلي @else Full real-time visibility into trainer and class schedules @endif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ FEATURES GRID ═══ --}}
    <div class="container margin_80_55">
        <div class="main_title_2 text-center">
            <span><em></em></span>
            <h2>@if($lang == 'ar') مميزات نظام الحجوزات @else Reservation System Features @endif</h2>
            <p>@if($lang == 'ar') كل ما تحتاجه لإدارة جدول ناديك باحترافية @else Everything you need to manage your gym schedule professionally @endif</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-date"></i>
                    <h4>@if($lang == 'ar') تقويم تفاعلي @else Interactive Calendar @endif</h4>
                    <p>@if($lang == 'ar') عرض يومي وأسبوعي وشهري يُظهر جميع الفصول والمواعيد بألوان مميزة لكل نوع. @else Daily, weekly, and monthly views showing all classes and appointments color-coded by type. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-bell"></i>
                    <h4>@if($lang == 'ar') إشعارات ذكية @else Smart Notifications @endif</h4>
                    <p>@if($lang == 'ar') رسائل تأكيد فورية عند الحجز، تذكيرات قبل ساعة ويوم من الموعد عبر SMS أو واتساب. @else Instant booking confirmations, plus reminders 1 hour and 1 day before via SMS or WhatsApp. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-users"></i>
                    <h4>@if($lang == 'ar') إدارة قوائم الانتظار @else Waitlist Management @endif</h4>
                    <p>@if($lang == 'ar') عند امتلاء الفصل، يُضاف الأعضاء تلقائياً لقائمة الانتظار ويُبلَّغون فور تحرر مكان. @else When classes are full, members auto-join the waitlist and are notified instantly when a spot opens. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-config"></i>
                    <h4>@if($lang == 'ar') سياسات مرنة @else Flexible Policies @endif</h4>
                    <p>@if($lang == 'ar') حدد مهل الإلغاء، رسوم الغياب، وشروط إعادة الجدولة المناسبة لسياسة ناديك. @else Set cancellation windows, no-show fees, and rescheduling terms that match your gym policy. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-graph"></i>
                    <h4>@if($lang == 'ar') تقارير الحضور @else Attendance Reports @endif</h4>
                    <p>@if($lang == 'ar') تقارير تُظهر معدلات الحضور، الفصول الأكثر شعبية، وأوقات الذروة لتحسين الجدول. @else Reports showing attendance rates, most popular classes, and peak times to optimize scheduling. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-medal"></i>
                    <h4>@if($lang == 'ar') حجز الجلسات الخاصة @else Personal Session Booking @endif</h4>
                    <p>@if($lang == 'ar') خصص أوقات المدرب وأتح للأعضاء الذين يمتلكون باقات PT حجز جلساتهم مباشرة. @else Set trainer availability and let PT package members book their private sessions directly. @endif</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ HOW IT WORKS ═══ --}}
    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <span class="section-label">
                        @if($lang == 'ar') كيف يعمل @else How It Works @endif
                    </span>
                    <h2 style="font-weight:700; margin-bottom:30px;">
                        @if($lang == 'ar') الحجز في ثوانٍ @else Booking in Seconds @endif
                    </h2>
                    <div class="how-step">
                        <div class="how-step-num">1</div>
                        <div class="how-step-body">
                            <h5>@if($lang == 'ar') العضو يختار الفصل @else Member Selects a Class @endif</h5>
                            <p>@if($lang == 'ar') يتصفح العضو الجدول المتاح ويختار الفصل أو الجلسة المناسبة. @else Member browses the available schedule and selects the class or session they want. @endif</p>
                        </div>
                    </div>
                    <div class="how-step">
                        <div class="how-step-num">2</div>
                        <div class="how-step-body">
                            <h5>@if($lang == 'ar') تأكيد الحجز الفوري @else Instant Booking Confirmation @endif</h5>
                            <p>@if($lang == 'ar') يُؤكَّد الحجز فوراً ويتلقى العضو رسالة تأكيد على هاتفه. @else The booking is confirmed immediately and the member receives a confirmation message. @endif</p>
                        </div>
                    </div>
                    <div class="how-step">
                        <div class="how-step-num">3</div>
                        <div class="how-step-body">
                            <h5>@if($lang == 'ar') تذكيرات قبل الموعد @else Reminders Before Appointment @endif</h5>
                            <p>@if($lang == 'ar') يتلقى العضو تذكيرات تلقائية قبل موعده لضمان الحضور وتقليل الغياب. @else Member receives automatic reminders before their appointment to ensure attendance. @endif</p>
                        </div>
                    </div>
                    <div class="how-step">
                        <div class="how-step-num">4</div>
                        <div class="how-step-body">
                            <h5>@if($lang == 'ar') تسجيل الحضور التلقائي @else Auto Attendance Logging @endif</h5>
                            <p>@if($lang == 'ar') عند دخول العضو، يُسجَّل حضوره للجلسة تلقائياً في سجل الاشتراك. @else When the member checks in, their session attendance is automatically logged in their subscription record. @endif</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img class="solution-img"
                         src="https://images.unsplash.com/photo-AzX5iNFYBMY?w=700&h=480&fit=crop&q=85"
                         alt="Gym Equipment Scheduling">
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ CTA ═══ --}}
    <section class="cta-solution">
        <div class="container">
            <h2>@if($lang == 'ar') نظّم جدول ناديك بالكامل @else Fully Organize Your Gym Schedule @endif</h2>
            <p>@if($lang == 'ar') تواصل معنا واحصل على عرض تجريبي مجاني لنظام الحجوزات. @else Contact us for a free demo of the Reservations system. @endif</p>
            <a href="{{ route('contact') }}" class="btn-cta-white">
                @if($lang == 'ar') احجز عرضاً تجريبياً @else Book a Free Demo @endif
            </a>
        </div>
    </section>

</main>
@endsection
