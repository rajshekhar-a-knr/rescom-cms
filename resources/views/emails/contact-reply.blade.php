<!DOCTYPE html>
<html>
<head><style>body{font-family:Arial,sans-serif;background:#f8fafc;margin:0;padding:20px}.container{max-width:600px;margin:0 auto;background:white;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08)}.header{background:linear-gradient(135deg,#0f4c81,#1e6bb5);color:white;padding:32px}.body{padding:36px}.footer{background:#f8fafc;padding:20px;font-size:12px;color:#94a3b8;text-align:center}</style></head>
<body>
<div class="container">
    <div class="header">
        <h1 style="margin:0 0 6px;font-size:22px">Thank You for Reaching Out!</h1>
        <p style="margin:0;opacity:0.8;font-size:14px">Here is a reply from our team</p>
    </div>
    <div class="body">
        <p style="color:#475569;font-size:15px;margin:0 0 24px">Dear {{ $contact->name }},</p>
        <div style="background:#f0f9ff;border-left:4px solid #3b82f6;border-radius:0 10px 10px 0;padding:20px 24px;margin:0 0 24px">
            <p style="color:#1e40af;margin:0;font-size:15px;line-height:1.8;white-space:pre-wrap">{{ $replyMessage }}</p>
        </div>
        <p style="color:#64748b;font-size:14px;line-height:1.7">If you have any further questions, please feel free to reply to this email or call us at <strong>{{ setting('contact_phone') }}</strong>.</p>
        <p style="color:#64748b;font-size:14px;margin:24px 0 0">Best regards,<br><strong style="color:#0f4c81">Rescom Team</strong></p>
    </div>
    <div class="footer">
        {{ setting('site_name') }} &bull; {{ setting('contact_email') }} &bull; {{ setting('contact_phone') }}<br>
        {{ setting('contact_address') }}
    </div>
</div>
</body>
</html>
