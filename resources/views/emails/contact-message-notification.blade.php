<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    <h2 style="margin-bottom: 12px;">New Contact Form Submission</h2>

    <p style="margin: 4px 0;"><strong>Name:</strong> {{ $contactMessage->name }}</p>
    <p style="margin: 4px 0;"><strong>Email:</strong> {{ $contactMessage->email }}</p>

    @if(!empty($contactMessage->phone))
        <p style="margin: 4px 0;"><strong>Phone:</strong> {{ $contactMessage->phone }}</p>
    @endif

    @if(!empty($contactMessage->subject))
        <p style="margin: 4px 0;"><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
    @endif

    <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 16px 0;">

    <p style="margin: 0 0 8px;"><strong>Message:</strong></p>
    <p style="white-space: pre-wrap; margin-top: 0;">{{ $contactMessage->message }}</p>
</body>
</html>
