<?php

namespace App\Http\Controllers;

use App\Benefit;
use App\Addon;
use App\Repositories\SubscriptionRepository;
use App\Service;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    private $subscription;

    public function __construct(SubscriptionRepository $subscription)
    {
        $this->subscription = $subscription;
    }

    public function rules()
    {
        return [
            'data.title' => 'required|string',
            'data.discounts' => 'required|string',
            'data.slots' => 'required|string',
            'benefits' => 'required|array|size:6'
        ];
    }

    public function index()
    {
        $subscriptions = $this->subscription->getAllWithBenefits();

        $allow_activation_month = $this->subscription->countPerTime(1, true);
        $allow_activation_year = $this->subscription->countPerTime(12, true);

        return view('subscription.index',
            compact(
                'subscriptions',
                'allow_activation_month',
                'allow_activation_year'));
    }

    public function create()
    {
        $services = Service::all();
        return view('subscription.create')->with('services', $services);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $this->subscription->store($request);

        $request->session()->flash('status', __('statusMessage.global_message.entity.created', ['entity' => 'Plan']));

        return redirect(route('admin.subscriptions.index'));
    }

    public function show($id)
    {
        return view('subscription.show')->with('subscription', $this->subscription->getAllWithBenefits($id));
    }

    public function edit($id)
    {
        $subscription = $this->subscription->getWithBenefits($id);
        $services = Service::all();

        return view('subscription.create', compact('subscription', 'services'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $this->subscription->update($id, $request);

        $request->session()->flash('success', __('statusMessage.global_message.entity.updated', ['entity' => 'Plan']));

        return redirect(route('admin.subscriptions.index'));

    }

    public function destroy($id)
    {
        $this->subscription->destroy($id);
        return redirect(route('admin.subscriptions.index'));
    }

    public function active(Request $request, $id)
    {
        $this->subscription->setActive($id, $request);

        $request->session()->flash('success', __('statusMessage.global_message.entity.updated', ['entity' => 'Plan']));
        return redirect(route('admin.subscriptions.index'));
    }


    public function principalOffer(Request $request, $id)
    {
        $this->subscription->setPrincipalOffer($id, $request);

        $request->session()->flash('info', __('statusMessage.global_message.entity.updated', ['entity' => 'Plan']));
        return redirect(route('admin.subscriptions.index'));

    }
}
