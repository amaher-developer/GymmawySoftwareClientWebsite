@extends('premier::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')
    <style>
        .img-fluid {
            height: 100%;
            object-fit: cover;
        }

        .hero_in.general:before {
            background: url({{asset('resources/assets/front/img/bg/articles.jpg')}}) center center no-repeat;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        @if($lang == 'ar')

        .blog-single-sec .blog-content p {
            text-align: start;
        }
        h4, h5 {
            text-align: start;
        }

        @else
        .blog-single-sec .blog-content p {
            text-align: left !important;
        }
        h4, h5 {
            text-align: left !important;
        }

        @endif

        .highlight-text {
            border-radius: 10px;
            border: solid 1px #f97d04;
            margin-bottom: 20px !important;
            margin-top: 20px !important;
        }

        .blog-sec .blog-box {
            border-top: none;
            background: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
        }

        .blog-single-sec .blog-content {
            padding-right: 0px;
        }
    </style>
@endsection

@section('content')

    <!-- Page title -->
    <section class="page-title-sec over-layer-black">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>{{$title}}</h2>
                    <p><a href="{{route('home')}}">{{trans('front.home')}}</a> / <a href="#">{{$title}}</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Single Section -->
    <section id="blog" class="blog-sec blog-single-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-box">
                        <div class="blog-content">

@if($lang == 'ar')
<div dir="rtl">

<h2>سياسة الاسترداد والإلغاء</h2>

<p>
نسعى دائماً لتقديم أفضل تجربة رياضية لعملائنا الكرام. نرجو قراءة سياسة الاسترداد التالية بعناية قبل إتمام أي عملية شراء.
</p>

<h4>أولاً: الاشتراكات الرياضية</h4>
<p>
جميع مبالغ الاشتراكات المدفوعة غير قابلة للاسترداد بعد تفعيل الاشتراك والاستفادة من الخدمات. ومع ذلك، نراعي الحالات الاستثنائية وفق الشروط التالية:
</p>
<ul>
    <li><strong>خلال 24 ساعة من الشراء:</strong> يحق للعميل طلب استرداد كامل للمبلغ المدفوع شريطة عدم الاستفادة من أي خدمة.</li>
    <li><strong>بعد مرور 24 ساعة:</strong> لا يُقبل طلب الاسترداد في حال تفعيل الاشتراك والاستفادة من الخدمات.</li>
    <li><strong>الحالات الطبية:</strong> في حال ثبوت عدم قدرة العميل على ممارسة الرياضة لأسباب طبية، يُقبل طلب الاسترداد بعد تقديم تقرير طبي معتمد، ويُحتسب الاسترداد بشكل نسبي على المدة المتبقية من الاشتراك.</li>
    <li><strong>الدفع المكرر:</strong> في حال حدوث خطأ وسداد المبلغ مرتين، يُستعاد المبلغ المكرر بالكامل خلال 14 يوم عمل.</li>
</ul>

<h4>ثانياً: طلبات الاسترداد</h4>
<p>
لتقديم طلب استرداد، يرجى التواصل مع فريق خدمة العملاء مع إرفاق المستندات التالية:
</p>
<ul>
    <li>رقم الفاتورة أو رقم المعاملة</li>
    <li>سبب طلب الاسترداد</li>
    <li>أي مستندات داعمة (مثل التقرير الطبي عند الحاجة)</li>
</ul>

<h4>ثالثاً: مدة معالجة الاسترداد</h4>
<p>
يُعالج طلب الاسترداد خلال مدة تتراوح بين 7 و14 يوم عمل من تاريخ الموافقة على الطلب، ويُعاد المبلغ إلى وسيلة الدفع الأصلية.
</p>

<h4>رابعاً: استثناءات الاسترداد</h4>
<ul>
    <li>الاشتراكات المخفضة أو العروض الترويجية غير قابلة للاسترداد.</li>
    <li>الجلسات الخاصة مع المدربين الشخصيين التي تم حجزها وتأكيدها غير قابلة للاسترداد في حال عدم الإلغاء قبل 24 ساعة من موعد الجلسة.</li>
    <li>المنتجات والمعدات الرياضية المباعة غير قابلة للإرجاع بعد فتح العبوة.</li>
</ul>

<h4>للتواصل معنا</h4>
<p>
إذا كان لديك أي استفسار حول سياسة الاسترداد، يرجى التواصل مع فريق خدمة العملاء لدينا عبر وسائل التواصل المتاحة على الموقع.
</p>

</div>
@else
<div style="text-align: left; direction: ltr;">

<h2>Refund & Cancellation Policy</h2>

<p>
We are committed to providing the best fitness experience for our valued customers.
Please read the following refund policy carefully before completing any purchase.
</p>

<h4>1. Membership Subscriptions</h4>
<p>
All paid subscription fees are non-refundable once the subscription has been activated and services have been used.
However, we consider exceptional cases under the following conditions:
</p>
<ul>
    <li><strong>Within 24 hours of purchase:</strong> A full refund may be requested provided no services have been used.</li>
    <li><strong>After 24 hours:</strong> No refund will be issued once the subscription has been activated and services have been accessed.</li>
    <li><strong>Medical conditions:</strong> If a member is medically unable to exercise, a refund request may be accepted upon submission of an approved medical report. The refund will be calculated on a pro-rata basis for the remaining subscription period.</li>
    <li><strong>Duplicate payment:</strong> If a payment is processed twice in error, the duplicate amount will be fully refunded within 14 business days.</li>
</ul>

<h4>2. How to Request a Refund</h4>
<p>
To submit a refund request, please contact our customer service team with the following information:
</p>
<ul>
    <li>Invoice number or transaction reference</li>
    <li>Reason for the refund request</li>
    <li>Supporting documents if applicable (e.g., medical report)</li>
</ul>

<h4>3. Refund Processing Time</h4>
<p>
Refund requests are processed within 7–14 business days from the date of approval.
The amount will be returned to the original payment method used at the time of purchase.
</p>

<h4>4. Non-Refundable Items</h4>
<ul>
    <li>Discounted or promotional subscriptions are non-refundable.</li>
    <li>Personal training sessions that have been booked and confirmed are non-refundable unless cancelled at least 24 hours before the scheduled session.</li>
    <li>Sports products and equipment are non-returnable once the packaging has been opened.</li>
</ul>

<h4>Contact Us</h4>
<p>
If you have any questions regarding our refund policy,
please contact our customer service team through the contact details available on our website.
</p>

</div>
@endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')

@endsection
