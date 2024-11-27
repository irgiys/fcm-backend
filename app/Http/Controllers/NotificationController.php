<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
// use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $messaging;

    public function __construct()
    {
        // Initialize Firebase Messaging service
        $credentials = base_path(env('FIREBASE_CREDENTIALS'));
        // $credentials = "afafafa";
        $this->messaging = (new Factory)
            ->withServiceAccount($credentials) // Path to the Firebase Admin SDK key
            ->createMessaging(); // Create the messaging service
    }

    public function sendNotification(Request $request)
    {
        // Define the message
        // echo $request;
        $message = CloudMessage::new()
        // await subscribeTopic("all-complaints");
        ->toTopic('all-complaints') // Target the topic using toTopic method
        ->withNotification(Notification::create(
            'Hello world', // Notification title
            'A complaint has been updated!' // Notification body
        ));
        try {
            $this->messaging->send($message);
            return response()->json(['success' => 'Notification sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
