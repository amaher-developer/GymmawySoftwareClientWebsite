@extends('demo::Front.layouts.master')

@section('style')
<style>
    #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav>li>a, #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav-end>li>a {
        color: #ff9800;
    }
    .solution-hero {
        background: linear-gradient(135deg, #0d2137 0%, #1b4332 50%, #2d6a4f 100%);
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
    .feature-icon-box i { font-size: 2.4rem; color: #2d6a4f; margin-bottom: 16px; display: block; }
    .feature-icon-box h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
    .feature-icon-box p  { font-size: .92rem; color: #666; line-height: 1.65; margin: 0; }
    .how-step { display: flex; align-items: flex-start; gap: 20px; margin-bottom: 32px; }
    .how-step-num {
        min-width: 48px; height: 48px;
        background: #2d6a4f; color: #fff;
        border-radius: 50%; display: flex;
        align-items: center; justify-content: center;
        font-size: 1.2rem; font-weight: 700; flex-shrink: 0;
    }
    .how-step-body h5 { font-weight: 700; margin-bottom: 6px; }
    .how-step-body p  { color: #666; font-size: .93rem; margin: 0; }
    .cta-solution {
        background: linear-gradient(135deg, #2d6a4f, #1b4332);
        padding: 60px 0; text-align: center; color: #fff;
    }
    .cta-solution h2 { font-size: 2rem; font-weight: 700; margin-bottom: 12px; }
    .cta-solution p  { font-size: 1.05rem; opacity: .9; margin-bottom: 28px; }
    .btn-cta-white {
        background: #fff; color: #2d6a4f;
        padding: 14px 40px; border-radius: 50px;
        font-weight: 700; font-size: 1rem;
        text-decoration: none; display: inline-block;
        transition: transform .2s;
    }
    .btn-cta-white:hover { transform: scale(1.04); color: #1b4332; text-decoration: none; }
    .solution-img { border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,.15); width: 100%; object-fit: cover; }
    .section-label {
        display: inline-block;
        background: #e8f5e9; color: #2d6a4f;
        border-radius: 50px; padding: 5px 16px;
        font-size: .82rem; font-weight: 600;
        margin-bottom: 14px; letter-spacing: .5px;
        text-transform: uppercase;
    }
    .check-list { list-style: none; padding: 0; margin: 0; }
    .check-list li { padding: 7px 0; font-size: .96rem; color: #444; display: flex; align-items: flex-start; gap: 10px; }
    .check-list li::before { content: "✓"; color: #2d6a4f; font-weight: 700; flex-shrink: 0; margin-top: 1px; }
    .plan-card {
        border: 2px solid #e8f5e9;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 24px;
        background: #fff;
        transition: border-color .25s, box-shadow .25s;
    }
    .plan-card:hover { border-color: #2d6a4f; box-shadow: 0 6px 20px rgba(45,106,79,.12); }
    .plan-card h5 { font-weight: 700; margin-bottom: 8px; color: #1b4332; }
    .plan-card p  { font-size: .91rem; color: #666; margin: 0; }
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
                @if($lang == 'ar') خطط التدريب @else Training Plans @endif
            </h1>
            <p>
                @if($lang == 'ar')
                    أنشئ خططاً تدريبية مخصصة لكل عضو، تابع تقدمه، وعدّل التمارين في الوقت الفعلي.
                @else
                    Build personalized training plans for every member, track progress, and adjust workouts in real time.
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
                             src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=800&h=600&fit=crop&q=85"
                             alt="Training Plans">
                    </figure>
                </div>
            </div>
            <div class="col-lg-5">
                <span class="section-label">
                    @if($lang == 'ar') إدارة التدريب @else Training Management @endif
                </span>
                <h2 style="font-weight:700; margin-bottom:16px;">
                    @if($lang == 'ar')
                        برمج تدريباً احترافياً لكل عضو
                    @else
                        Professional Programming for Every Member
                    @endif
                </h2>
                <p style="color:#555; line-height:1.75; margin-bottom:20px;">
                    @if($lang == 'ar')
                        وحدة خطط التدريب في جيماوي تمنح المدربين أدوات احترافية لبناء برامج تدريبية مفصلة، ومشاركتها مع الأعضاء بشكل فوري، وتتبع الأداء والتقدم عبر الزمن. لا مزيد من الأوراق أو ملفات Excel — كل شيء رقمي ومنظم.
                    @else
                        Gymmawy's Training Plans module gives coaches professional tools to build detailed workout programs, share them instantly with members, and track performance over time. No more paper sheets or Excel files — everything is digital and organized.
                    @endif
                </p>
                <ul class="check-list">
                    @if($lang == 'ar')
                        <li>إنشاء خطط تدريبية غير محدودة لكل مدرب</li>
                        <li>تخصيص الخطط لأعضاء أفراد أو مجموعات</li>
                        <li>مكتبة تمارين مدمجة مع فيديوهات وصور توضيحية</li>
                        <li>تتبع إنجاز التمارين وسجل الأداء</li>
                        <li>ملاحظات المدرب على كل جلسة</li>
                        <li>رسوم بيانية لتقدم العضو عبر الزمن</li>
                    @else
                        <li>Create unlimited training plans per trainer</li>
                        <li>Assign plans to individual members or groups</li>
                        <li>Built-in exercise library with videos and images</li>
                        <li>Track workout completion and performance logs</li>
                        <li>Trainer notes and feedback per session</li>
                        <li>Progress charts for each member over time</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{-- ═══ PLAN TYPES ═══ --}}
    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="main_title_2 text-center">
                <span><em></em></span>
                <h2>
                    @if($lang == 'ar') أنواع الخطط التدريبية @else Types of Training Plans @endif
                </h2>
                <p>
                    @if($lang == 'ar') صمم أي نوع من البرامج الرياضية بمرونة كاملة @else Design any type of fitness program with full flexibility @endif
                </p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="plan-card">
                        <h5>@if($lang == 'ar') خطط بناء العضلات @else Muscle Building Plans @endif</h5>
                        <p>@if($lang == 'ar') برامج متخصصة في زيادة الكتلة العضلية مع جداول الأوزان والتكرارات. @else Specialized programs for muscle hypertrophy with detailed sets, reps, and load tracking. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="plan-card">
                        <h5>@if($lang == 'ar') خطط إنقاص الوزن @else Weight Loss Plans @endif</h5>
                        <p>@if($lang == 'ar') برامج كارديو ومقاومة متكاملة مصممة لحرق الدهون وتحسين اللياقة. @else Integrated cardio and resistance programs designed for fat loss and improved fitness. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="plan-card">
                        <h5>@if($lang == 'ar') خطط إعادة التأهيل @else Rehabilitation Plans @endif</h5>
                        <p>@if($lang == 'ar') برامج تعافي مخصصة للأعضاء الذين يعودون من إصابات رياضية. @else Customized recovery programs for members returning from sports injuries. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="plan-card">
                        <h5>@if($lang == 'ar') خطط تدريب المجموعات @else Group Training Plans @endif</h5>
                        <p>@if($lang == 'ar') برامج للفصول الجماعية مثل CrossFit، HIIT، واليوغا مع جداول المواعيد. @else Programs for group classes like CrossFit, HIIT, and yoga with scheduling integration. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="plan-card">
                        <h5>@if($lang == 'ar') خطط التغذية الرياضية @else Sports Nutrition Plans @endif</h5>
                        <p>@if($lang == 'ar') إضافة توصيات التغذية والسعرات الحرارية كجزء من خطة التدريب الشاملة. @else Add nutrition recommendations and calorie targets as part of the complete training plan. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="plan-card">
                        <h5>@if($lang == 'ar') خطط التحضير للبطولات @else Competition Prep Plans @endif</h5>
                        <p>@if($lang == 'ar') برامج متقدمة للأعضاء المتنافسين مع مراحل وأهداف محددة لكل مرحلة. @else Advanced periodization programs for competing athletes with specific phase goals. @endif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ FEATURES GRID ═══ --}}
    <div class="container margin_80_55">
        <div class="main_title_2 text-center">
            <span><em></em></span>
            <h2>@if($lang == 'ar') مميزات تقنية متقدمة @else Advanced Technical Features @endif</h2>
            <p>@if($lang == 'ar') أدوات احترافية لكل مدرب وعضو @else Professional tools for every trainer and member @endif</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-science"></i>
                    <h4>@if($lang == 'ar') مكتبة تمارين مدمجة @else Built-in Exercise Library @endif</h4>
                    <p>@if($lang == 'ar') مئات التمارين مع توضيحات مرئية وتعليمات الأداء الصحيح يمكن للمدرب إضافتها بنقرة. @else Hundreds of exercises with visual demonstrations and proper form instructions, added with one click. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-graph1"></i>
                    <h4>@if($lang == 'ar') تتبع التقدم @else Progress Tracking @endif</h4>
                    <p>@if($lang == 'ar') رسوم بيانية تفاعلية تُظهر تطور الأوزان والتكرارات والقياسات الجسدية للعضو. @else Interactive charts showing progression in weights, reps, and body measurements over time. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-phone"></i>
                    <h4>@if($lang == 'ar') وصول عبر الجوال @else Mobile Access @endif</h4>
                    <p>@if($lang == 'ar') يتمكن الأعضاء من الاطلاع على خططهم التدريبية عبر الجوال أثناء التمرين مباشرة. @else Members can view their training plans on mobile during their workout session directly. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-copy-file"></i>
                    <h4>@if($lang == 'ar') قوالب الخطط @else Plan Templates @endif</h4>
                    <p>@if($lang == 'ar') احفظ خططك المُثبتة كقوالب قابلة للتطبيق على أعضاء جدد بضغطة واحدة. @else Save proven plans as templates and apply them to new members with a single click. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-chat"></i>
                    <h4>@if($lang == 'ar') ملاحظات المدرب @else Trainer Notes @endif</h4>
                    <p>@if($lang == 'ar') أضف ملاحظات ومتطلبات خاصة لكل جلسة وراجع تعليقات العضو بعد كل تمرين. @else Add session-specific notes and review member feedback after each completed workout. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-date"></i>
                    <h4>@if($lang == 'ar') جدولة التمارين @else Workout Scheduling @endif</h4>
                    <p>@if($lang == 'ar') خطط أسبوعية وشهرية تعرض للعضو ماذا يتمرن كل يوم مع تذكيرات تلقائية. @else Weekly and monthly plans showing members exactly what to train each day with auto-reminders. @endif</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ HOW IT WORKS ═══ --}}
    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <img class="solution-img"
                         src="https://images.unsplash.com/photo-vjkM-0m34KU?w=700&h=480&fit=crop&q=85"
                         alt="Male Training Session">
                </div>
                <div class="col-lg-5">
                    <span class="section-label">
                        @if($lang == 'ar') سير العمل @else Workflow @endif
                    </span>
                    <h2 style="font-weight:700; margin-bottom:30px;">
                        @if($lang == 'ar') من التصميم إلى النتيجة @else From Design to Results @endif
                    </h2>
                    <div class="how-step">
                        <div class="how-step-num">1</div>
                        <div class="how-step-body">
                            <h5>@if($lang == 'ar') تقييم العضو @else Assess the Member @endif</h5>
                            <p>@if($lang == 'ar') سجّل قياسات الجسم، مستوى اللياقة، والأهداف في ملف العضو. @else Record body measurements, fitness level, and goals in the member profile. @endif</p>
                        </div>
                    </div>
                    <div class="how-step">
                        <div class="how-step-num">2</div>
                        <div class="how-step-body">
                            <h5>@if($lang == 'ar') بناء الخطة التدريبية @else Build the Training Plan @endif</h5>
                            <p>@if($lang == 'ar') اختر التمارين من المكتبة وحدد الأوزان والتكرارات والراحة لكل جلسة. @else Select exercises from the library and set weights, reps, and rest periods per session. @endif</p>
                        </div>
                    </div>
                    <div class="how-step">
                        <div class="how-step-num">3</div>
                        <div class="how-step-body">
                            <h5>@if($lang == 'ar') تعيين وتتبع @else Assign & Track @endif</h5>
                            <p>@if($lang == 'ar') عيّن الخطة للعضو، تابع تقدمه، وعدّل البرنامج وفق الأداء الفعلي. @else Assign the plan to the member, track their progress, and adjust based on real performance. @endif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ CTA ═══ --}}
    <section class="cta-solution">
        <div class="container">
            <h2>@if($lang == 'ar') ارتقِ بمستوى التدريب في ناديك @else Elevate Training Quality at Your Gym @endif</h2>
            <p>@if($lang == 'ar') تواصل مع فريقنا واحصل على عرض تجريبي مجاني لوحدة خطط التدريب. @else Contact our team for a free demo of the Training Plans module. @endif</p>
            <a href="{{ route('contact') }}" class="btn-cta-white">
                @if($lang == 'ar') احجز عرضاً تجريبياً @else Book a Free Demo @endif
            </a>
        </div>
    </section>

</main>
@endsection
