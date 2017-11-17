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
    private $model;

    public function __construct(Subscription $subscription)
    {
        $this->model = $subscription;
    }

    public function getAll()
    {
        return $this->model::all();
    }

    public function getWithBenefits($id)
    {
        return $this->model::with('benefits')->find($id);
    }

    public function getAllWithBenefits()
    {
        return $this->model::with('benefits')->get();
    }

    public function store($request)
    {
        $subscription = $this->model::create($request->input('data'));
        $subscription->benefits()->createMany($request->input('benefits'));
        if($request->has('additional_service')) {
            $subscription->addons()->createMany($request->input('additional_service'));
        }
    }

    public function update($id, $request)
    {
        $subscription = $this->model::with('benefits')->find($id);
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
        return $this->model::find($attribute);
    }

    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
    }

    public function setActive($id, $request)
    {
        $subscription = $this->model::find($id);
        $subscription->active = $request->exists('active');
        $subscription->save();
    }

    public function setPrincipalOffer($id, $request)
    {
        $subscription = $this->model::find($id);
        $subscription->principal = $request->exists('principal');
        $subscription->save();
    }

    public function getPerTimeWithBenefits($orderBy, $period, $active, $limit)
    {
        return $this->model::with('benefits')
            ->where('period', $period)
            ->where('active', $active)
            ->orderBy($orderBy)
            ->limit($limit)
            ->get();
    }

    public function countPerTime($period, $active)
    {
        return $this->model::where('active',  $active)
            ->where('period', $period)
            ->count();
    }

    public function getAllActive()
    {
        return $this->model::where('active',  true)->get();
    }
}