@php
    $filteredRows = [];
    foreach ($rows as [$label, $value]) {
        if (!$value) continue;
        $filteredRows[] = [$label, $value];
    }
@endphp
<div style="margin:0;padding:0;background:#eef2f7">
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent">
        Thanks for applying to {{ $siteName }}. We have received your application.
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
                                Application Received
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="padding:24px">
                <h2 style="margin:0 0 6px;font-size:22px;color:#0f172a">Thank you for applying!</h2>
                <p style="margin:0 0 16px;color:#475569;line-height:1.65">
                    We have received your application for <strong>{{ $jobTitle }}</strong>. Our team will review your details and get back to you soon.
                </p>
                <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:14px;padding:12px">
                    <table style="width:100%;border-collapse:separate;border-spacing:0;font-size:14px">
                        @foreach($filteredRows as [$label, $value])
                            <tr>
                                <td style="padding:10px 12px;font-weight:600;color:#1e293b;border-bottom:1px solid #e2e8f0;width:180px;vertical-align:top;background:#f1f5f9">
                                    {{ $label }}
                                </td>
                                <td style="padding:10px 12px;color:#334155;border-bottom:1px solid #e2e8f0">
                                    {!! nl2br(e($value)) !!}
                                </td>
                            </tr>
                        @endforeach
                        @if(empty($filteredRows))
                            <tr>
                                <td style="padding:10px 12px;color:#64748b" colspan="2">No additional details were provided.</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div style="margin-top:18px;padding:12px 14px;background:#eef2ff;border:1px solid #e0e7ff;border-radius:12px;color:#4338ca;font-size:13px">
                    If you need to update your application, please reply to this email.
                </div>
            </div>
            <div style="padding:16px 24px;background:#f8fafc;border-top:1px solid #eef2f7;color:#94a3b8;font-size:12px;line-height:1.6">
                This is an automated confirmation from {{ $siteName }}.
            </div>
        </div>
        <div style="text-align:center;margin-top:14px;color:#94a3b8;font-size:11px">
            (c) {{ date('Y') }} {{ $siteName }}. All rights reserved.
        </div>
    </div>
</div>
