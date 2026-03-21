@extends('demo::Front.layouts.master')

@section('style')
<style>
    #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav>li>a, #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav-end>li>a {
        color: #ff9800;
    }
    .solution-hero {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
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
    .feature-icon-box i { font-size: 2.4rem; color: #e8604c; margin-bottom: 16px; display: block; }
    .feature-icon-box h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
    .feature-icon-box p  { font-size: .92rem; color: #666; line-height: 1.65; margin: 0; }
    .how-step { display: flex; align-items: flex-start; gap: 20px; margin-bottom: 32px; }
    .how-step-num {
        min-width: 48px; height: 48px;
        background: #e8604c; color: #fff;
        border-radius: 50%; display: flex;
        align-items: center; justify-content: center;
        font-size: 1.2rem; font-weight: 700; flex-shrink: 0;
    }
    .how-step-body h5 { font-weight: 700; margin-bottom: 6px; }
    .how-step-body p  { color: #666; font-size: .93rem; margin: 0; }
    .cta-solution {
        background: linear-gradient(135deg, #e8604c, #c0392b);
        padding: 60px 0; text-align: center; color: #fff;
    }
    .cta-solution h2 { font-size: 2rem; font-weight: 700; margin-bottom: 12px; }
    .cta-solution p  { font-size: 1.05rem; opacity: .9; margin-bottom: 28px; }
    .btn-cta-white {
        background: #fff; color: #e8604c;
        padding: 14px 40px; border-radius: 50px;
        font-weight: 700; font-size: 1rem;
        text-decoration: none; display: inline-block;
        transition: transform .2s;
    }
    .btn-cta-white:hover { transform: scale(1.04); color: #c0392b; text-decoration: none; }
    .solution-img { border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,.15); width: 100%; object-fit: cover; }
    .section-label {
        display: inline-block;
        background: #fff3f1; color: #e8604c;
        border-radius: 50px; padding: 5px 16px;
        font-size: .82rem; font-weight: 600;
        margin-bottom: 14px; letter-spacing: .5px;
        text-transform: uppercase;
    }
    .check-list { list-style: none; padding: 0; margin: 0; }
    .check-list li { padding: 7px 0; font-size: .96rem; color: #444; display: flex; align-items: flex-start; gap: 10px; }
    .check-list li::before { content: "✓"; color: #e8604c; font-weight: 700; flex-shrink: 0; margin-top: 1px; }
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
                @if($lang == 'ar') إدارة النادي الرياضي @else Gym Manager @endif
            </h1>
            <p>
                @if($lang == 'ar')
                    تحكم كامل في العمليات اليومية لناديك — أعضاء، اشتراكات، حضور، مالية وتقارير من لوحة تحكم واحدة.
                @else
                    Full control over your gym's daily operations — members, subscriptions, attendance, finances, and reports from one unified dashboard.
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
                             src="https://images.unsplash.com/photo-1540497077202-7c8a3999166f?w=800&h=600&fit=crop&q=85"
                             alt="Gym Manager Dashboard">
                    </figure>
                </div>
            </div>
            <div class="col-lg-5">
                <span class="section-label">
                    @if($lang == 'ar') النظام الأساسي @else Core System @endif
                </span>
                <h2 style="font-weight:700; margin-bottom:16px;">
                    @if($lang == 'ar')
                        كل ما يحتاجه ناديك في مكان واحد
                    @else
                        Everything Your Gym Needs, In One Place
                    @endif
                </h2>
                <p style="color:#555; line-height:1.75; margin-bottom:20px;">
                    @if($lang == 'ar')
                        جيماوي هو نظام إدارة متكامل مصمم خصيصاً للنوادي الرياضية في المنطقة العربية. يتيح لك تسجيل الأعضاء، متابعة اشتراكاتهم، تتبع الحضور، إدارة الموظفين، ومراقبة الأداء المالي — كل ذلك بواجهة عربية سهلة الاستخدام تعمل على الحاسوب والجوال.
                    @else
                        Gymmawy is an all-in-one management system built for gyms and fitness centers across the Arab world. Register members, track subscriptions, monitor attendance, manage staff, and oversee finances — all from a clean, mobile-friendly Arabic and English interface.
                    @endif
                </p>
                <ul class="check-list">
                    @if($lang == 'ar')
                        <li>ملفات أعضاء كاملة مع صور وتاريخ الاشتراكات</li>
                        <li>دعم أنواع متعددة من الاشتراكات والأسعار</li>
                        <li>إدارة حضور وانصراف بالبصمة أو QR</li>
                        <li>تقارير مالية يومية وشهرية وسنوية</li>
                        <li>دعم متعدد الفروع من حساب واحد</li>
                        <li>صلاحيات مخصصة لكل موظف</li>
                    @else
                        <li>Complete member profiles with photos and subscription history</li>
                        <li>Multiple subscription types, pricing, and renewal options</li>
                        <li>Attendance via fingerprint, QR code, or RFID</li>
                        <li>Daily, monthly, and annual financial reports</li>
                        <li>Multi-branch management from a single account</li>
                        <li>Custom staff roles and access permissions</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{-- ═══ FEATURES GRID ═══ --}}
    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="main_title_2 text-center">
                <span><em></em></span>
                <h2>
                    @if($lang == 'ar') مميزات وحدة إدارة النادي @else Gym Manager Features @endif
                </h2>
                <p>
                    @if($lang == 'ar') كل الأدوات التي تحتاجها لتشغيل ناديك باحترافية @else All the tools you need to run a professional gym @endif
                </p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-users"></i>
                        <h4>@if($lang == 'ar') إدارة الأعضاء @else Member Management @endif</h4>
                        <p>@if($lang == 'ar') ملفات أعضاء شاملة تشمل الصور والبيانات الصحية وجهات الاتصال في الطوارئ وتاريخ الاشتراكات الكامل. @else Full member profiles with photos, health notes, emergency contacts, and complete subscription history. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-note2"></i>
                        <h4>@if($lang == 'ar') إدارة الاشتراكات @else Subscription Tracking @endif</h4>
                        <p>@if($lang == 'ar') أنواع اشتراكات متعددة مع دعم التجديد التلقائي والتجميد والتحويل بين الفروع وتنبيهات الانتهاء. @else Multiple subscription types with auto-renewal, freezing, branch transfer, and expiry alert support. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-id"></i>
                        <h4>@if($lang == 'ar') الحضور والتحكم بالدخول @else Attendance & Access Control @endif</h4>
                        <p>@if($lang == 'ar') تتبع دخول وخروج الأعضاء عبر بصمة الإصبع أو كود QR أو بطاقة RFID مع سجل زمني كامل. @else Track member entry and exit via fingerprint, QR code, or RFID with a full timestamped log. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-cash"></i>
                        <h4>@if($lang == 'ar') الإدارة المالية @else Financial Management @endif</h4>
                        <p>@if($lang == 'ar') فواتير وإيصالات رقمية، تقارير الدخل والمصروفات، وملخصات تحصيل يومية للكاشير. @else Digital invoices and receipts, income/expense reports, and daily cashier collection summaries. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-map-marker"></i>
                        <h4>@if($lang == 'ar') دعم متعدد الفروع @else Multi-Branch Support @endif</h4>
                        <p>@if($lang == 'ar') إدارة جميع فروع ناديك من حساب مركزي واحد مع تقارير أداء مفصلة لكل فرع. @else Manage all your gym branches from one central account with per-branch performance reports. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-bell"></i>
                        <h4>@if($lang == 'ar') إشعارات تلقائية @else Auto Notifications @endif</h4>
                        <p>@if($lang == 'ar') رسائل SMS وواتساب تلقائية عند انتهاء الاشتراك، أعياد الميلاد، والمدفوعات المتأخرة. @else Automatic SMS and WhatsApp messages on subscription expiry, birthdays, and overdue payments. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-config"></i>
                        <h4>@if($lang == 'ar') صلاحيات الموظفين @else Staff Roles & Permissions @endif</h4>
                        <p>@if($lang == 'ar') تحديد صلاحيات مخصصة للمديرين والموظفين والمدربين ومنع الوصول غير المصرح به. @else Define custom permissions for managers, receptionists, and trainers to prevent unauthorized access. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-graph"></i>
                        <h4>@if($lang == 'ar') تقارير وتحليلات @else Reports & Analytics @endif</h4>
                        <p>@if($lang == 'ar') تقارير الاحتفاظ بالأعضاء، اتجاهات الإيرادات، ساعات الذروة، وفلاتر تاريخية مخصصة. @else Member retention, revenue trends, peak hours, and custom date-range filters for deep insights. @endif</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-icon-box">
                        <i class="pe-7s-credit"></i>
                        <h4>@if($lang == 'ar') الدفع الإلكتروني @else Online Payment @endif</h4>
                        <p>@if($lang == 'ar') قبول المدفوعات عبر Tabby وTamara وPaytabs وبطاقات الائتمان مباشرة من النظام. @else Accept payments via Tabby, Tamara, Paytabs, and credit cards directly through the system. @endif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ HOW IT WORKS ═══ --}}
    <div class="container margin_80_55">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <span class="section-label">
                    @if($lang == 'ar') كيف يعمل @else How It Works @endif
                </span>
                <h2 style="font-weight:700; margin-bottom:30px;">
                    @if($lang == 'ar') ابدأ في 3 خطوات بسيطة @else Up and Running in 3 Simple Steps @endif
                </h2>
                <div class="how-step">
                    <div class="how-step-num">1</div>
                    <div class="how-step-body">
                        <h5>@if($lang == 'ar') إعداد حساب ناديك @else Set Up Your Gym Account @endif</h5>
                        <p>@if($lang == 'ar') أدخل بيانات النادي، الفروع، أنواع الاشتراكات، وبيانات الموظفين في دقائق. @else Enter your gym details, branches, subscription types, and staff data in minutes. @endif</p>
                    </div>
                </div>
                <div class="how-step">
                    <div class="how-step-num">2</div>
                    <div class="how-step-body">
                        <h5>@if($lang == 'ar') تسجيل الأعضاء @else Register Your Members @endif</h5>
                        <p>@if($lang == 'ar') استورد قائمة أعضائك الحاليين أو أضفهم يدوياً مع اشتراكاتهم وبياناتهم الكاملة. @else Import your existing members or add them manually with full profile and subscription data. @endif</p>
                    </div>
                </div>
                <div class="how-step">
                    <div class="how-step-num">3</div>
                    <div class="how-step-body">
                        <h5>@if($lang == 'ar') ابدأ الإدارة الفورية @else Start Managing Immediately @endif</h5>
                        <p>@if($lang == 'ar') ابدأ تتبع الحضور، استلام المدفوعات، ومتابعة التقارير من اليوم الأول. @else Begin tracking attendance, receiving payments, and monitoring reports from day one. @endif</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img class="solution-img"
                     src="https://images.unsplash.com/photo-GNWUPn44-eg?w=700&h=480&fit=crop&q=85"
                     alt="Gym Management System">
            </div>
        </div>
    </div>

    {{-- ═══ CTA ═══ --}}
    <section class="cta-solution">
        <div class="container">
            <h2>@if($lang == 'ar') هل أنت مستعد لتطوير إدارة ناديك؟ @else Ready to Upgrade Your Gym Management? @endif</h2>
            <p>@if($lang == 'ar') تواصل معنا اليوم واحصل على عرض تجريبي مجاني لنظام جيماوي. @else Contact us today for a free demo of the Gymmawy system. @endif</p>
            <a href="{{ route('contact') }}" class="btn-cta-white">
                @if($lang == 'ar') احجز عرضاً تجريبياً @else Book a Free Demo @endif
            </a>
        </div>
    </section>

</main>
@endsection
