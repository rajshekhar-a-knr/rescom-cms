<!DOCTYPE html>
<html>
<head><style>body{font-family:Arial,sans-serif;background:#f8fafc;margin:0;padding:20px}.container{max-width:600px;margin:0 auto;background:white;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08)}.header{background:linear-gradient(135deg,#0f4c81,#1e6bb5);color:white;padding:30px 32px}.header h1{margin:0;font-size:22px}.body{padding:32px}.field{margin-bottom:18px;padding:14px 16px;background:#f8fafc;border-radius:8px;border-left:3px solid #3b82f6}.label{font-size:11px;text-transform:uppercase;letter-spacing:1px;color:#94a3b8;margin-bottom:4px}.value{font-size:15px;color:#1e293b;font-weight:500}.message-box{background:#fffbeb;border:1.5px solid #fcd34d;border-radius:8px;padding:16px;margin:20px 0}.footer{background:#f8fafc;padding:20px 32px;font-size:12px;color:#94a3b8;text-align:center}</style></head>
<body>
<div class="container">
    <div class="header"><h1>🔔 New Website Inquiry</h1><p style="margin:6px 0 0;opacity:0.8;font-size:14px">Received {{ now()->format('M d, Y h:i A') }}</p></div>
    <div class="body">
        <div class="field"><div class="label">Name</div><div class="value">{{ $contact->name }}</div></div>
        <div class="field"><div class="label">Email</div><div class="value"><a href="mailto:{{ $contact->email }}" style="color:#3b82f6">{{ $contact->email }}</a></div></div>
        @if($contact->phone)<div class="field"><div class="label">Phone</div><div class="value">{{ $contact->phone }}</div></div>@endif
        @if($contact->company)<div class="field"><div class="label">Company</div><div class="value">{{ $contact->company }}</div></div>@endif
        @if($contact->service_interested)<div class="field"><div class="label">Service Interested</div><div class="value">{{ $contact->service_interested }}</div></div>@endif
        @if($contact->budget_range)<div class="field"><div class="label">Budget Range</div><div class="value">{{ $contact->budget_range }}</div></div>@endif
        <div class="message-box"><div class="label">Message</div><p style="margin:8px 0 0;line-height:1.7;color:#374151">{{ $contact->message }}</p></div>
        <div style="text-align:center;margin-top:24px"><a href="{{ url('/admin/login') }}" style="background:linear-gradient(135deg,#0f4c81,#1e6bb5);color:white;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px">View in Admin Panel</a></div>
    </div>
    <div class="footer">Rescom Admin Notification System</div>
</div>
</body>
</html>
