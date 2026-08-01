<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subscription Reminder</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f4f6f9">
    <tr>
        <td align="center" style="padding:40px 15px;">

            <table role="presentation"
                   width="100%"
                   cellpadding="0"
                   cellspacing="0"
                   border="0"
                   style="max-width:650px;background:#ffffff;border:1px solid #e5e5e5;">

                <!-- Header -->
                <tr>
                    <td align="center"
                        bgcolor="#ff9800"
                        style="padding:35px 20px;">

                        <h1 style="margin:0;color:#ffffff;font-size:28px;font-weight:bold;">
                            Subscription Reminder
                        </h1>

                        <p style="margin:10px 0 0;color:#ffffff;font-size:15px;">
                            Your subscription will expire soon.
                        </p>

                    </td>
                </tr>

                <!-- Greeting -->
                <tr>
                    <td style="padding:35px 35px 20px;">

                        <p style="margin:0;font-size:17px;color:#333333;">
                            Hello
                            <strong>{{ $data['name'] }}</strong>,
                        </p>

                    </td>
                </tr>

                <!-- Description -->

                <tr>
                    <td style="padding:0 35px;">

                        <p style="font-size:15px;color:#555555;line-height:26px;margin:0;">
                            This is a friendly reminder that your subscription
                            will expire in

                            <strong style="color:#d32f2f;">
                                {{ $data['days_left'] }} day(s)
                            </strong>.

                        </p>

                    </td>
                </tr>

                <!-- Details -->
                <tr>
                    <td style="padding:30px 35px;">
                        <table
                            role="presentation"
                            width="100%"
                            cellpadding="10"
                            cellspacing="0"
                            border="1"
                            style="border-collapse:collapse;border-color:#dddddd;">

                            <tr bgcolor="#fafafa">
                                <td><strong>Plan</strong></td>
                                <td>{{ $data['plan_name'] }}</td>
                            </tr>

                            <tr>
                                <td><strong>Expiry Date</strong></td>
                                <td>{{ $data['expiry_date'] }}</td>
                            </tr>

                            <tr bgcolor="#fafafa">
                                <td><strong>Remaining</strong></td>
                                <td>{{ $data['days_left'] }} Day(s)</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Button -->
                <tr>
                    <td align="center" style="padding:10px 35px 35px;">

                        <a href="#"
                           style="
                           background:#ff9800;
                           color:#ffffff;
                           text-decoration:none;
                           padding:14px 30px;
                           display:inline-block;
                           font-size:16px;
                           font-weight:bold;">
                            Renew Subscription
                        </a>

                    </td>
                </tr>

                <!-- Message -->

                <tr>
                    <td style="padding:0 35px 35px;">

                        <p style="font-size:14px;color:#666666;line-height:25px;">
                            If you have already renewed your subscription,
                            please ignore this email.
                        </p>

                        <p style="font-size:14px;color:#666666;">
                            Need help? Contact our support team anytime.
                        </p>

                    </td>
                </tr>

                <!-- Footer -->

                <tr bgcolor="#f7f7f7">
                    <td align="center"
                        style="padding:25px;border-top:1px solid #dddddd;">

                        <p style="margin:0;font-size:13px;color:#777777;">
                            © {{ date('Y') }} Hospital Management System
                        </p>

                        <p style="margin-top:8px;font-size:12px;color:#999999;">
                            This is an automated email. Please do not reply.
                        </p>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>