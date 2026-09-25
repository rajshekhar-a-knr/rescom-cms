<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $product->title }} Demo Credentials</title>
</head>
<body style="margin:0;background:#f6f8fb;font-family:Arial,sans-serif;color:#111827">
    <div style="max-width:640px;margin:0 auto;padding:28px 16px">
        <div style="background:#ffffff;border-radius:16px;padding:28px;border:1px solid #e5e7eb">
            @if($siteLogo)
                <img src="{{ $siteLogo }}" alt="{{ $siteName }}" style="height:48px;object-fit:contain;margin-bottom:18px">
            @endif

            <h1 style="font-size:24px;line-height:1.25;margin:0 0 10px;color:#0f172a">{{ $product->title }} Demo Access</h1>
            <p style="font-size:15px;line-height:1.7;color:#475569;margin:0 0 22px">
                Thank you for requesting a demo from {{ $siteName }}. Use the credentials below to explore the product.
            </p>

            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:14px;padding:18px;margin-bottom:20px">
                @if($product->demo_url)
                    <p style="margin:0 0 12px"><strong>Demo URL:</strong> <a href="{{ $product->demo_url }}" style="color:#2563eb">{{ $product->demo_url }}</a></p>
                @endif
                @if($product->login_url)
                    <p style="margin:0 0 12px"><strong>Login URL:</strong> <a href="{{ $product->login_url }}" style="color:#2563eb">{{ $product->login_url }}</a></p>
                @endif
                @if($product->credential_email)
                    <p style="margin:0 0 12px"><strong>Email:</strong> {{ $product->credential_email }}</p>
                @endif
                @if($product->credential_username)
                    <p style="margin:0 0 12px"><strong>Username:</strong> {{ $product->credential_username }}</p>
                @endif
                @if($product->credential_password)
                    <p style="margin:0"><strong>Password:</strong> {{ $product->credential_password }}</p>
                @endif
            </div>

            @if($product->credential_notes)
                <div style="background:#fff7ed;border:1px solid #fed7aa;border-radius:14px;padding:16px;margin-bottom:20px">
                    <strong style="display:block;margin-bottom:8px;color:#9a3412">Demo Notes</strong>
                    <div style="font-size:14px;line-height:1.7;color:#7c2d12">{!! nl2br(e($product->credential_notes)) !!}</div>
                </div>
            @endif

            <p style="font-size:13px;line-height:1.6;color:#64748b;margin:0">
                Please do not share these credentials publicly. If you need help, reply to this email and our team will assist you.
            </p>
        </div>
    </div>
</body>
</html>


