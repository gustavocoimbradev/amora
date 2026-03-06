<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amora Reminder</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f6f9fc; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table border="0" cellpadding="0" cellspacing="0" width="600"
                    style="background-color: #ffffff; border-radius: 8px; border: 1px solid #C54B8C; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">
                    <tr>
                        <td style="padding: 30px; background-color: #b84281; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: bold;">Here's your
                                reminder!
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="font-size: 16px; color: #4b5563; margin-top: 0;">Hello,
                                {{ $reminder->user->name }}!</p>
                            <p style="font-size: 16px; color: #4b5563;">You have a scheduled reminder for today:</p>

                            <div
                                style="margin: 30px 0; padding: 25px; background-color: #f9fafb; border-left: 4px solid #b84281; border-radius: 4px;">
                                <h2 style="margin: 0 0 10px 0; font-size: 20px; color: #111827; font-weight: 700;">
                                    {{ $reminder->title }}
                                </h2>
                                <p style="margin: 0; font-size: 16px; color: #374151; line-height: 1.6;">
                                    {{ $reminder->description }}
                                </p>
                            </div>

                            <p style="font-size: 14px; color: #6b7280; line-height: 1.5;">
                                This reminder is set to a
                                <strong>
                                    @if ($reminder->frequency == 1)
                                        daily
                                    @elseif($reminder->frequency == 2)
                                        weekly
                                    @elseif($reminder->frequency == 3)
                                        monthly
                                    @else
                                        yearly
                                    @endif
                                </strong> frequency.
                            </p>

                            <div style="margin-top: 30px; text-align: center;">
                                <a href="{{ config('app.url') }}"
                                    style="background-color: #b84281; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Check
                                    all your reminders in app</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 20px 30px; background-color: #f9fafb; border-top: 1px solid #C54B8C; text-align: center;">
                            <p style="font-size: 12px; color: #9ca3af; margin: 0;">
                                &copy; {{ date('Y') }} Amora. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
