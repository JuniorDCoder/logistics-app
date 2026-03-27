<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    @php
        $replySubject = 'Re: ' . ($contactMessage->subject ?: 'Your contact form inquiry');
        $replyUrl = 'mailto:' . $contactMessage->email . '?subject=' . rawurlencode($replySubject);
    @endphp

    <h2 style="margin-bottom: 12px;">New Contact Form Submission</h2>

    <p style="margin: 4px 0;"><strong>Name:</strong> {{ $contactMessage->name }}</p>
    <p style="margin: 4px 0;"><strong>Email:</strong> {{ $contactMessage->email }}</p>

    @if(!empty($contactMessage->created_at))
        <p style="margin: 4px 0;"><strong>Submitted:</strong> {{ $contactMessage->created_at->format('Y-m-d H:i:s') }}</p>
    @endif

    @if(!empty($contactMessage->phone))
        <p style="margin: 4px 0;"><strong>Phone:</strong> {{ $contactMessage->phone }}</p>
    @endif

    @if(!empty($contactMessage->subject))
        <p style="margin: 4px 0;"><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
    @endif

    <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 16px 0;">

    <p style="margin: 0 0 8px;"><strong>Message:</strong></p>
    <p style="white-space: pre-wrap; margin-top: 0;">{{ $contactMessage->message }}</p>

    <div style="margin-top: 24px;">
        <a
            href="{{ $replyUrl }}"
            style="display: inline-block; background: #0d6efd; color: #ffffff; text-decoration: none; padding: 12px 20px; border-radius: 6px; font-weight: 600;"
        >
            Reply to Sender
        </a>
    </div>

    <p style="margin-top: 12px; font-size: 13px; color: #6b7280;">
        If the button does not work, reply manually to {{ $contactMessage->email }}.
    </p>
</body>
</html>
