<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Confirmed</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <div style="background-color: #B80000; padding: 30px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 28px;">Lusweti Online Center</h1>
        </div>
        
        <div style="padding: 40px 30px;">
            <h2 style="color: #B80000; margin-top: 0;">Welcome to Our Newsletter!</h2>
            
            <p>Dear {{ $subscriber->name }},</p>
            
            <p>Thank you for subscribing to the Lusweti Online Center newsletter. We're excited to keep you updated with the latest news, sports updates, and exclusive content.</p>
            
            <div style="background-color: #f9f9f9; padding: 20px; border-left: 4px solid #B80000; margin: 20px 0;">
                <p style="margin: 0;"><strong>Your subscription details:</strong></p>
                <p style="margin: 5px 0 0 0;">Email: {{ $subscriber->email }}</p>
                <p style="margin: 5px 0 0 0;">Phone: {{ $subscriber->phone_number }}</p>
            </div>
            
            <p>You'll receive our latest updates directly in your inbox. If you ever wish to unsubscribe, you can do so by clicking the unsubscribe link in any of our emails.</p>
            
            <p style="margin-top: 30px;">Best regards,<br>The Lusweti Online Center Team</p>
        </div>
        
        <div style="background-color: #333; padding: 20px; text-align: center;">
            <p style="color: #ffffff; margin: 0; font-size: 12px;">&copy; {{ date('Y') }} Lusweti Online Center. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
