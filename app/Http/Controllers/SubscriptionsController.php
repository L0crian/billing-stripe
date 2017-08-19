<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use App\Plan;
use Illuminate\Http\Request;
use Mockery\Exception;
use Stripe\{
    Stripe, Charge, Customer
};

class SubscriptionsController extends Controller
{
    public function store(RegistrationForm $form)
    {
        try {
            $form->save();
        } catch (Exception $e) {
            return response()->json(['status' => $e->getmessage(), 422]);
        }

        return [
            'status' => 'Success!'
        ];
    }
}
