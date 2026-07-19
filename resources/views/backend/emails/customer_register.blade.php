<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f6f9fc; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <!-- Main Container -->
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden;">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #4f46e5; padding: 40px 20px;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: 600; letter-spacing: -0.5px;">Welcome Aboard!</h1>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 40px 50px; color: #334155;">
                            <p style="margin: 0 0 20px 0; font-size: 16px; line-height: 24px;">Hello <strong>{{ $data['name'] ?? 'Customer' }}</strong>,</p>
                            <p style="margin: 0 0 30px 0; font-size: 16px; line-height: 24px; color: #64748b;">Your account has been successfully created. You can now log in using the credentials listed below:</p>
                            
                            <!-- Credentials Box -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border-radius: 6px; padding: 20px; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 8px 0; font-size: 14px; color: #64748b;" width="30%"><strong>Email ID:</strong></td>
                                    <td style="padding: 8px 0; font-size: 14px; color: #0f172a; font-weight: 500;">{{ $data['email'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; font-size: 14px; color: #64748b;"><strong>Password:</strong></td>
                                    <td style="padding: 8px 0; font-size: 14px; color: #4f46e5; font-family: monospace; font-weight: bold; font-size: 15px;">{{ $data['password'] ?? '' }}</td>
                                </tr>
                            </table>

                            <!-- Action Button -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/login') }}" target="_blank" style="display: inline-block; background-color: #4f46e5; color: #ffffff; padding: 14px 30px; font-size: 16px; font-weight: 500; text-decoration: none; border-radius: 5px; box-shadow: 0 2px 5px rgba(79, 70, 229, 0.3);">Login to Your Account</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 50px 40px 50px; border-top: 1px solid #f1f5f9; text-align: center;">
                            <p style="margin: 0; font-size: 12px; color: #94a3b8; line-height: 18px;">If you did not create this account, please ignore this email or contact support.</p>
                            <p style="margin: 10px 0 0 0; font-size: 12px; color: #94a3b8;">&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>