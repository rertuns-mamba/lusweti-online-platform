<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Subscriber Notification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <div style="background-color: #B80000; padding: 30px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 28px;">Lusweti Online Center</h1>
        </div>
        
        <div style="padding: 40px 30px;">
            <h2 style="color: #B80000; margin-top: 0;">New Subscriber Alert!</h2>
            
            <p>A new user has subscribed to the Lusweti Online Center newsletter.</p>
            
            <div style="background-color: #f9f9f9; padding: 20px; border-left: 4px solid #B80000; margin: 20px 0;">
                <p style="margin: 0;"><strong>Subscriber Details:</strong></p>
                <p style="margin: 5px 0 0 0;"><strong>Name:</strong> <?php echo e($subscriber->name); ?></p>
                <p style="margin: 5px 0 0 0;"><strong>Email:</strong> <?php echo e($subscriber->email); ?></p>
                <p style="margin: 5px 0 0 0;"><strong>Phone:</strong> <?php echo e($subscriber->phone_number); ?></p>
                <p style="margin: 5px 0 0 0;"><strong>Subscribed At:</strong> <?php echo e($subscriber->subscribed_at ? $subscriber->subscribed_at->format('F j, Y, g:i a') : 'N/A'); ?></p>
            </div>
            
            <p>You can view and manage all subscribers in the Filament admin panel.</p>
            
            <p style="margin-top: 30px;">Best regards,<br>Lusweti Online Center System</p>
        </div>
        
        <div style="background-color: #333; padding: 20px; text-align: center;">
            <p style="color: #ffffff; margin: 0; font-size: 12px;">&copy; <?php echo e(date('Y')); ?> Lusweti Online Center. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\emails\new-subscriber-notification.blade.php ENDPATH**/ ?>