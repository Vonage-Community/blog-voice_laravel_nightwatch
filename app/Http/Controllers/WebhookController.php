<?php

namespace App\Http\Controllers;

use App\Models\Webhook;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->all();

        Webhook::create($data);

        return response('Webhook Handled', 200);
    }
}
