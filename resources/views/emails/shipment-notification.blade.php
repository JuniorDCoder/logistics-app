<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app_name() }}</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6; background:#f0f2f8; margin:0; padding:24px 0;">
    <table role="presentation" style="max-width:600px;margin:0 auto;background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e5e7eb">
        <tr>
            <td style="background:#003580;padding:20px 24px;text-align:center">
                @if(setting('logo'))
                    <img src="{{ asset('storage/'.setting('logo')) }}" alt="{{ app_name() }}" style="height:40px">
                @else
                    <span style="color:#ffffff;font-size:20px;font-weight:700">{{ app_name() }}</span>
                @endif
            </td>
        </tr>
        <tr>
            <td style="padding:28px 28px 12px">
                {!! $bodyHtml !!}
            </td>
        </tr>
        <tr>
            <td style="padding:16px 28px 28px">
                <hr style="border:none;border-top:1px solid #e5e7eb;margin:0 0 16px">
                <p style="margin:0;font-size:12px;color:#6b7280">
                    This is an automated notification from {{ app_name() }}. If you believe you received this in error, please contact {{ setting('contact_email', '') }}.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
