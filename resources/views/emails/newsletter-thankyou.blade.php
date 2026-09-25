<div style="margin:0;padding:0;background:#eef2f7">
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent">
        Thanks for subscribing to {{ $siteName }} updates.
    </div>
    <div style="max-width:640px;margin:0 auto;padding:28px 16px;font-family:Inter,Arial,sans-serif;color:#0f172a">
        <div style="background:#ffffff;border-radius:18px;box-shadow:0 18px 40px rgba(15,23,42,0.08);overflow:hidden;border:1px solid #e6ebf3">
            <div style="background:linear-gradient(135deg,#eff6ff 0%,#f8fafc 60%,#ffffff 100%);padding:24px;border-bottom:1px solid #eef2f7;text-align:center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                    <tr>
                        <td align="center">
                            @if($siteLogo)
                                <img src="{{ $siteLogo }}" alt="{{ $siteName }}" style="height:56px;object-fit:contain;display:block;margin:0 auto;">
                            @else
                                <div style="font-size:22px;font-weight:800;color:#0f4c81;letter-spacing:0.4px;text-align:center">{{ $siteName }}</div>
                            @endif
                            <div style="margin-top:10px;font-size:12px;font-weight:600;color:#64748b;letter-spacing:1px;text-transform:uppercase;text-align:center">
                                Newsletter Subscription
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="padding:24px">
                <h2 style="margin:0 0 6px;font-size:22px;color:#0f172a">
                    {{ $isReturning ? 'Welcome back!' : 'You are subscribed!' }}
                </h2>
                <p style="margin:0 0 16px;color:#475569;line-height:1.65">
                    {{ $isReturning
                        ? 'Thanks for re-joining our newsletter. You will now receive the latest updates, insights, and announcements.'
                        : 'Thanks for joining our newsletter. You will receive the latest updates, insights, and announcements from our team.' }}
                </p>
                <div style="margin-top:16px;padding:12px 14px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;color:#334155;font-size:13px">
                    If you did not request this subscription, you can ignore this email.
                </div>
            </div>
            <div style="padding:16px 24px;background:#f8fafc;border-top:1px solid #eef2f7;color:#94a3b8;font-size:12px;line-height:1.7">
                This is an automated confirmation from {{ $siteName }}.
                <div style="margin-top:10px">
                    If you prefer not to receive these emails, you can
                    <a href="{{ $unsubscribeUrl }}" style="color:#0f4c81;text-decoration:underline">unsubscribe here</a>.
                </div>
            </div>
        </div>
        <div style="text-align:center;margin-top:14px;color:#94a3b8;font-size:11px">
            (c) {{ date('Y') }} {{ $siteName }}. All rights reserved.
        </div>
    </div>
</div>
