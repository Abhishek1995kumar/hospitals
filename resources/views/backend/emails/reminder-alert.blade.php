<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Subscription Reminder</title>
    </head>
    <body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">
        <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
            <tr>
                <td align="center">
                    <table width="650" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.08);">
                        <!-- Header -->
                        <tr>
                            <td align="center" style="background:#ff9800;padding:35px;">
                                <h1 style="margin:0;color:#fff;font-size:28px;"> ⏰ Subscription Reminder </h1>
                                <p style="margin-top:10px;color:#fff;font-size:15px;"> Your subscription is going to expire soon. </p>
                            </td>
                        </tr>
                        <!-- Body -->
                        <tr>
                            <td style="padding:40px;">
                                <p style="font-size:17px;color:#333;"> Hello <strong>{{ $data['name'] }}</strong>, </p>
                                <p style="font-size:15px;line-height:28px;color:#666;">
                                    This is a friendly reminder that your subscription will expire in
                                    <strong style="color:#e53935;font-size:18px;"> {{ $data['days_left'] }} day(s) </strong>.
                                </p>

                                <!-- Plan Details -->
                                <table width="100%" cellpadding="12" cellspacing="0" style="margin-top:25px;background:#f8fafc;border:1px solid #e5e7eb;border-radius:6px;">
                                    <tr>
                                        <td width="35%"> <strong>Plan Name</strong> </td>
                                        <td> {{ $data['plan_name'] }} </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Expiry Date</strong> </td>
                                        <td> {{ $data['expiry_date'] }} </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Days Remaining</strong> </td>
                                        <td style="color:#e53935;font-weight:bold;"> {{ $data['days_left'] }} Day(s) </td>
                                    </tr>
                                </table>

                                <p style="margin-top:30px;font-size:15px;color:#666;line-height:28px;">
                                    To avoid interruption in your services, please renew your subscription before the expiry date.
                                </p>

                                <!-- Button -->
                                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:35px;">
                                    <tr>
                                        <td align="center">
                                            <a href="{{ url('/login') }}"
                                            style="background:#ff9800; color:#fff; text-decoration:none; padding:14px 35px;
                                                    border-radius:6px; display:inline-block; font-size:16px; font-weight:bold;">
                                                Renew Subscription
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                                <p style="margin-top:35px;font-size:14px;color:#777;line-height:26px;">
                                    If you have already renewed your subscription, kindly ignore this email.
                                </p>
                                <p style="font-size:14px;color:#777;"> Need help? Contact our support team anytime. </p>
                            </td>
                        </tr>

                        <!-- Footer -->
                        <tr>
                            <td align="center"
                                style="background:#fafafa; border-top:1px solid #eeeeee; padding:25px;">
                                <p style="margin:0;color:#888;font-size:13px;">
                                    © {{ date('Y') }} Hospital Management System
                                </p>
                                <p style="margin-top:8px;color:#999;font-size:12px;"> This is an automated email. Please do not reply. </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>