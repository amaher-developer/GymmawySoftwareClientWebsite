<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسالة جديدة من نموذج التواصل</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f7fb; margin: 0; padding: 0; direction: rtl; }
        .wrapper { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 18px rgba(0,0,0,.08); }
        .header { background: linear-gradient(135deg, #0d1b2a 0%, #1a3a5c 100%); padding: 32px 36px; color: #fff; }
        .header h1 { margin: 0; font-size: 1.3rem; font-weight: 700; }
        .header p { margin: 6px 0 0; font-size: .85rem; opacity: .75; }
        .body { padding: 32px 36px; }
        .field { margin-bottom: 20px; }
        .field label { display: block; font-size: .75rem; font-weight: 700; color: #999; text-transform: uppercase; letter-spacing: .6px; margin-bottom: 5px; }
        .field .value { font-size: .97rem; color: #1a1a2e; background: #f8fafd; border: 1px solid #e8ecf5; border-radius: 8px; padding: 10px 14px; line-height: 1.6; word-break: break-word; }
        .field .value a { color: #e8604c; text-decoration: none; }
        .message-value { white-space: pre-wrap; min-height: 60px; }
        .footer { background: #f5f7fb; padding: 18px 36px; text-align: center; font-size: .78rem; color: #aaa; border-top: 1px solid #eee; }
        .badge { display: inline-block; background: #e8f5e9; color: #27ae60; border-radius: 20px; padding: 3px 12px; font-size: .75rem; font-weight: 700; margin-bottom: 16px; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>&#128179; رسالة جديدة من نموذج التواصل</h1>
        <p>New contact form submission — Gymmawy</p>
    </div>
    <div class="body">
        <span class="badge">&#10003; رسالة جديدة</span>

        <div class="field">
            <label>الاسم / Name</label>
            <div class="value">{{ $name ?? '—' }}</div>
        </div>

        <div class="field">
            <label>الهاتف / Phone</label>
            <div class="value">
                @if(!empty($phone))
                    <a href="tel:{{ $phone }}">{{ $phone }}</a>
                @else
                    —
                @endif
            </div>
        </div>

        <div class="field">
            <label>البريد الإلكتروني / Email</label>
            <div class="value">
                @if(!empty($email))
                    <a href="mailto:{{ $email }}">{{ $email }}</a>
                @else
                    —
                @endif
            </div>
        </div>

        <div class="field">
            <label>الدولة / Country</label>
            <div class="value">{{ $country ?? '—' }}</div>
        </div>

        <div class="field">
            <label>الرسالة / Message</label>
            <div class="value message-value">
                @if(!empty($msg))
                    {{ $msg }}
                @else
                    <span style="color:#bbb;font-style:italic;">لم يتم إرسال رسالة / No message provided</span>
                @endif
            </div>
        </div>
    </div>
    <div class="footer">
        هذه الرسالة أُرسلت تلقائياً من موقع Gymmawy &bull; This email was sent automatically from gymmawy.com
    </div>
</div>
</body>
</html>
