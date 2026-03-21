@extends('demo::Front.layouts.master')

@section('style')
<style>
    /* ── Nav color fix ──────────────────────── */
    #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav>li>a,
    #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav-end>li>a {
        color: #ff9800;
    }

    /* ── Force white H1 ─────────────────────── */
    .contact-hero h1 {
        font-size: 2.6rem;
        font-weight: 700;
        margin-bottom: 14px;
        color: #fff !important;
    }

    /* ── Hero ──────────────────────────────── */
    .contact-hero {
        background: linear-gradient(135deg, #0d1b2a 0%, #1a3a5c 60%, #0f3460 100%);
        padding: 90px 0 70px;
        color: #fff;
        text-align: center;
    }
    .contact-hero .badge-pill {
        background: rgba(255,255,255,.13);
        border: 1px solid rgba(255,255,255,.28);
        border-radius: 50px;
        padding: 7px 22px;
        font-size: .8rem;
        display: inline-block;
        margin-bottom: 22px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #fff;
    }
    .contact-hero p { font-size: 1.1rem; opacity: .85; max-width: 580px; margin: 0 auto; color: #fff; }

    /* ── Info Cards Strip ───────────────────── */
    .contact-info-strip {
        background: #fff;
        box-shadow: 0 6px 28px rgba(0,0,0,.1);
        position: relative;
        z-index: 10;
    }
    .contact-card {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 32px 28px;
        border-right: 1px solid #f0f0f0;
        transition: background .2s;
    }
    .contact-card:last-child { border-right: none; border-left: none; }
    .contact-card:hover { background: #f8faff; }
    .contact-card-icon {
        width: 56px; height: 56px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .contact-card-icon.green  { background: #e8f5e9; color: #27ae60; }
    .contact-card-icon.orange { background: #fff3f1; color: #e8604c; }
    .contact-card-icon.blue   { background: #e8f4fd; color: #2874a6; }
    .contact-card-body h5 { font-weight: 700; margin: 0 0 3px; font-size: .95rem; color: #222; }
    .contact-card-body a  { font-size: .88rem; color: #555; text-decoration: none; display: block; line-height: 1.5; }
    .contact-card-body span { font-size: .8rem; color: #999; }
    .contact-card-body a:hover { color: #e8604c; }

    /* ── Section wrapper ────────────────────── */
    .contact-main-section { padding: 70px 0 60px; background: #f5f7fb; }

    /* ── Form card ──────────────────────────── */
    .contact-form-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 6px 32px rgba(0,0,0,.09);
        padding: 44px 40px 40px;
    }
    .contact-form-card .form-head { margin-bottom: 28px; }
    .contact-form-card .form-head h3 {
        font-size: 1.5rem; font-weight: 700; color: #1a1a2e;
        margin: 0 0 6px;
    }
    .contact-form-card .form-head p { font-size: .9rem; color: #888; margin: 0; }
    .contact-form-card label {
        font-weight: 600; font-size: .83rem;
        color: #444; margin-bottom: 6px; display: block;
    }
    .contact-form-card .required { color: #e8604c; }
    .contact-form-card .form-control {
        border-radius: 10px;
        border: 1.5px solid #dde3ee;
        padding: 11px 15px;
        font-size: .93rem;
        background: #fafbfd;
        transition: border-color .2s, box-shadow .2s, background .2s;
        color: #222;
    }
    .contact-form-card .form-control:focus {
        border-color: #e8604c;
        box-shadow: 0 0 0 3px rgba(232,96,76,.1);
        background: #fff;
        outline: none;
    }
    .contact-form-card textarea.form-control { height: 130px; resize: vertical; }
    .contact-form-card .form-row-group { margin-bottom: 18px; }
    .btn-send {
        width: 100%;
        background: linear-gradient(135deg, #e8604c 0%, #c0392b 100%);
        color: #fff !important;
        border: none;
        border-radius: 12px;
        padding: 14px 0;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        letter-spacing: .3px;
        transition: transform .2s, box-shadow .2s;
        margin-top: 6px;
    }
    .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(232,96,76,.35);
    }

    /* ── Side panel ─────────────────────────── */
    .contact-side-panel {
        background: linear-gradient(160deg, #0d1b2a 0%, #1a3a5c 100%);
        border-radius: 20px;
        padding: 36px 30px;
        color: #fff;
        height: 100%;
    }
    .contact-side-panel h4 {
        font-size: 1.3rem; font-weight: 700;
        color: #fff !important; margin: 0 0 8px;
    }
    .contact-side-panel .intro-text {
        font-size: .88rem; opacity: .8; line-height: 1.7;
        margin-bottom: 28px;
        border-bottom: 1px solid rgba(255,255,255,.1);
        padding-bottom: 24px;
    }
    .cinfo-row {
        display: flex; align-items: flex-start; gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }
    .cinfo-row:last-of-type { border-bottom: none; }
    .cinfo-row .ci-icon {
        width: 40px; height: 40px; flex-shrink: 0;
        background: rgba(255,255,255,.1);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
    }
    .cinfo-row .ci-body { min-width: 0; }
    .cinfo-row .ci-body small { display: block; font-size: .72rem; opacity: .55; text-transform: uppercase; letter-spacing: .6px; margin-bottom: 3px; }
    .cinfo-row .ci-body a,
    .cinfo-row .ci-body p { margin: 0; font-size: .9rem; color: #fff; text-decoration: none; line-height: 1.4; word-break: break-word; }
    .cinfo-row .ci-body a:hover { opacity: .75; }
    .promise-box {
        margin-top: 22px;
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 12px;
        padding: 16px 18px;
        display: flex; align-items: center; gap: 12px;
    }
    .promise-box i { font-size: 1.4rem; color: #fbbf24; flex-shrink: 0; }
    .promise-box p { margin: 0; font-size: .83rem; opacity: .88; line-height: 1.5; }

    /* ── Bottom cards ───────────────────────── */
    .service-card {
        background: #fff;
        border-radius: 14px;
        padding: 30px 22px;
        text-align: center;
        box-shadow: 0 3px 16px rgba(0,0,0,.06);
        margin-bottom: 24px;
        transition: transform .25s, box-shadow .25s;
        border-top: 3px solid transparent;
    }
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 28px rgba(0,0,0,.1);
        border-top-color: #e8604c;
    }
    .service-card i { font-size: 2rem; color: #e8604c; margin-bottom: 14px; display: block; }
    .service-card h5 { font-weight: 700; font-size: 1rem; margin-bottom: 8px; color: #1a1a2e; }
    .service-card p  { font-size: .85rem; color: #666; margin: 0; line-height: 1.6; }

    @@media (max-width: 767px) {
        .contact-form-card { padding: 26px 18px; }
        .contact-side-panel { margin-top: 24px; }
        .contact-card { border-right: none; border-bottom: 1px solid #f0f0f0; }
        .contact-card:last-child { border-bottom: none; }
    }
</style>
@endsection

@section('content')
<main>

    {{-- ═══ HERO ═══ --}}
    <section class="contact-hero">
        <div class="container">
            <span class="badge-pill">
                @if($lang=='ar') تواصل معنا @else Get In Touch @endif
            </span>
            <h1>
                @if($lang=='ar') كيف يمكننا مساعدتك؟ @else How Can We Help You? @endif
            </h1>
            <p>
                @if($lang=='ar')
                    فريقنا جاهز للإجابة على جميع استفساراتك حول نظام جيماوي — اتصل بنا أو أرسل لنا رسالة الآن.
                @else
                    Our team is ready to answer all your questions about Gymmawy — call us or send a message now.
                @endif
            </p>
        </div>
    </section>

    {{-- ═══ INFO CARDS STRIP ═══ --}}
    <div class="contact-info-strip">
        <div class="container">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-card-icon green"><i class="fa fa-whatsapp"></i></div>
                        <div class="contact-card-body">
                            <h5>WhatsApp</h5>
                            <a href="https://wa.me/00201014401468" target="_blank" rel="noopener" dir="ltr">+20 101 440 1468</a>
                            <span>@if($lang=='ar') متاح 7 أيام في الأسبوع @else Available 7 days a week @endif</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card">
                        <div class="contact-card-icon orange"><i class="pe-7s-mail-open-file"></i></div>
                        <div class="contact-card-body">
                            <h5>@if($lang=='ar') البريد الإلكتروني @else Email Address @endif</h5>
                            <a href="mailto:support@gymmawy.com">support@gymmawy.com</a>
                            <span>@if($lang=='ar') رد خلال 24 ساعة @else Reply within 24 hours @endif</span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    {{-- ═══ FORM + SIDE ═══ --}}
    <div class="contact-main-section">
        <div class="container">
            <div class="row g-4 align-items-start">

                {{-- FORM --}}
                <div class="col-lg-7">
                    <div class="contact-form-card">
                        <div class="form-head">
                            <h3>@if($lang=='ar') أرسل لنا رسالة @else Send Us a Message @endif</h3>
                            <p>@if($lang=='ar') أخبرنا بما تحتاج وسيتواصل معك أحد ممثلينا في أقرب وقت. @else Tell us what you need and one of our representatives will reach out shortly. @endif</p>
                        </div>

                        @include('demo::errors')

                        <form method="post" action="{{ route('contact') }}" autocomplete="off">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-sm-6 form-row-group">
                                    <label>{{ trans('global.name') }} <span class="required">*</span></label>
                                    <input class="form-control" type="text" name="name"
                                           placeholder="@if($lang=='ar') الاسم الكامل @else Full name @endif"
                                           value="{{ old('name') }}" required>
                                </div>
                                <div class="col-sm-6 form-row-group">
                                    <label>{{ trans('global.phone') }} <span class="required">*</span></label>
                                    <input class="form-control" type="text" name="phone"
                                           placeholder="@if($lang=='ar') رقم الهاتف / واتساب @else Phone / WhatsApp @endif"
                                           value="{{ old('phone') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 form-row-group">
                                    <label>{{ trans('global.email') }} <span class="required">*</span></label>
                                    <input class="form-control" type="email" name="email"
                                           placeholder="@if($lang=='ar') البريد الإلكتروني @else Email address @endif"
                                           value="{{ old('email') }}" required>
                                </div>
                                <div class="col-sm-6 form-row-group">
                                    <label>{{ trans('front.country') }}</label>
                                    <input class="form-control" type="text" name="country"
                                           placeholder="@if($lang=='ar') البلد @else Your country @endif"
                                           value="{{ old('country') }}">
                                </div>
                            </div>

                            <div class="form-row-group">
                                <label>{{ trans('global.msg') }}</label>
                                <textarea class="form-control" name="message"
                                          placeholder="@if($lang=='ar') اكتب استفسارك أو الخدمة التي تحتاجها... @else Describe your inquiry or what service you need... @endif">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="btn-send">
                                <i class="fa fa-paper-plane" style="margin-{{ $lang=='ar' ? 'left' : 'right' }}:8px;"></i>
                                {{ trans('global.send') }}
                            </button>
                        </form>
                    </div>
                </div>

                {{-- SIDE INFO --}}
                <div class="col-lg-5">
                    <div class="contact-side-panel">
                        <h4>@if($lang=='ar') لماذا تختار جيماوي؟ @else Why Choose Gymmawy? @endif</h4>
                        <p class="intro-text">
                            @if($lang=='ar')
                                نظام إدارة رياضي متكامل مصمم للنوادي العربية — أعضاء، اشتراكات، حضور، مبيعات، ومدربون شخصيون في منصة سحابية واحدة.
                            @else
                                An all-in-one management system built for Arabic-speaking gyms — members, subscriptions, attendance, sales, and PT all in one cloud platform.
                            @endif
                        </p>

                        <div class="cinfo-row">
                            <div class="ci-icon"><i class="fa fa-whatsapp"></i></div>
                            <div class="ci-body">
                                <small>WhatsApp</small>
                                <a href="https://wa.me/00201014401468" target="_blank" rel="noopener" dir="ltr">+20 101 440 1468</a>
                            </div>
                        </div>
                        <div class="cinfo-row">
                            <div class="ci-icon"><i class="pe-7s-mail"></i></div>
                            <div class="ci-body">
                                <small>@if($lang=='ar') البريد @else Email @endif</small>
                                <a href="mailto:support@gymmawy.com">support@gymmawy.com</a>
                            </div>
                        </div>
                        <div class="cinfo-row">
                            <div class="ci-icon"><i class="pe-7s-clock"></i></div>
                            <div class="ci-body">
                                <small>@if($lang=='ar') أوقات العمل @else Working Hours @endif</small>
                                <p>@if($lang=='ar') السبت – الخميس، 9 صباحاً – 9 مساءً @else Saturday – Thursday, 9am – 9pm @endif</p>
                            </div>
                        </div>
                        <div class="cinfo-row">
                            <div class="ci-icon"><i class="pe-7s-global"></i></div>
                            <div class="ci-body">
                                <small>@if($lang=='ar') المناطق @else Regions @endif</small>
                                <p>@if($lang=='ar') السعودية، مصر، الإمارات، الكويت، والمنطقة العربية @else KSA, Egypt, UAE, Kuwait & Arab Region @endif</p>
                            </div>
                        </div>

                        <div class="promise-box">
                            <i class="pe-7s-rocket"></i>
                            <p>@if($lang=='ar') نضمن الرد على جميع الاستفسارات خلال 24 ساعة في أيام العمل. @else We guarantee a reply to all inquiries within 24 business hours. @endif</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ═══ SERVICES CARDS ═══ --}}
    <div class="container margin_80_55">
        <div class="main_title_2 text-center">
            <span><em></em></span>
            <h2>@if($lang=='ar') ماذا يمكننا أن نفعل لك؟ @else What Can We Do for You? @endif</h2>
            <p>@if($lang=='ar') فريق متخصص لكل احتياج @else A specialized team for every need @endif</p>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="service-card">
                    <i class="pe-7s-display1"></i>
                    <h5>@if($lang=='ar') عرض تجريبي مباشر @else Live Demo @endif</h5>
                    <p>@if($lang=='ar') احجز جلسة تجريبية مع أحد خبرائنا لاستعراض كامل للنظام. @else Book a session with one of our specialists for a full system walkthrough. @endif</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="service-card">
                    <i class="pe-7s-headphones"></i>
                    <h5>@if($lang=='ar') الدعم الفني @else Technical Support @endif</h5>
                    <p>@if($lang=='ar') حل المشكلات التقنية وتدريب فريقك على الاستخدام الأمثل. @else Resolve issues and train your team for optimal system use. @endif</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="service-card">
                    <i class="pe-7s-cash"></i>
                    <h5>@if($lang=='ar') الأسعار والباقات @else Pricing & Packages @endif</h5>
                    <p>@if($lang=='ar') استفسر عن الباقة المناسبة لحجم ناديك وميزانيتك. @else Inquire about the right package for your gym size and budget. @endif</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="service-card">
                    <i class="pe-7s-config"></i>
                    <h5>@if($lang=='ar') الإعداد والتخصيص @else Setup & Customization @endif</h5>
                    <p>@if($lang=='ar') نُعدّ النظام ونخصصه بالكامل ليناسب عمليات ناديك من اليوم الأول. @else We fully set up and customize the system to fit your gym from day one. @endif</p>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
