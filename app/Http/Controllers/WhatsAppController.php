<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function sendMessage(Request $request)
    {
        // dd($request);
        // $request->validate checks if the to and message parameters are present in the request
        $request->validate(['to' => 'required|regex:/^\+\d{1,3}\d{9,15}$/',
            'message' => 'required|max:1600',
        ]);

        // Twilio credentials are fetched from configuration files
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');
        $client = new Client($sid, $token);

        try {
            // A message is created and sent via the Twilio client
            $client->messages->create(
                'whatsapp:' . $request->to,
                [
                    'from' => $from,
                    'body' => $request->message,
                ]
            );

            // Successful response
            return response()->json(['status' => 'Message sent successfully']);
        } catch (\Exception $e) {
            // Logging the error for debugging purposes
            Log::error('Failed to send message: ' . $e->getMessage());

            // Error response
            return response()->json(['status' => 'Failed to send message', 'error' => $e->getMessage()]);
        }
    }
}
