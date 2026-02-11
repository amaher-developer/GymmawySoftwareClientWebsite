@extends('zonegym::Front.layouts.master')

@section('style')
<style>
    .download-app-section {
        padding: 60px 0;
        text-align: center;
    }
    .qr-code-wrapper {
        display: inline-block;
        padding: 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    .qr-code-wrapper svg {
        display: block;
    }
    .download-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 30px;
    }
    .download-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 30px;
        border-radius: 8px;
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        transition: opacity 0.3s;
    }
    .download-btn:hover {
        opacity: 0.85;
        color: #fff;
        text-decoration: none;
    }
    .download-btn.android {
        background: #3DDC84;
    }
    .download-btn.ios {
        background: #000;
    }
    .download-btn.website {
        background: #007bff;
    }
    .download-btn i {
        font-size: 24px;
    }
    .smart-link-note {
        margin-top: 20px;
        color: #666;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<main>
    <section class="hero_in general">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp"><span></span>{{ $title }}</h1>
            </div>
        </div>
    </section>

    <div class="container download-app-section">
        <div class="main_title_2">
            <span><em></em></span>
            <h2>{{ $lang == 'ar' ? 'حمل تطبيقنا الآن' : 'Download Our App Now' }}</h2>
            <p>{{ $lang == 'ar' ? 'امسح رمز QR للتحميل مباشرة على جهازك' : 'Scan the QR code to download directly on your device' }}</p>
        </div>

        <div class="qr-code-wrapper">
            {!! $qrCode !!}
        </div>

        <p class="smart-link-note">
            {{ $lang == 'ar' ? 'سيتم توجيهك تلقائياً حسب نوع جهازك' : 'You will be automatically redirected based on your device' }}
        </p>

        <div class="download-buttons">
            @if($androidApp)
            <a href="{{ $androidApp }}" target="_blank" class="download-btn android">
                <i class="fa fa-android"></i>
                {{ $lang == 'ar' ? 'تحميل للأندرويد' : 'Google Play' }}
            </a>
            @endif

            @if($iosApp)
            <a href="{{ $iosApp }}" target="_blank" class="download-btn ios">
                <i class="fa fa-apple"></i>
                {{ $lang == 'ar' ? 'تحميل للآيفون' : 'App Store' }}
            </a>
            @endif

            <a href="{{ env('APP_URL') }}" class="download-btn website">
                <i class="fa fa-globe"></i>
                {{ $lang == 'ar' ? 'زيارة الموقع' : 'Visit Website' }}
            </a>
        </div>
    </div>
</main>
@endsection
