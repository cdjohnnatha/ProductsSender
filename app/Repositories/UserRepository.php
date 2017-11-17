<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/10/17
 * Time: 5:52 PM
 */
namespace App\Repositories;

use App\Address;
use App\AddressGeonameCode;
use App\Mail\UserRegisterConfirmation;
use App\Repositories\Interfaces\RepositoryInterface;
use App\User;
use App\Wallet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserRepository implements RepositoryInterface
{
    private $model;
    private $address_model;
    private $geoname_model;

    public function __construct(User $model, Address $address, AddressGeonameCode $geoname)
    {
        $this->model = $model;
        $this->address_model = $address;
        $this->geoname_model = $geoname;
    }

    public function getAll()
    {
        return $this->model::with('subscription')->get();
    }

    public function store($request)
    {
        $user = new $this->model($request->input('user'));
        $address = new $this->address_model($request->input('address'));
        $geonames = new $this->geoname_model($request->input('geonames'));
        $user->password = bcrypt($request->input('users.password'));
        $user->confirmation_code = base64_encode($user->email);
//        Mail::to($user->email)->send(new UserRegisterConfirmation($user->confirmation_code));
        Log::info($user);
        if($user->save() &&
            $user->address()->save($address) &&
            $user->wallet()->save(new Wallet()) &&
            $user->address[0]->geonames()->save($geonames)) {
            $user->default_address = $user->address[0]->id;
            if($user->save()) {
//                Mail::to($user->email)->send(new UserRegisterConfirmation($user->confirmation_code));
                return true;
            }
        } else {
            return false;
        }
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }


    public function find($column, $attribute)
    {
        // TODO: Implement find() method.
    }

    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
    }

    public function findById($attribute)
    {
        return $this->model::find($attribute);
    }

    public function confirmeAccount($confirmation_code)
    {
        if(!$confirmation_code) {
            return false;
        }

        $user = $this->model::where('confirmation_code', $confirmation_code)->first();

        if($user) {
            if($user->confirmed){
                return false;
            }

            $user->confirmed = true;
            $user->save();

            return true;
        }

        return false;

    }
}