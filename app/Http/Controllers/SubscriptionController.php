<?php

namespace App\Http\Controllers;

use App\Benefit;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show($id)
    {
        $subscription = Subscription::find($id);
        $subscription->benefits;
        return response()->json([
            'subscription' => $subscription,
        ])->setStatusCode(200);
    }

    public function showList()
    {
        return view('subscription.list');
    }

    public function subscriptions()
    {
        return response()->json([
            'subscriptions' => Subscription::with('benefits')->get(),
        ])->setStatusCode(200);
    }

    public function subscriptionForm($id = 0)
    {

        return view('subscription.form')->with('id', $id);
    }

    public function register(Request $request)
    {
        $subscription = new Subscription();
        $subscription->title = $request->input('title');
        $subscription->amount = $request->input('amount');
        $subscription->created_by = Auth::id();
        $subscription->updated_by = Auth::id();
        $listBenefits = $request->input('benefits');
        if ($subscription->save()) {
            foreach ($listBenefits as $benefit) {
                $benefits = new Benefit();
                $benefits->message = $benefit['message'];
                $benefits->subscription_id = $subscription->id;
                $subscription->benefits()->save($benefits);
            }
            return response('/admin/subscriptions/show-list', 201);
        }
        return response('', 406);
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->title = $request->input('title');
        $subscription->amount = $request->input('amount');
        $subscription->created_by = Auth::id();
        $subscription->updated_by = Auth::id();
        $listBenefits = $request->input('benefits');
        if ($subscription->save()) {
            $benefits = $subscription->benefits;
            foreach ($listBenefits as $key => $value) {
                $benefits[$key]->message = $value['message'];
                $benefits[$key]->save();
            }
            return response('/admin/subscriptions/show-list', 201);
        }
        return response('', 406);
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();
        if( $subscription->trashed())
        {
            return response('/admin/subscriptions/show-list', 200);
        }

        return response('', 406);

    }
}
