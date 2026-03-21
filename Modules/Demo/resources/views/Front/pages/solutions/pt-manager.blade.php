@extends('demo::Front.layouts.master')

@section('style')
<style>
    #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav>li>a, #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav-end>li>a {
        color: #ff9800;
    }
    .solution-hero {
        background: linear-gradient(135deg, #1c1c1c 0%, #7d3c00 50%, #b45309 100%);
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
    .feature-icon-box i { font-size: 2.4rem; color: #b45309; margin-bottom: 16px; display: block; }
    .feature-icon-box h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
    .feature-icon-box p  { font-size: .92rem; color: #666; line-height: 1.65; margin: 0; }
    .how-step { display: flex; align-items: flex-start; gap: 20px; margin-bottom: 32px; }
    .how-step-num {
        min-width: 48px; height: 48px;
        background: #b45309; color: #fff;
        border-radius: 50%; display: flex;
        align-items: center; justify-content: center;
        font-size: 1.2rem; font-weight: 700; flex-shrink: 0;
    }
    .how-step-body h5 { font-weight: 700; margin-bottom: 6px; }
    .how-step-body p  { color: #666; font-size: .93rem; margin: 0; }
    .cta-solution {
        background: linear-gradient(135deg, #b45309, #7d3c00);
        padding: 60px 0; text-align: center; color: #fff;
    }
    .cta-solution h2 { font-size: 2rem; font-weight: 700; margin-bottom: 12px; }
    .cta-solution p  { font-size: 1.05rem; opacity: .9; margin-bottom: 28px; }
    .btn-cta-white {
        background: #fff; color: #b45309;
        padding: 14px 40px; border-radius: 50px;
        font-weight: 700; font-size: 1rem;
        text-decoration: none; display: inline-block;
        transition: transform .2s;
    }
    .btn-cta-white:hover { transform: scale(1.04); color: #7d3c00; text-decoration: none; }
    .solution-img { border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,.15); width: 100%; object-fit: cover; }
    .section-label {
        display: inline-block;
        background: #fff7ed; color: #b45309;
        border-radius: 50px; padding: 5px 16px;
        font-size: .82rem; font-weight: 600;
        margin-bottom: 14px; letter-spacing: .5px;
        text-transform: uppercase;
    }
    .check-list { list-style: none; padding: 0; margin: 0; }
    .check-list li { padding: 7px 0; font-size: .96rem; color: #444; display: flex; align-items: flex-start; gap: 10px; }
    .check-list li::before { content: "✓"; color: #b45309; font-weight: 700; flex-shrink: 0; margin-top: 1px; }
    .trainer-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(0,0,0,.07);
        overflow: hidden;
        margin-bottom: 30px;
        transition: transform .25s, box-shadow .25s;
    }
    .trainer-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,.12); }
    .trainer-card-body { padding: 24px; }
    .trainer-card-body h5 { font-weight: 700; margin-bottom: 8px; color: #1c1c1c; }
    .trainer-card-body p { font-size: .9rem; color: #666; margin: 0; }
    .trainer-stat {
        display: flex; align-items: center; gap: 12px;
        padding: 10px 0; border-bottom: 1px solid #f5f5f5;
    }
    .trainer-stat:last-child { border-bottom: none; }
    .trainer-stat i { font-size: 1.2rem; color: #b45309; flex-shrink: 0; }
    .trainer-stat span { font-size: .9rem; color: #555; }
    .commission-box {
        background: linear-gradient(135deg, #fff7ed, #fde8c8);
        border: 1.5px solid #f5cda0;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 20px;
    }
    .commission-box h5 { font-weight: 700; color: #7d3c00; margin-bottom: 10px; }
    .commission-box p  { font-size: .92rem; color: #555; margin: 0; }
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
                @if($lang == 'ar') إدارة المدربين الشخصيين @else PT Manager @endif
            </h1>
            <p>
                @if($lang == 'ar')
                    أدر جميع مدربيك الشخصيين — تتبع عملاءهم، جلساتهم، عمولاتهم، وأداءهم في مكان واحد.
                @else
                    Manage all your personal trainers — track their clients, sessions, commissions, and performance in one place.
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
                             src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?w=800&h=600&fit=crop&q=85"
                             alt="Personal Trainer Management">
                    </figure>
                </div>
            </div>
            <div class="col-lg-5">
                <span class="section-label">
                    @if($lang == 'ar') إدارة فريق التدريب @else Training Team Management @endif
                </span>
                <h2 style="font-weight:700; margin-bottom:16px;">
                    @if($lang == 'ar')
                        أدر مدربيك كما يديرون عملاءهم
                    @else
                        Manage Your Trainers Like They Manage Their Clients
                    @endif
                </h2>
                <p style="color:#555; line-height:1.75; margin-bottom:20px;">
                    @if($lang == 'ar')
                        وحدة إدارة المدربين الشخصيين في جيماوي تمنح مدير النادي رؤية كاملة على أداء كل مدرب — عدد العملاء، الجلسات المنجزة، العمولات المستحقة، والتقييمات. وفي نفس الوقت تمنح المدرب أدوات احترافية لإدارة عملائه وجدول جلساته.
                    @else
                        Gymmawy's PT Manager module gives gym owners full visibility into every trainer's performance — client count, completed sessions, earned commissions, and ratings. At the same time, it gives trainers professional tools to manage their clients and session schedules.
                    @endif
                </p>
                <ul class="check-list">
                    @if($lang == 'ar')
                        <li>ملفات تفصيلية لكل مدرب مع تخصصاته وشهاداته</li>
                        <li>تعيين العملاء وإدارة باقات PT</li>
                        <li>جدولة الجلسات وتتبع الحضور</li>
                        <li>احتساب العمولات وسجل الأرباح</li>
                        <li>تقارير أداء وتقييمات الأعضاء</li>
                        <li>إشعارات بمواعيد الجلسات القادمة</li>
                    @else
                        <li>Detailed profiles for each trainer with specializations and certifications</li>
                        <li>Client assignment and PT package management</li>
                        <li>Session scheduling and attendance tracking</li>
                        <li>Commission calculation and earnings record</li>
                        <li>Performance reports and member ratings</li>
                        <li>Notifications for upcoming session appointments</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{-- ═══ TRAINER PROFILE OVERVIEW ═══ --}}
    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="main_title_2 text-center">
                <span><em></em></span>
                <h2>@if($lang == 'ar') ملف المدرب الشامل @else Complete Trainer Profile @endif</h2>
                <p>@if($lang == 'ar') كل ما يحتاجه المدير لتقييم أداء مدربيه @else Everything a manager needs to evaluate trainer performance @endif</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="trainer-card">
                        <div class="trainer-card-body">
                            <h5>@if($lang == 'ar') بيانات المدرب @else Trainer Information @endif</h5>
                            <div class="trainer-stat">
                                <i class="pe-7s-id"></i>
                                <span>@if($lang == 'ar') الاسم، الصورة، الشهادات، سنوات الخبرة @else Name, photo, certifications, years of experience @endif</span>
                            </div>
                            <div class="trainer-stat">
                                <i class="pe-7s-science"></i>
                                <span>@if($lang == 'ar') التخصصات: كمال أجسام، كارديو، PT لكبار السن @else Specializations: bodybuilding, cardio, senior PT @endif</span>
                            </div>
                            <div class="trainer-stat">
                                <i class="pe-7s-date"></i>
                                <span>@if($lang == 'ar') أوقات العمل وأيام الإجازة المجدولة @else Working hours and scheduled days off @endif</span>
                            </div>
                            <div class="trainer-stat">
                                <i class="pe-7s-users"></i>
                                <span>@if($lang == 'ar') عدد العملاء النشطين والجلسات الشهرية @else Active client count and monthly sessions @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="trainer-card">
                        <div class="trainer-card-body">
                            <h5>@if($lang == 'ar') إدارة الجلسات @else Session Management @endif</h5>
                            <div class="trainer-stat">
                                <i class="pe-7s-date"></i>
                                <span>@if($lang == 'ar') تقويم جلسات تفاعلي يومي وأسبوعي @else Interactive daily and weekly session calendar @endif</span>
                            </div>
                            <div class="trainer-stat">
                                <i class="pe-7s-check"></i>
                                <span>@if($lang == 'ar') تسجيل حضور الجلسات وتقاطعها مع باقة PT @else Session attendance linked to PT package balance @endif</span>
                            </div>
                            <div class="trainer-stat">
                                <i class="pe-7s-bell"></i>
                                <span>@if($lang == 'ar') تذكيرات تلقائية للمدرب والعميل قبل الجلسة @else Automatic reminders for trainer and client before session @endif</span>
                            </div>
                            <div class="trainer-stat">
                                <i class="pe-7s-copy-file"></i>
                                <span>@if($lang == 'ar') سجل كامل بجميع الجلسات المنجزة والملغاة @else Complete log of all completed and cancelled sessions @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="trainer-card">
                        <div class="trainer-card-body">
                            <h5>@if($lang == 'ar') الأداء والتقييم @else Performance & Ratings @endif</h5>
                            <div class="trainer-stat">
                                <i class="pe-7s-star"></i>
                                <span>@if($lang == 'ar') تقييمات الأعضاء لكل مدرب بعد كل جلسة @else Member ratings for each trainer after every session @endif</span>
                            </div>
                            <div class="trainer-stat">
                                <i class="pe-7s-graph1"></i>
                                <span>@if($lang == 'ar') تقارير نمو عملاء المدرب شهراً بشهر @else Monthly client growth reports for each trainer @endif</span>
                            </div>
                            <div class="trainer-stat">
                                <i class="pe-7s-graph3"></i>
                                <span>@if($lang == 'ar') مقارنة أداء المدربين ومعدل احتفاظ كل منهم @else Trainer performance comparison and retention rate @endif</span>
                            </div>
                            <div class="trainer-stat">
                                <i class="pe-7s-medal"></i>
                                <span>@if($lang == 'ar') تصنيف المدربين حسب التقييم ومعدل الإيراد @else Trainer ranking by rating and revenue generated @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ COMMISSIONS ═══ --}}
    <div class="container margin_80_55">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <span class="section-label">
                    @if($lang == 'ar') نظام العمولات @else Commission System @endif
                </span>
                <h2 style="font-weight:700; margin-bottom:24px;">
                    @if($lang == 'ar') احسب العمولات تلقائياً @else Auto-Calculate Commissions @endif
                </h2>
                <div class="commission-box">
                    <h5>@if($lang == 'ar') عمولة ثابتة @else Fixed Commission @endif</h5>
                    <p>@if($lang == 'ar') مبلغ ثابت عن كل جلسة منجزة بغض النظر عن سعر الباقة. @else Fixed amount per completed session regardless of package price. @endif</p>
                </div>
                <div class="commission-box">
                    <h5>@if($lang == 'ar') عمولة نسبية @else Percentage Commission @endif</h5>
                    <p>@if($lang == 'ar') نسبة مئوية من قيمة الباقة المباعة لكل مدرب — قابلة للضبط لكل مدرب على حدة. @else Percentage of the sold package value per trainer — configurable individually per trainer. @endif</p>
                </div>
                <div class="commission-box">
                    <h5>@if($lang == 'ar') تقارير الرواتب الشهرية @else Monthly Salary Reports @endif</h5>
                    <p>@if($lang == 'ar') تقارير تفصيلية لكل مدرب تشمل عدد الجلسات، العمولة المحتسبة، والراتب الإجمالي. @else Detailed monthly reports per trainer showing session count, earned commission, and total salary. @endif</p>
                </div>
            </div>
            <div class="col-lg-6">
                <img class="solution-img"
                     src="https://images.unsplash.com/photo-mTorQ9gFfOg?w=700&h=480&fit=crop&q=85"
                     alt="Trainer Commission Management">
            </div>
        </div>
    </div>

    {{-- ═══ FEATURES GRID ═══ --}}
    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="main_title_2 text-center">
                <span><em></em></span>
                <h2>@if($lang == 'ar') مميزات وحدة PT Manager @else PT Manager Features @endif</h2>
                <p>@if($lang == 'ar') أدوات متكاملة لإدارة فريق التدريب باحترافية @else Comprehensive tools for professional training team management @endif</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-users"></i>
                        <h4>@if($lang == 'ar') تعيين العملاء @else Client Assignment @endif</h4>
                        <p>@if($lang == 'ar') عيّن الأعضاء لمدرب محدد واتبع عدد العملاء النشطين لكل مدرب في أي وقت. @else Assign members to specific trainers and track each trainer's active client count at any time. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-cart"></i>
                        <h4>@if($lang == 'ar') إدارة باقات PT @else PT Package Management @endif</h4>
                        <p>@if($lang == 'ar') بيع باقات جلسات متعددة، تتبع الجلسات المستهلكة، والتجديد التلقائي عند النفاد. @else Sell multi-session packages, track consumed sessions, and auto-notify on package expiry. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-cash"></i>
                        <h4>@if($lang == 'ar') احتساب العمولات @else Commission Calculation @endif</h4>
                        <p>@if($lang == 'ar') احسب عمولات ورواتب المدربين تلقائياً بناء على الجلسات المنجزة والباقات المباعة. @else Automatically calculate trainer commissions and salaries based on completed sessions and sold packages. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-date"></i>
                        <h4>@if($lang == 'ar') جدولة الجلسات @else Session Scheduling @endif</h4>
                        <p>@if($lang == 'ar') تقويم تفاعلي يُظهر جلسات كل مدرب مع خيار الحجز والإلغاء وإعادة الجدولة. @else Interactive calendar showing each trainer's sessions with booking, cancellation, and rescheduling. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-star"></i>
                        <h4>@if($lang == 'ar') تقييمات الأعضاء @else Member Ratings @endif</h4>
                        <p>@if($lang == 'ar') جمع تقييمات الأعضاء بعد كل جلسة لمراقبة جودة التدريب وتحسين أداء المدربين. @else Collect member ratings after each session to monitor training quality and improve performance. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-graph"></i>
                        <h4>@if($lang == 'ar') تقارير الأداء @else Performance Reports @endif</h4>
                        <p>@if($lang == 'ar') تقارير تفصيلية لكل مدرب تشمل معدل الاحتفاظ بالعملاء والإيراد المحقق والتقييم العام. @else Detailed reports per trainer including client retention rate, generated revenue, and overall rating. @endif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ HOW IT WORKS ═══ --}}
    <div class="container margin_80_55">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <img class="solution-img"
                     src="https://images.unsplash.com/photo-Qu70BExHRkQ?w=700&h=480&fit=crop&q=85"
                     alt="PT Management">
            </div>
            <div class="col-lg-5">
                <span class="section-label">
                    @if($lang == 'ar') كيف يعمل @else How It Works @endif
                </span>
                <h2 style="font-weight:700; margin-bottom:30px;">
                    @if($lang == 'ar') دورة حياة المدرب الشخصي @else The Personal Trainer Lifecycle @endif
                </h2>
                <div class="how-step">
                    <div class="how-step-num">1</div>
                    <div class="how-step-body">
                        <h5>@if($lang == 'ar') إعداد ملف المدرب @else Set Up Trainer Profile @endif</h5>
                        <p>@if($lang == 'ar') أدخل بيانات المدرب، تخصصاته، أوقات عمله، ونسبة عمولته. @else Enter trainer data, specializations, working hours, and commission percentage. @endif</p>
                    </div>
                </div>
                <div class="how-step">
                    <div class="how-step-num">2</div>
                    <div class="how-step-body">
                        <h5>@if($lang == 'ar') تعيين العملاء وبيع الباقات @else Assign Clients & Sell Packages @endif</h5>
                        <p>@if($lang == 'ar') عيّن الأعضاء للمدرب وبع لهم باقات PT مع تحديد عدد الجلسات وصلاحية الباقة. @else Assign members and sell PT packages with session count and expiry date. @endif</p>
                    </div>
                </div>
                <div class="how-step">
                    <div class="how-step-num">3</div>
                    <div class="how-step-body">
                        <h5>@if($lang == 'ar') جدولة الجلسات وتنفيذها @else Schedule & Execute Sessions @endif</h5>
                        <p>@if($lang == 'ar') حدد مواعيد الجلسات في التقويم وسجّل الحضور تلقائياً عند انتهاء الجلسة. @else Schedule sessions in the calendar and auto-log attendance when sessions are completed. @endif</p>
                    </div>
                </div>
                <div class="how-step">
                    <div class="how-step-num">4</div>
                    <div class="how-step-body">
                        <h5>@if($lang == 'ar') احتساب العمولة والتقرير @else Calculate Commission & Report @endif</h5>
                        <p>@if($lang == 'ar') في نهاية الشهر، يحتسب النظام تلقائياً عمولة كل مدرب ويولّد تقرير الراتب. @else At month end, the system automatically calculates each trainer's commission and generates a salary report. @endif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ CTA ═══ --}}
    <section class="cta-solution">
        <div class="container">
            <h2>@if($lang == 'ar') أدر مدربيك بكفاءة تامة @else Manage Your Trainers with Full Efficiency @endif</h2>
            <p>@if($lang == 'ar') تواصل معنا واحصل على عرض تجريبي مجاني لوحدة PT Manager. @else Contact us for a free demo of the PT Manager module. @endif</p>
            <a href="{{ route('contact') }}" class="btn-cta-white">
                @if($lang == 'ar') احجز عرضاً تجريبياً @else Book a Free Demo @endif
            </a>
        </div>
    </section>

</main>
@endsection
