<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب اشتراك جديد في الدايت بليت</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f7fb; margin: 0; padding: 0; direction: rtl; }
        .wrapper { max-width: 640px; margin: 30px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 18px rgba(0,0,0,.08); }
        .header { background: linear-gradient(135deg, #4a2955 0%, #7e4c8a 100%); padding: 32px 36px; color: #fff; }
        .header h1 { margin: 0; font-size: 1.3rem; font-weight: 700; }
        .header p { margin: 6px 0 0; font-size: .85rem; opacity: .8; }
        .body { padding: 32px 36px; }
        .section-title { font-size: .9rem; font-weight: 700; color: #7e4c8a; margin: 26px 0 10px; padding-bottom: 6px; border-bottom: 2px solid #f0e6f8; }
        .section-title:first-child { margin-top: 0; }
        .field { margin-bottom: 16px; }
        .field label { display: block; font-size: .75rem; font-weight: 700; color: #999; text-transform: uppercase; letter-spacing: .6px; margin-bottom: 5px; }
        .field .value { font-size: .95rem; color: #1a1a2e; background: #f8fafd; border: 1px solid #e8ecf5; border-radius: 8px; padding: 10px 14px; line-height: 1.6; word-break: break-word; }
        .field .value a { color: #7e4c8a; text-decoration: none; }
        .badge { display: inline-block; border-radius: 20px; padding: 3px 12px; font-size: .75rem; font-weight: 700; margin-bottom: 16px; }
        .badge.paid { background: #e8f5e9; color: #27ae60; }
        .badge.lead { background: #fff3e0; color: #e67e22; }
        .total-row { display: flex; justify-content: space-between; font-size: 1.05rem; font-weight: 800; color: #7e4c8a; padding-top: 10px; }
        .footer { background: #f5f7fb; padding: 18px 36px; text-align: center; font-size: .78rem; color: #aaa; border-top: 1px solid #eee; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>&#127869; {{ $isPaid ? 'طلب اشتراك جديد مدفوع' : 'طلب اشتراك جديد بانتظار التواصل' }}</h1>
        <p>New diet plan order — {{ $subscriptionName ?? '' }}</p>
    </div>
    <div class="body">
        @if($isPaid)
            <span class="badge paid">&#10003; تم الدفع</span>
        @else
            <span class="badge lead">&#9203; بانتظار التواصل</span>
        @endif

        <div class="section-title">بيانات العميل / Customer</div>
        <div class="field">
            <label>الاسم / Name</label>
            <div class="value">{{ $name ?? '—' }}</div>
        </div>
        <div class="field">
            <label>الهاتف / Phone</label>
            <div class="value">
                @if(!empty($phone))<a href="tel:{{ $phone }}">{{ $phone }}</a>@else — @endif
            </div>
        </div>
        <div class="field">
            <label>البريد الإلكتروني / Email</label>
            <div class="value">
                @if(!empty($email))<a href="mailto:{{ $email }}">{{ $email }}</a>@else — @endif
            </div>
        </div>
        <div class="field">
            <label>العنوان / Address</label>
            <div class="value">{{ $address ?? '—' }}</div>
        </div>
        <div class="field">
            <label>النوع / Gender</label>
            <div class="value">
                @if((int) ($gender ?? 0) === 1) ذكر / Male
                @elseif((int) ($gender ?? 0) === 2) أنثى / Female
                @else — @endif
            </div>
        </div>
        <div class="field">
            <label>تاريخ الميلاد / Date of Birth</label>
            <div class="value">
                @if(!empty($dob))
                    {{ \Illuminate\Support\Carbon::parse($dob)->format('Y-m-d') }}
                @else — @endif
            </div>
        </div>

        <div class="section-title">تفاصيل الاشتراك / Subscription</div>
        <div class="field">
            <label>الخطة / Plan</label>
            <div class="value">{{ $subscriptionName ?? '—' }}</div>
        </div>
        @if(!empty($startDate))
        <div class="field">
            <label>تاريخ البدء / Start Date</label>
            <div class="value">{{ $startDate }}</div>
        </div>
        @endif
        @foreach($selectionGroups ?? [] as $group)
        <div class="field">
            <label>{{ $group['label'] }}</label>
            <div class="value">{{ $group['value'] }}</div>
        </div>
        @endforeach
        @if(!empty($notes))
        <div class="field">
            <label>ملاحظات / Notes</label>
            <div class="value">{{ $notes }}</div>
        </div>
        @endif

        @if(!empty($mealGroups))
        <div class="section-title">الوجبات المختارة / Selected Meals</div>
        @foreach($mealGroups as $group)
        <div class="field">
            <label>{{ $group['label'] }}</label>
            <div class="value">{{ $group['value'] }}</div>
        </div>
        @endforeach
        @endif

        @if(!empty($customizeGroups))
        <div class="section-title">تخصيصات الوجبات / Meal Customizations</div>
        @foreach($customizeGroups as $group)
        <div class="field">
            <label>{{ $group['label'] }}</label>
            <div class="value">{{ $group['value'] }}</div>
        </div>
        @endforeach
        @endif

        @if($isPaid)
        <div class="section-title">الدفع / Payment</div>
        <div class="total-row">
            <span>الإجمالي المدفوع / Total Paid</span>
            <span>{{ number_format($amount ?? 0, 2) }} {{ $currency ?? '' }}</span>
        </div>
        @endif
    </div>
    <div class="footer">
        هذه الرسالة أُرسلت تلقائياً من نظام الدايت بليت &bull; This email was sent automatically from the Dietplate system
    </div>
</div>
</body>
</html>
