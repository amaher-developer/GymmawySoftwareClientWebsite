@extends('demo::Front.layouts.master')

@section('style')
<style>
    #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav>li>a, #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav-end>li>a {
        color: #ff9800;
    }
    .solution-hero {
        background: linear-gradient(135deg, #0d1b2a 0%, #1b4f72 50%, #2874a6 100%);
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
    .feature-icon-box i { font-size: 2.4rem; color: #2874a6; margin-bottom: 16px; display: block; }
    .feature-icon-box h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
    .feature-icon-box p  { font-size: .92rem; color: #666; line-height: 1.65; margin: 0; }
    .how-step { display: flex; align-items: flex-start; gap: 20px; margin-bottom: 32px; }
    .how-step-num {
        min-width: 48px; height: 48px;
        background: #2874a6; color: #fff;
        border-radius: 50%; display: flex;
        align-items: center; justify-content: center;
        font-size: 1.2rem; font-weight: 700; flex-shrink: 0;
    }
    .how-step-body h5 { font-weight: 700; margin-bottom: 6px; }
    .how-step-body p  { color: #666; font-size: .93rem; margin: 0; }
    .cta-solution {
        background: linear-gradient(135deg, #2874a6, #1b4f72);
        padding: 60px 0; text-align: center; color: #fff;
    }
    .cta-solution h2 { font-size: 2rem; font-weight: 700; margin-bottom: 12px; }
    .cta-solution p  { font-size: 1.05rem; opacity: .9; margin-bottom: 28px; }
    .btn-cta-white {
        background: #fff; color: #2874a6;
        padding: 14px 40px; border-radius: 50px;
        font-weight: 700; font-size: 1rem;
        text-decoration: none; display: inline-block;
        transition: transform .2s;
    }
    .btn-cta-white:hover { transform: scale(1.04); color: #1b4f72; text-decoration: none; }
    .solution-img { border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,.15); width: 100%; object-fit: cover; }
    .section-label {
        display: inline-block;
        background: #e8f4fd; color: #2874a6;
        border-radius: 50px; padding: 5px 16px;
        font-size: .82rem; font-weight: 600;
        margin-bottom: 14px; letter-spacing: .5px;
        text-transform: uppercase;
    }
    .check-list { list-style: none; padding: 0; margin: 0; }
    .check-list li { padding: 7px 0; font-size: .96rem; color: #444; display: flex; align-items: flex-start; gap: 10px; }
    .check-list li::before { content: "✓"; color: #2874a6; font-weight: 700; flex-shrink: 0; margin-top: 1px; }
    .payment-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: #fff; border: 1.5px solid #e0e7ef;
        border-radius: 10px; padding: 12px 20px;
        margin: 6px; font-weight: 600; font-size: .92rem;
        color: #333;
        box-shadow: 0 2px 8px rgba(0,0,0,.06);
    }
    .payment-badge i { color: #2874a6; font-size: 1.2rem; }
    .product-row {
        display: flex; align-items: center; gap: 16px;
        padding: 16px; border-bottom: 1px solid #f0f0f0;
    }
    .product-row:last-child { border-bottom: none; }
    .product-row i { font-size: 1.5rem; color: #2874a6; flex-shrink: 0; }
    .product-row div h6 { font-weight: 700; margin: 0 0 4px; }
    .product-row div p { font-size: .88rem; color: #666; margin: 0; }
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
                @if($lang == 'ar') نقطة البيع (POS) @else Point of Sale (POS) @endif
            </h1>
            <p>
                @if($lang == 'ar')
                    بع المكملات الغذائية والمعدات والخدمات مباشرة من مكتب الاستقبال بنظام سريع وسهل الاستخدام.
                @else
                    Sell supplements, equipment, and services directly from your front desk with a fast, easy-to-use POS system.
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
                             src="https://images.unsplash.com/photo-1556742111-a301076d9d18?w=800&h=600&fit=crop&q=85"
                             alt="Point of Sale System">
                    </figure>
                </div>
            </div>
            <div class="col-lg-5">
                <span class="section-label">
                    @if($lang == 'ar') المبيعات والمخزون @else Sales & Inventory @endif
                </span>
                <h2 style="font-weight:700; margin-bottom:16px;">
                    @if($lang == 'ar')
                        حوّل استقبال ناديك إلى مركز مبيعات
                    @else
                        Turn Your Reception Into a Revenue Center
                    @endif
                </h2>
                <p style="color:#555; line-height:1.75; margin-bottom:20px;">
                    @if($lang == 'ar')
                        نظام نقطة البيع في جيماوي يتكامل مباشرة مع ملفات الأعضاء والمخزون والتقارير المالية. سواء كنت تبيع مكملات غذائية، ملابس رياضية، أو تجدد اشتراكات — كل شيء في شاشة واحدة، سريع ودقيق.
                    @else
                        Gymmawy's POS integrates directly with member profiles, inventory, and financial reports. Whether you're selling supplements, sportswear, or renewing subscriptions — everything is on one screen, fast and accurate.
                    @endif
                </p>
                <ul class="check-list">
                    @if($lang == 'ar')
                        <li>واجهة سريعة لإتمام المبيعات في ثوانٍ</li>
                        <li>ربط المبيعات بملف العضو تلقائياً</li>
                        <li>قبول الكاش والبطاقة والمحافظ الإلكترونية</li>
                        <li>إدارة المخزون وتنبيهات النفاد</li>
                        <li>تقارير مبيعات يومية وشهرية</li>
                        <li>دعم الخصومات والكوبونات والباقات</li>
                    @else
                        <li>Fast interface to complete sales in seconds</li>
                        <li>Auto-link sales to member profiles</li>
                        <li>Accept cash, card, and digital wallet payments</li>
                        <li>Inventory management with low-stock alerts</li>
                        <li>Daily and monthly sales reports</li>
                        <li>Support for discounts, coupons, and packages</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{-- ═══ PAYMENT METHODS ═══ --}}
    <div class="bg_color_1">
        <div class="container margin_80_55">
            <div class="main_title_2 text-center">
                <span><em></em></span>
                <h2>@if($lang == 'ar') طرق الدفع المدعومة @else Supported Payment Methods @endif</h2>
                <p>@if($lang == 'ar') نظامنا يقبل جميع طرق الدفع الشائعة في المنطقة @else Our system accepts all popular payment methods in the region @endif</p>
            </div>
            <div class="text-center" style="margin-bottom: 30px;">
                <span class="payment-badge"><i class="pe-7s-cash"></i> @if($lang == 'ar') نقداً @else Cash @endif</span>
                <span class="payment-badge"><i class="pe-7s-credit"></i> Visa / Mastercard</span>
                <span class="payment-badge"><i class="pe-7s-credit"></i> Mada</span>
                <span class="payment-badge"><i class="pe-7s-cart"></i> Tabby</span>
                <span class="payment-badge"><i class="pe-7s-cart"></i> Tamara</span>
                <span class="payment-badge"><i class="pe-7s-credit"></i> Paytabs</span>
                <span class="payment-badge"><i class="pe-7s-phone"></i> Apple Pay</span>
                <span class="payment-badge"><i class="pe-7s-wallet"></i> @if($lang == 'ar') تحويل بنكي @else Bank Transfer @endif</span>
            </div>

            {{-- PRODUCT TYPES --}}
            <div class="main_title_2 text-center" style="margin-top: 40px;">
                <span><em></em></span>
                <h2>@if($lang == 'ar') ما يمكن بيعه من النظام @else What You Can Sell Through the System @endif</h2>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div style="background:#fff; border-radius:14px; box-shadow:0 4px 20px rgba(0,0,0,.07); overflow:hidden;">
                        <div class="product-row">
                            <i class="pe-7s-note2"></i>
                            <div>
                                <h6>@if($lang == 'ar') الاشتراكات والباقات @else Subscriptions & Packages @endif</h6>
                                <p>@if($lang == 'ar') تجديد اشتراكات الأعضاء وبيع باقات جديدة مباشرة من كاشير الاستقبال. @else Renew member subscriptions and sell new packages directly from reception cashier. @endif</p>
                            </div>
                        </div>
                        <div class="product-row">
                            <i class="pe-7s-box2"></i>
                            <div>
                                <h6>@if($lang == 'ar') المكملات الغذائية @else Nutritional Supplements @endif</h6>
                                <p>@if($lang == 'ar') بروتين، فيتامينات، وجبات رياضية مع تتبع المخزون وتنبيهات النفاد. @else Protein, vitamins, and sports nutrition with inventory tracking and low-stock alerts. @endif</p>
                            </div>
                        </div>
                        <div class="product-row">
                            <i class="pe-7s-shirt"></i>
                            <div>
                                <h6>@if($lang == 'ar') الملابس والإكسسوارات @else Sportswear & Accessories @endif</h6>
                                <p>@if($lang == 'ar') تي شيرتات، قفازات، أحزمة رياضية بمقاسات وألوان مختلفة مع إدارة المخزون. @else T-shirts, gloves, belts in various sizes and colors with full inventory management. @endif</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-3 mt-lg-0">
                    <div style="background:#fff; border-radius:14px; box-shadow:0 4px 20px rgba(0,0,0,.07); overflow:hidden;">
                        <div class="product-row">
                            <i class="pe-7s-medal"></i>
                            <div>
                                <h6>@if($lang == 'ar') جلسات التدريب الخاص @else Personal Training Sessions @endif</h6>
                                <p>@if($lang == 'ar') بيع باقات PT وتسجيل الجلسات المستهلكة تلقائياً مع كل دخول. @else Sell PT packages and auto-deduct sessions with each check-in automatically. @endif</p>
                            </div>
                        </div>
                        <div class="product-row">
                            <i class="pe-7s-drop"></i>
                            <div>
                                <h6>@if($lang == 'ar') المشروبات والوجبات @else Beverages & Snacks @endif</h6>
                                <p>@if($lang == 'ar') بيع المشروبات الرياضية والوجبات الصحية من كافيتيريا النادي بسهولة. @else Sell sports drinks and healthy snacks from your gym cafeteria with ease. @endif</p>
                            </div>
                        </div>
                        <div class="product-row">
                            <i class="pe-7s-key"></i>
                            <div>
                                <h6>@if($lang == 'ar') إيجار الخزانات والخدمات @else Locker & Service Rental @endif</h6>
                                <p>@if($lang == 'ar') إيجار الخزانات، المناشف، وجلسات الساونا مع فوترة تلقائية. @else Locker rental, towel service, and sauna sessions with automatic billing. @endif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ FEATURES ═══ --}}
    <div class="container margin_80_55">
        <div class="main_title_2 text-center">
            <span><em></em></span>
            <h2>@if($lang == 'ar') مميزات نظام نقطة البيع @else POS System Features @endif</h2>
            <p>@if($lang == 'ar') سرعة وكفاءة في كل عملية بيع @else Speed and efficiency in every sale @endif</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-rocket"></i>
                    <h4>@if($lang == 'ar') سرعة الإنجاز @else Fast Transaction Processing @endif</h4>
                    <p>@if($lang == 'ar') أتمم عمليات البيع في ثوانٍ بفضل واجهة مبسطة مصممة للاستخدام السريع على أجهزة الكمبيوتر والتابلت. @else Complete sales in seconds with a simplified interface designed for rapid use on computers and tablets. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-box1"></i>
                    <h4>@if($lang == 'ar') إدارة المخزون @else Inventory Management @endif</h4>
                    <p>@if($lang == 'ar') تتبع الكميات تلقائياً مع تنبيهات عند اقتراب نفاد المخزون لضمان عدم انقطاع المبيعات. @else Automatically track quantities with low-stock alerts to ensure sales continuity. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-print"></i>
                    <h4>@if($lang == 'ar') الفواتير والإيصالات @else Invoices & Receipts @endif</h4>
                    <p>@if($lang == 'ar') طباعة إيصالات فورية أو إرسالها رقمياً عبر واتساب أو بريد إلكتروني للعميل. @else Print receipts instantly or send them digitally via WhatsApp or email to the customer. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-ticket"></i>
                    <h4>@if($lang == 'ar') الخصومات والكوبونات @else Discounts & Coupons @endif</h4>
                    <p>@if($lang == 'ar') طبق خصومات نسبية أو ثابتة، أكواد ترويجية، وعروض خاصة للأعضاء المميزين. @else Apply percentage or fixed discounts, promo codes, and special offers for loyal members. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-graph"></i>
                    <h4>@if($lang == 'ar') تقارير المبيعات @else Sales Reports @endif</h4>
                    <p>@if($lang == 'ar') تقارير يومية لكل كاشير، أكثر المنتجات مبيعاً، وتحليل الإيرادات حسب الفئة. @else Daily reports per cashier, best-selling products, and revenue analysis by category. @endif</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-icon-box">
                    <i class="pe-7s-lock"></i>
                    <h4>@if($lang == 'ar') صلاحيات الكاشير @else Cashier Permissions @endif</h4>
                    <p>@if($lang == 'ar') تحكم في من يستطيع منح الخصومات، إلغاء العمليات، أو الاطلاع على التقارير المالية. @else Control who can grant discounts, void transactions, or access financial reports. @endif</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ CTA ═══ --}}
    <section class="cta-solution">
        <div class="container">
            <h2>@if($lang == 'ar') ابدأ بيع أكثر وإدارة أذكى @else Start Selling More and Managing Smarter @endif</h2>
            <p>@if($lang == 'ar') تواصل معنا واحصل على عرض تجريبي مجاني لنظام نقطة البيع. @else Contact us for a free demo of the POS system. @endif</p>
            <a href="{{ route('contact') }}" class="btn-cta-white">
                @if($lang == 'ar') احجز عرضاً تجريبياً @else Book a Free Demo @endif
            </a>
        </div>
    </section>

</main>
@endsection
