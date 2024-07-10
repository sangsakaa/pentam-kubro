<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WhatsAppController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'to' => 'required',
            'message' => 'required',
        ]);

        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');
        $client = new Client($sid, $token);

        try {
            $client->messages->create(
                'whatsapp:' . $request->to,
                [
                    'from' => $from,
                    'body' => $request->message,
                ]
            );

            return response()->json(['status' => 'Message sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Failed to send message', 'error' => $e->getMessage()]);
        }
    }
}
