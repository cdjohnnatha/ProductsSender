<?php

namespace App\Http\Controllers;

use App\Benefit;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    public function rules()
    {
        return [
            'subscription.title' => 'required',
            'subscription.amount' => 'required|numeric',
            'benefits.*.message' => 'required'
        ];
    }

    public function index()
    {
        $subscriptions = Subscription::with('benefits')->get();
        return view('subscription.index', compact('subscriptions'));
    }

    public function create()
    {
        return view('subscription.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $subscription = new Subscription($request->input('subscription'));
        if ($subscription->save()) {
            $subscription->benefits()->createMany(
                $request->input('benefits')
            );

            return redirect(route('admin.subscriptions.index'));
        }
    }

    public function show($id)
    {
        $subscription = Subscription::with('benefits')->find($id);
        return view('subscription.show', compact('subscription'));
    }

    public function edit($id)
    {
        $subscription = Subscription::with('benefits')->findOrFail($id);
        return view('subscription.create', compact('subscription'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $subscription = Subscription::findOrFail($id);
        $subscription->title = $request->input('subscription.title');
        $subscription->amount = $request->input('subscription.amount');
        $subscription->load('benefits');
        if ($subscription->save()) {
            $benefits = $subscription->benefits()->get()->toArray();
            if(count($request->input('benefits')) < count($benefits)){
                dd(array_diff($request->input('benefits'), $benefits));
            }
            foreach ($request->input('benefits') as $message){
                $subscription->benefits()->updateOrCreate(
                ['id' => $message['id']],
                ['message' => $message['message']]);
            }
            return redirect(route('admin.subscriptions.index'));
        }
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();
        if( $subscription->trashed()) {
            return redirect(route('admin.subscriptions.index'));
        }


    }
}
