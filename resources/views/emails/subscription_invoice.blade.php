<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $gymName }} - فاتورة الاشتراك</title>
    <style>
        body { font-family: Tahoma, Arial, sans-serif; background: #f5f7fb; margin: 0; padding: 0; direction: rtl; }
        .wrapper { max-width: 640px; margin: 30px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 18px rgba(0,0,0,.08); }
        .header { background: linear-gradient(135deg, #0d1b2a 0%, #1a3a5c 100%); padding: 28px 36px; color: #fff; text-align: center; }
        .header img { max-width: 160px; max-height: 70px; object-fit: contain; }
        .header h1 { margin: 14px 0 4px; font-size: 1.25rem; font-weight: 700; }
        .header p { margin: 0; font-size: .85rem; opacity: .75; }
        .body { padding: 32px 36px; }
        .badge { display: inline-block; background: #e8f5e9; color: #27ae60; border-radius: 20px; padding: 4px 16px; font-size: .8rem; font-weight: 700; margin-bottom: 20px; }
        .section-title { font-size: .75rem; font-weight: 700; color: #999; text-transform: uppercase; letter-spacing: .6px; margin: 0 0 8px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        .info-table td { padding: 8px 10px; font-size: .95rem; color: #333; }
        .info-table td:first-child { font-weight: 700; width: 40%; color: #555; }
        .info-table tr:nth-child(even) td { background: #f8fafd; }
        .totals-box { background: #f8fafd; border: 1px solid #e8ecf5; border-radius: 8px; padding: 16px 18px; margin-bottom: 24px; }
        .totals-box .row { display: flex; justify-content: space-between; padding: 5px 0; font-size: .95rem; color: #333; }
        .totals-box .row.bold { font-weight: 700; font-size: 1rem; border-top: 1px solid #dde3f0; margin-top: 6px; padding-top: 10px; }
        .terms-box { background: #fffbf0; border: 1px solid #f5d77e; border-radius: 8px; padding: 16px 18px; margin-bottom: 8px; }
        .terms-box h3 { margin: 0 0 10px; font-size: .9rem; color: #b8860b; }
        .terms-box p { margin: 0; font-size: .88rem; color: #555; line-height: 1.7; white-space: pre-wrap; }
        .footer { background: #f5f7fb; padding: 18px 36px; text-align: center; font-size: .78rem; color: #aaa; border-top: 1px solid #eee; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        @if(!empty($gymLogo))
            <img src="{{ $gymLogo }}" alt="{{ $gymName }}">
        @endif
        <h1>{{ $gymName }}</h1>
        <p>فاتورة اشتراك / Subscription Invoice</p>
    </div>

    <div class="body">
        <span class="badge">&#10003; تم الاشتراك بنجاح</span>

        <p class="section-title">تفاصيل الفاتورة / Invoice Details</p>
        <table class="info-table">
            <tr>
                <td>رقم الفاتورة / Invoice #</td>
                <td>{{ $invoiceId }}</td>
            </tr>
            <tr>
                <td>التاريخ / Date</td>
                <td>{{ $createdAt }}</td>
            </tr>
            <tr>
                <td>الاسم / Name</td>
                <td>{{ $memberName }}</td>
            </tr>
            <tr>
                <td>الاشتراك / Subscription</td>
                <td>{{ $subscriptionName }}</td>
            </tr>
            <tr>
                <td>تاريخ البداية / Start Date</td>
                <td>{{ $joiningDate }}</td>
            </tr>
            <tr>
                <td>تاريخ الانتهاء / Expire Date</td>
                <td>{{ $expireDate }}</td>
            </tr>
        </table>

        <div class="totals-box">
            <div class="row">
                <span>المبلغ (بدون ضريبة) / Amount (excl. VAT)</span>
                <span>{{ number_format($amount - $vat, 2) }} {{ $currency }}</span>
            </div>
            @if($vatPercentage > 0)
            <div class="row">
                <span>ضريبة القيمة المضافة ({{ $vatPercentage }}%) / VAT</span>
                <span>{{ number_format($vat, 2) }} {{ $currency }}</span>
            </div>
            @endif
            <div class="row bold">
                <span>الإجمالي / Total</span>
                <span>{{ number_format($amount, 2) }} {{ $currency }}</span>
            </div>
        </div>

        @if(!empty($terms))
        <div class="terms-box">
            <h3>&#128196; الشروط والأحكام / Terms &amp; Conditions</h3>
            <p>{!! $terms !!}</p>
        </div>
        @endif
    </div>

    <div class="footer">
        هذه الرسالة أُرسلت تلقائياً من {{ $gymName }} &bull; This email was sent automatically from {{ $gymName }}
    </div>
</div>
</body>
</html>
