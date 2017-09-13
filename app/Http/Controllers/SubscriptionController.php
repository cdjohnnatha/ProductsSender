<?php

namespace App\Http\Controllers;

use App\Benefit;
use App\Addon;
use App\Service;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    public function rules()
    {
        return [
            'subscription.title' => 'required|string',
            'subscription.discounts' => 'required|string',
            'subscription.slots' => 'required|string',
            'benefits' => 'required|array|size:6'
        ];
    }

    public function index()
    {
        $subscriptions = Subscription::with('benefits')->get();

        $allow_activation_month = Subscription::where('active',  1)
                                                ->where('period', 0)
                                                ->count();

        $allow_activation_year = Subscription::where('active',  1)
            ->where('period', 1)
            ->count();

        return view('subscription.index',
            compact(
                'subscriptions',
                     'allow_activation_month',
                        'allow_activation_year'));
    }

    public function create()
    {
        $services = Service::all();
        return view('subscription.create', compact('services'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $subscription = new Subscription($request->input('subscription'));
        if ($subscription->save()) {
            $subscription->benefits()->createMany($request->input('benefits'));
            $subscription->addons()->createMany($request->input('additional_service'));

            $request->session()->flash('status',
                __('statusMessage.global_message.entity.created',
                    ['entity' => 'Plan']));

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
        $services = Service::all();
        return view('subscription.create', compact('subscription', 'services'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $subscription = Subscription::with('benefits')->findOrFail($id);
        $subscription->fill($request->input('subscription'));
        if ($subscription->save()) {
            foreach ($request->input('benefits') as $message){
                    $subscription->benefits()->updateOrCreate(
                        ['id' => (int)$message['id']],
                        ['message' => $message['message'],
                         'active' => array_key_exists('active',$message)]);
            }

            $request->session()->flash('status',
                __('statusMessage.global_message.attribute.updated',
                    ['attribute' => $subscription->id, 'entity' => 'Plan']));

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

    public function active(Request $request, $id)
    {
        $subscription = Subscription::find($id);
        $subscription->active = $request->exists('active');
        if( $subscription->save()) {
            $request->session()->flash('status',
                __('statusMessage.global_message.subscription.active',
                ['attribute' => $subscription->id]));

            return redirect(route('admin.subscriptions.index'));
        }
    }

    public function principalOffer(Request $request, $id)
    {
        $subscription = Subscription::find($id);
        $subscription->principal = $request->exists('principal');
        if( $subscription->save()) {
            $request->session()->flash('status',
                __('statusMessage.global_message.subscription.principal_offer',
                    ['attribute' => $subscription->id]));
            return redirect(route('admin.subscriptions.index'));
        }
    }
}
