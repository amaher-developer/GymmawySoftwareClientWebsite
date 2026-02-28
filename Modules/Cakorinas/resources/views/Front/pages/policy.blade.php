@extends('cakorinas::Front.layouts.master')
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

        .simple-btn-div {
            text-align: right;
        }

        .radio-input {
            height: 30px !important;
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

        ::placeholder {
            color: #d5d5d5 !important;
            opacity: 1; /* Firefox */
        }

        ::-ms-input-placeholder { /* Edge 12-18 */
            color: #555555;
        }

        #tabbyCard div:first-child{
            background-color: #f5f5f5 !important;
        }
        #tabbyCard {
            padding-top: 20px;
            width: 100%;
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
                           <!-- {!! @$policy !!} -->

@if($lang == 'ar')
                        <div>

                           خصوصية thecakorinas.com
مقدمة
<br/>
تعنى (إتفاقية سرية المعلومات) لدينا بطريقة جمعنا للبيانات و طريقة حماية المعلومات الشخصية للمستخدمين، وهي بغاية الأهمية للإطلاع و مراجعة تفاصيل هذه الإتفاقية
نحن لا يعنينا أي معلومات شخصية لشخص محدد بعينه ، و إنما يتم جمع المعلومات الشخصية من الراغبين بإستخدام موقع thecakorinas.com او صفحات الانترنت المرتبطة (بما في ذلك وغير مقتصر على بيعك وشرائك لبضائع ,او عن مشاركتك في مزادات,او حين تتصل هاتفيا او بواسطة البريد الالكتروني بفريق مركز دعم المستخدمين لدينا). و بمجرد تزويدك لنا بمعلوماتك الشخصية تكون قد فوضتنا بمعالجة هذه المعلومات وفق بنود وشروط (إتفاقية سرية المعلومات) .
قد نلجأ الى تعديل في (إتفاقية سرية المعلومات) في اي وقت, وذلك بعد الإعلان عن هذا التعديل بنشر النسخة المعدلة على الموقع. وتكون النسخة المعدلة من (إتفاقية سرية المعلومات) سارية المفعول اعتبارا من تاريخ نشرها. في اعقاب النشر يعتبر استمرارك في استخدام الموقع إلتزاما منك بالشروط والبنود الواردة في النسخة المعدلة لطريقة معالجتنا وتعاملنا مع معلوماتك الشخصية التي كنت قد زودتنا بها. ونأمل منكم الإطلاع من حين لأخر على إعلانات إدارة thecakorinas.com و التي قد يكون لها علاقة بهذا الإتفاقية (إتفاقية سرية المعلومات) .
نأمل منكم الإطلاع من حين لأخر على إعلانات إدارة thecakorinas.com و التي قد يكون لها علاقة بهذا الإتفاقية (إتفاقية سرية المعلومات) .
يغطي (إتفاقية سرية المعلومات) الأنشطة التالية والتي يرد تفصل لها في البنود إدناه :
<br/>
جمعنا وإحتفاظنا بمعلوماتك الشخصية التي تعاملت بها أو زودتنا بها أو قمت بعرضها أو تعديلها
إستخدامنا لمعلوماتك الشخصية ومراجعتها وتعديلها حسب الحاجة
استخدامك لمعلوماتك الشخصية ومعلومات المستخدمين الاخرين
إستخدام، دخول، تصفح، وتعديل معلوماتك الشخصية
ادوات الاتصال مع اطراف ثالثة عبر الانترنت
برمجيات التصفح المستخدمة على جهازك الشخصي
لا لرسائل الكترونية مضللة او مخادعة
حماية معلوماتك الشخصية
كيف لك الاتصال بنا للاستفسار عن (إتفاقية سرية المعلومات)
جمعنا وإحتفاظنا بمعلوماتك الشخصية التي تعاملت بها أو زودتنا بها أو قمت بعرضها أو تعديلها
<br/>
كجزء من التسجيل على الموقع سوف يطب منك تزويدنا بمعلومات شخصية محددة,مثل اسمك, عنوان الشحن اليك, بريدك الالكتروني و/أو رقم هاتفك ومعلومات مشابهة اخرى, وبعض المعلومات الاضافية عنك مثل تاريخ ميلادك أو اي معلومات محددة لهويتك. إضافة إلى ذلك وبهدف توثيقنا لهويتك قد نحتاج منك ان تقدم لنا اثبات ساري المفعول يثبت هويتك (مثلا نسخة عن جواز سفرك, تاشيرة او تصريح الاقامة, الهوية الوطنية و/ أو رخصة القيادة).
قد نحتاج ايضا جمع معلومات مالية محددة منك, مثلا بطاقتك الائتمانيةو/أو تفاصيل حسابك المصرفي حتى يتم إضافتها إلى معلومات حسابك في الموقع، و ستسخدم هذه المعلومات المالية لاهداف الفوترة ولإتمام عملياتك في الموقع .
بعد تسجيلك في الموقع, ينبغى عليك عدم نشر اي معلومات شخصية (بما في ذلك اي معلومات مالية) على اي جزء من الموقع, باستثناء جزء" إدارة الحساب" وهذا من شأنه حمايتك من امكانية تعرضك للاحتيال او سرقة معلومات هويتك. كما ان نشرك لأي من معلوماتك الشخصية على اي جزء من الموقع باستثناء"حسابي" قد يعتبر مخالفة لهذه الإتفاقية قد يتسبب بأخذ إجراء بحق عضويتك بالموقع .
سوف يتم تسجيل معلومات عملياتك و إنشطتك في الموقع سواء كانت عملية شراء أو بيع أو عرض سلع، أو سحب مبالغ أو إيداع مبالغ أو غيرها من الأنشطة الخاصة بعملياتك في الموقع
الرجاء ملاحظة اننا قد نستخدم عنوان برتوكول الانترنت خاصتك او (IP) (وهو عبارة عن رقم مميز يعطى لمقدم خدمة الانترنت لك او (ISP) بهدف تحليل انماط نشاطاتك التي تمارسها على الموقع, وبالتالي تحسين ادارتك على الموقع. وقد نجمع ايضا معلوماتك عن تفاصيل عمليات التصفح
قد نجمع معلومات اضافية منك او عنك بطرق اخرى لم يتم هنا ذكر تفاصيلها, مثل تسجيل المكالمات الهاتفية مع موظفي مركز العناية بالمستخدمين او من خلال اجاباتك على استبياناتنا .وقد نجمع نجمع معلومات لاهداف احصائية حينها تبقى اسماء اصحاب المعلومات مجهولة.
استخدامنا لمعلوماتك الشخصية
<br/>
نستخدم معلوماتك الشخصية فقط لتقديم خدمات ودعم من فريق الزبائن, ويهدف قياس مستوى خدماتنا وتحسينها لك, ومنع النشاطات غير القانونية, وتنفيذ بنود اتفاقيتنا معك، اضافة الى تذليل العوائق, وجمع الرسوم, وتزويدك برسائل الكترونية ترويجية, وكذلك من اجل توثيق المعلومات التي زودتنا بها مع اطراف ثالثة , مثلا قد نلجأ الى الاشتراك في بعض من معلوماتك الشخصية مع البنوك او التفويض لبطاقات الائتمان لمعالجةوتوثيق خدمات مع اطراف ثالثة لاهداف تتعلق بزيادة مستوى الأمن .
برغم حرصنا للمحافظة على سرّيتك ,الا اننا قد نحتاج الى الافصاح عن معلوماتك الشخصية لاجهزة تنفيذ القانون, الهيئات الحكومية او اطراف ثالثة نكون ملزمين بفعل ذلك باوامر من المحكمة اوغيرها من الدوائر القانونية, لنكون ملتزمين ببنود القانون, عند اعتقادنا ان الافصاح عن معلوماتك الشخصية ربما يقي من أذى جسدي او خسارة مالية, او للاخبار عن نشاط مشبوه او للتحقيق في امكانية انتهاك لبنود وشروط اتفاقية المستخدم.
في حال تم بيع فتنس جوردان دوت كوم , او اي من مؤسساته الفرعية او اصوله التجارية قد نفصح عن معلوماتك الشخصية للمشتري المحتمل, وذلك بهدف استمرار نشاط الموقع.
اضافة الى ذلك فان المعلومات المتعلقة بالبضائع التي تقوم بشرائها او بيعها,او المزادات التي تشارك فيها على الموقع, هذه المعلومات قد تتضمن تفاصيل بخصوص هوية المستخدم, التغذية المسترجعة والملاحظات المتعلقة باستخدامك للموقع. غير ذلك فاننا سوف نكشف عن معلوماتك الشخصية لطرف ثالث بعد أخذ اذن واضح منك.
نحن لا نبيع ولا نؤجر لطرف ثالث اي من معلوماتك الشخصية ضمن نطاق عملنا التجاري العادي, وسوف نشرك اخرين في معلوماتك الشخصية فقط وفق ما جاء في (إتفاقية سرية المعلومات) هذا.
بمجرد تسجيلك في الموقع تعتبر أنك أعطيتنا تفويضا واضحا لتسليمك رسائل إلكترونية ترويجية حول خدماتنا, إضافة الى رسائل إلكترونية بخصوص التغيرات,والملامح الجديدة على الموقع , فلو انك في اي وقت قررت بعدم رغبتك في تلقي مثل هذه الرسائل,ماعليك سوى إختيار الرابط الخاص بإيقاف إرسال هذه الرسائل إلى عنوانك البريدي والمتوفر في اسفل اي من هذه الرسائل الاكترونية او الذهاب الى جزء "حسابي" على الموقع.
استخدامك لمعلوماتك الشخصية ومعلومات المستخدمين الاخرين
<br/>
قد يكون الاعضاء في حاجة للمشاركة في المعلومات الشخصية (بما في ذلك المعلومات المالية) مع بعضهم البعض,بهدف استكمال عمليات على الموقع. عليك ان تحترم في جميع الاوقات سرية الاعضاء الاخرين في الموقع.
نحن لا نضمن سرية معلوماتك حين تشارك بها اعضاء اخرين,لذا عليك طلب معلومات حول مستوى السرية وعقود الأمان من اي اعضاء اخرين على الموقع قبل مباشرتك و تزويدهم بأي بيانات أو معلومات مالية أو شخصية، وبإمكانك الرجوع لموظفي مركز خدمة العملاء للتأكد من صلاحية المطلوب و أمانه.
عقد السرية هذا لا يغطي كشفك لمعلوماتك الشخصية لعضو في موقع اخر. انت موافق على استخدام اي معلومات شخصية تتلقاها من عضو في موقع اخر بغرض اتمام عملية على موقعنا, فقط لهذه العملية,وانك لن تستخدم المعلومات المتلقاة من عضو في موقع اخر لاي اهداف اخرى(باستثناء تفويض واضح من العضو في الموقع الاخر)
انت تعلم وموافق انك سوف لن تستخدم المعلومات الشخصية التي وردتك من الموقع عن أي عضو في موقع اخر وفق القوانين المعمول بها في هذه الوثيقة.
نت على علم و موافق بأنه عليك إستخدام المعلومات الشخصية التي وردتك من المستخدمين ضمن هذا الإتفاقية
إستخدام، دخول، تصفح، وتعديل معلوماتك الشخصية
<br/>
باستطاعتك الوصول ومراجعة معلوماتك الشخصية من خلال صفحة إدارة "حسابي"على الموقع, فاذا ما تغيرت معلوماتك الشخصية باي طريقة,او انك اعطيت معلومات غير صحيحة على الموقع,عليك تحديثها او تصحيحها حالا,اما من خلال عرضها على "حسابي" او من خلال الاتصال بفريق خدمة العملاء.
يرجى العلم أننا سوف نحتفظ بمعلوماتك الشخصية خلال وبعد انتهائك من استخدام الموقع بحسب ما هو مطلوب قانونا,وذلك بهدف التغلب على العوائق التقنية ,ولمنع الاحتيال,وللمساعدة في اي تحقيق قانوني ولاتخاذ اي اجراءات اخرى ينص عليها القانون.
الروابط مع مواقع الكترونية لاطراف ثالثة
<br/>
قد يحتوي الموقع على روابط مع مواقع الكترونية اخرى, الرجاء العلم اننا غير مسؤولين عن مستوى الأمان أو الطرق المتبعة في المواقع الاخرى.
نحن نشجعك حين تنتقل من موقعنا الى أي موقع أخر بان تبادر بقراءة بيانات (إتفاقية سرية المعلومات) الخاصة بهم إذا كان في نيتك اعطائهم معلوماتك الشخصية .
ان (إتفاقية سرية المعلومات) عندنا يطبق فقط على معلوماتك الشخصية اتي جمعناها على موقعنا.
برمجيات التصفح المستخدمة على جهازك الشخصي
<br/>
مثل العديد من مواقع الانترنت فان موقعنا يستخدم ملفات برمجية صغيرة يتم تثبيتها على لجزء الصلب من حاسوبك, فحين تذهب لزيارة صفحات انترنت معينة على المواقع, تتعرف السجل على المتصفح browser من خلال رقم فريد وعشوائي.
كما ان السجلات" الكوكيز" التي نستخدمها لا تكشف اي من معلوماتك الشخصية.هذه السجلات تساعدنا في تحسين ادائك على الموقع وتعيننا على تفهم اي اجزاء من الموقع هي الاكثر استخداما,انت لك مطلق الحرية في الغاء هذه السجلات اذا أتيح لك ذلك من المتصفح,مع ان ذلك قد يفضي الى وقفك من استخدام الموقع.
لا للرسائل الالكترونية التدميرية أو المخادعة
<br/>
نحن لا نتسامح مع الرسائل التدميرية,من اجل اخبار الموقع عن اي رسائل الكترونية تدميرية او مخادعة, الرجاء ارسال رسالة الكترونية الى info@thecakorinas.com ,فان الاتصال لارسال رسائل الكترونية تلحق الضرر بنا او اي محتويات سيؤدي الى نقض بنود اتفاقية المستخدم. فنحن نفحص الرسائل اوتوماتيكيا, وقد نلجأ الى الفلترة اليدوية لها لمعرفة ما اذا هناك رسائل تدميرية او فيروسات او هجمات ضارة واي نشاطات ماكرة اخرى او غير قانونية.
<br/>
حماية معلوماتك الشخصية
<br/>
نحن نحتفظ بمعلوماتك (إتفاقية سرية المعلومات) في ملفات الكترونية في شيكاغو، الولايات المتحدة الأمريكية, فانت حين تزودنا بمعلوماتك الشخصية,تكون قد منحتنا المسؤولية للاحتفاظ بهذه المعلومات في شيكاغو و الولايات المتحدة الأمريكية, ونحن نتخذ كل الاحتياطات للمحافظة على معلوماتك (إتفاقية سرية المعلومات) , وذلك بعدم الوصول اليها من اطراف غير مسؤولة ,او استخدامها او الكشف عنها.
على اي حال فان الانترنت وسيلة غير امنة ونحن لا نضمن سرية معلوماتك الشخصية,وعليك ان تدخل اسم المستخدم وكلمة الدخول في كل مرة ترغب فيها بالدخول الى حسابك او اتمام صفقات على الموقع,اختر كلمة الدخول بدقه بالستخدام ارقام مميزة وحروف بمواصفات خاصة. لا تفصح عن اسم المستخدم وكلمة الدخول لاي احد,فاذا ما اعتقدت ان اسم المستخدم او كلمة الدخول قد تم كشفها, بادر بالاتصال فورا بفريق الدعم في الموقع لتغييرها.
كيف تتصل بنا للاستفسار بخصوص (إتفاقية سرية المعلومات)
<br/>
اذا كان لديك اسئلة او اهتمامات حول جمعنا واستخدامنا لمعلوماتك الشخصية ,الرجاء الاتصال على فريق مركز العناية بالمستخدمين أو مراسلتنا على العنوان البريدي الخاص بمركز خدمة العملاء ببلدك
<br/>
                        </div>
@else
<div  style="text-align: left;direction: ltr;">
<h1>Privacy Policy of thecakorinas.com</h1>

<h2>Introduction</h2>
<p>
This Privacy Policy explains how we collect data and how we protect users’ personal information.
By providing us with your personal information, you authorize us to process it in accordance with this policy.
We may update this policy at any time by publishing the revised version on our website.
</p>

<h2>Scope of This Policy</h2>
<ul>
    <li>Collection and retention of your personal information</li>
    <li>Use and modification of your personal information</li>
    <li>Your use of personal information</li>
    <li>Accessing and updating your information</li>
    <li>Communication tools and third-party links</li>
    <li>Cookies and browser technologies</li>
    <li>Protection of your information</li>
    <li>How to contact us</li>
</ul>

<h2>Collection and Retention of Personal Information</h2>
<p>
When registering on our website, you may be required to provide personal information such as your name,
shipping address, email address, phone number, date of birth, and identity details.
We may also request valid proof of identity (passport, national ID, residence permit, or driver’s license).
</p>

<p>
Financial information such as credit card or bank account details may also be collected
for billing purposes and transaction processing.
</p>

<p>
We record transactions and activities on the website including purchases, sales,
withdrawals, deposits, and related activities.
We may collect IP address and browsing information to improve site management.
</p>

<h2>Use of Personal Information</h2>
<p>
We use your personal information to:
</p>
<ul>
    <li>Provide customer service and support</li>
    <li>Improve our services</li>
    <li>Prevent illegal activities</li>
    <li>Process payments and transactions</li>
    <li>Send promotional and service-related emails</li>
</ul>

<p>
We do not sell or rent your personal information to third parties.
However, we may disclose information if required by law or legal authorities.
</p>

<h2>Your Use of Information</h2>
<p>
Members may share information to complete transactions.
You must respect the confidentiality of other users' personal information
and use it only for completing transactions on our website.
</p>

<h2>Access and Update of Information</h2>
<p>
You can access and update your personal information through the "My Account" section.
You are responsible for keeping your information accurate and up to date.
</p>

<h2>Third-Party Links</h2>
<p>
Our website may contain links to third-party websites.
We are not responsible for their privacy practices.
Please review their privacy policies before providing personal information.
</p>

<h2>Cookies</h2>
<p>
We use cookies to improve website performance and user experience.
You may disable cookies through your browser settings,
but doing so may limit certain functionalities of the website.
</p>

<h2>Email Policy</h2>
<p>
We do not tolerate misleading or harmful emails.
If you receive suspicious communication, please contact us at:
</p>
<p><strong>info@thecakorinas.com</strong></p>

<h2>Protection of Personal Information</h2>
<p>
We take reasonable measures to protect your personal information
from unauthorized access, use, or disclosure.
However, no internet transmission is completely secure.
</p>

<h2>Contact Us</h2>
<p>
If you have any questions about this Privacy Policy,
please contact our Customer Support team.
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
