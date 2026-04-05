<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New project inquiry</title>
</head>
<body style="margin:0;padding:0;background-color:#0f172a;font-family:Segoe UI,Roboto,Helvetica,Arial,sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:linear-gradient(165deg,#0f172a 0%,#134e4a 50%,#0f172a 100%);padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width:560px;background:#ffffff;border-radius:20px;overflow:hidden;box-shadow:0 25px 50px -12px rgba(0,0,0,0.35);">
                    <tr>
                        <td style="background:linear-gradient(135deg,#10b981 0%,#0d9488 100%);padding:28px 28px 22px;">
                            <p style="margin:0;font-size:11px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.85);">Portfolio · New inquiry</p>
                            <h1 style="margin:8px 0 0;font-size:22px;font-weight:700;color:#ffffff;line-height:1.3;">{{ $senderName }}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px;">
                            <table role="presentation" width="100%" style="background:#f8fafc;border-radius:14px;border:1px solid #e2e8f0;margin-bottom:16px;">
                                <tr>
                                    <td style="padding:16px 20px;">
                                        <p style="margin:0 0 6px;font-size:11px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:0.06em;">Project type</p>
                                        <p style="margin:0;font-size:15px;color:#0f172a;font-weight:600;">{{ $projectTypeLabel }}</p>
                                    </td>
                                </tr>
                            </table>
                            <table role="presentation" width="100%" style="background:#f8fafc;border-radius:14px;border:1px solid #e2e8f0;">
                                <tr>
                                    <td style="padding:18px 20px;">
                                        <p style="margin:0 0 10px;font-size:12px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:0.06em;">Mobile</p>
                                        <p style="margin:0;font-size:15px;color:#0f172a;font-weight:600;">{{ $senderPhone }}</p>
                                    </td>
                                </tr>
                            </table>
                            @if (!empty($bodyText))
                                <p style="margin:20px 0 8px;font-size:12px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:0.06em;">Message</p>
                                <div style="font-size:15px;color:#1e293b;line-height:1.65;white-space:pre-wrap;border-left:4px solid #10b981;padding-left:16px;">{{ $bodyText }}</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 28px 28px;">
                            <p style="margin:0;font-size:12px;color:#94a3b8;line-height:1.5;">Contact {{ $senderName }} on the number above (call or WhatsApp).</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
