<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;
use Stripe\{Stripe, Charge, Customer};

class SubscriptionsController extends Controller
{
    public function store()
    {
        $plan = Plan::findOrFail(request('plan'));

        try{
            $customer = Customer::create([
                'email' => request('stripeEmail'),
                'source' => request('stripeToken'),
                'plan' => $plan->name
            ]);
        } catch (\Exception $e) {
            return responce()->json(['status' => $e->getmessage(), 422]);
        }

        return 'All Done';
    }
}
