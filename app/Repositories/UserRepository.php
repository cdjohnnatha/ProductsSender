<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/10/17
 * Time: 5:52 PM
 */
namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\User;

class UserRepository implements RepositoryInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model::with('subscription')->get();
    }

    public function store($request)
    {
        $user = new User($request->input('user'));
        $address = new Address($request->input('address'));
        $geonames = new AddressGeonameCode($request->input('geonames'));
        $user->password = bcrypt($request->input('users.password'));
        $user->confirmation_code = base64_encode($user->email);
        Mail::to($user->email)->send(new UserRegisterConfirmation($user->confirmation_code));
        if($user->save() &&
            $user->address()->save($address) &&
            $user->wallet()->save(new Wallet()) &&
            $user->address[0]->geonames()->save($geonames)) {
            $user->default_address = $user->address[0]->id;
            if($user->save()) {
                $request->session()->flash('info', __('email_verification.registered_message'));
                Mail::to($user->email)->send(new UserRegisterConfirmation($user->confirmation_code));
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
        User::findOrFail($id)->delete();
    }

    public function findById($attribute)
    {
        return User::find($attribute);
    }

    public function confirmeAccount($confirmation_code)
    {
        if(!$confirmation_code) {
            return false;
        }

        $user = User::where('confirmation_code', $confirmation_code)->first();

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