<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/16/17
 * Time: 3:10 PM
 */

namespace App\Repositories;


use App\Repositories\Interfaces\RepositoryInterface;
use App\Subscription;

class SubscriptionRepository implements RepositoryInterface
{

    public function getAll()
    {
        return Subscription::all();
    }

    public function getWithBenefits($id)
    {
        return Subscription::with('benefits')->find($id);
    }

    public function getAllWithBenefits()
    {
        return Subscription::with('benefits')->get();
    }

    public function store($request)
    {
        $subscription = Subscription::create($request->input('data'));
        $subscription->benefits()->createMany($request->input('benefits'));
        if($request->has('additional_service')) {
            $subscription->addons()->createMany($request->input('additional_service'));
        }
    }

    public function update($id, $request)
    {
        $subscription = Subscription::with('benefits')->find($id);
        $subscription->update($request->input('data'));

        foreach ($request->input('benefits') as $message){
            $subscription->benefits()->updateOrCreate(
                ['id' => (int)$message['id']],
                ['message' => $message['message'],
                    'active' => array_key_exists('active',$message)]);
        }
    }


    public function findById($attribute)
    {
        return Subscription::find($attribute);
    }

    public function destroy($id)
    {
        Subscription::findOrFail($id)->delete();
    }

    public function setActive($id, $request)
    {
        $subscription = Subscription::find($id);
        $subscription->active = $request->exists('active');
        $subscription->save();
    }

    public function setPrincipalOffer($id, $request)
    {
        $subscription = Subscription::find($id);
        $subscription->principal = $request->exists('principal');
        $subscription->save();
    }

    public function getPerTimeWithBenefits($orderBy, $period, $active, $limit)
    {
        return Subscription::with('benefits')
            ->where('period', $period)
            ->where('active', $active)
            ->orderBy($orderBy)
            ->limit($limit)
            ->get();
    }

    public function countPerTime($period, $active)
    {
        return Subscription::where('active',  $active)
            ->where('period', $period)
            ->count();
    }

    public function getAllActive()
    {
        return Subscription::where('active',  true)->get();
    }
}