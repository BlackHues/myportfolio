<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks — inquiry received</title>
</head>
<body style="margin:0;padding:0;background-color:#faf5ff;font-family:Segoe UI,Roboto,Helvetica,Arial,sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:linear-gradient(180deg,#ede9fe 0%,#faf5ff 40%,#ffffff 100%);padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width:560px;background:#ffffff;border-radius:20px;overflow:hidden;box-shadow:0 20px 40px -15px rgba(109,40,217,0.2);">
                    <tr>
                        <td style="background:linear-gradient(135deg,#6366f1 0%,#8b5cf6 50%,#a855f7 100%);padding:32px 28px;text-align:center;">
                            <p style="margin:0;font-size:42px;line-height:1;">✉️</p>
                            <h1 style="margin:12px 0 0;font-size:22px;font-weight:700;color:#ffffff;">Thanks, {{ $senderName }}!</h1>
                            <p style="margin:10px 0 0;font-size:14px;color:rgba(255,255,255,0.9);line-height:1.5;">Your inquiry is recorded. I’ll follow up with a proper quote or clarifications.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px;">
                            <table role="presentation" width="100%" style="margin-bottom:16px;">
                                <tr>
                                    <td style="padding:12px 16px;background:#f8fafc;border-radius:12px;border:1px solid #e2e8f0;">
                                        <p style="margin:0;font-size:11px;color:#64748b;text-transform:uppercase;letter-spacing:0.06em;">You selected</p>
                                        <p style="margin:6px 0 0;font-size:15px;color:#0f172a;font-weight:600;">{{ $projectTypeLabel }}</p>
                                        <p style="margin:8px 0 0;font-size:14px;color:#4f46e5;font-weight:600;">{{ $packageLine }}</p>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin:0 0 16px;font-size:15px;color:#475569;line-height:1.65;">Your message:</p>
                            <div style="background:#f8fafc;border-radius:14px;border:1px solid #e2e8f0;padding:18px 20px;font-size:14px;color:#334155;line-height:1.65;white-space:pre-wrap;">{{ $bodyText }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 28px 28px;text-align:center;">
                            <p style="margin:0;font-size:14px;font-weight:600;color:#4f46e5;">— Arjun Kumar H</p>
                            <p style="margin:6px 0 0;font-size:12px;color:#94a3b8;">Freelance & full stack web</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
