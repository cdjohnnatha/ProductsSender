<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/10/17
 * Time: 5:52 PM
 */

namespace App\Repositories;

use App\Address;
use App\Client;
use App\ClientAddressGeoname;
use App\ClientDocuments;
use App\Mail\UserRegisterConfirmation;
use App\Repositories\Interfaces\RepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ClientRepository implements RepositoryInterface
{
    private $model;

    public function __construct(Client $model)
    {
        $this->model = $model;

    }

    public function getAll()
    {
        return $this->model::with('subscription')->get();
    }

    public function store($request)
    {
        $user = $this->model->create($request->input('user'));
        $user->client()->create($request->input('client'));
        $user->client->address()->create($request->input('address'));
//        $user->client->address->geonames()->create($request->input('geonames'));
        $user->password = bcrypt($request->input('users.password'));
        $user->confirmation_code = base64_encode($user->email);

        if($request->hasFile('identification_card')){
            $this->saveImage($request->file('identification_card'), $user);
        }

        if($request->hasFile('usps_form')){
            $this->saveImage($request->file('usps_form'), $user);
        }

        if($request->hasFile('proof_address')){
            $this->saveImage($request->file('proof_address'), $user);
        }
//        Mail::to($user->email)->send(new UserRegisterConfirmation($user->confirmation_code));
        if ($user->save()) {
//            Mail::to($user->email)->send(new UserRegisterConfirmation($user->confirmation_code));
            return true;

        } else {
            return false;

        }
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }



    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
    }

    public function findById($attribute)
    {
        return $this->model::find($attribute);
    }

    public function confirmAccount($confirmation_code)
    {
        if (!$confirmation_code) {
            return false;
        }

        $user = $this->model::where('confirmation_code', $confirmation_code)->first();

        if ($user) {
            if ($user->confirmed) {
                return false;
            }

            $user->confirmed = true;
            $user->save();

            return true;
        }

        return false;
    }

    private function saveImage($file, $user)
    {
        Log::info($user);
        $fileName = $user->client->id . date("dmYhmsu");
        $extension = explode('.', $file->getClientOriginalName())[1];
        $fileName = md5($fileName) . '.' . $extension;
        $path = $file->storeAs('public/UserDocuments', $fileName);
        $path = str_replace('public', 'storage', $path);
        $picture = new ClientDocuments();
        $picture->name = $fileName;
        $picture->path = '/' . $path;

        if ($user->client->documents()->save($picture)) {
            activity()
                ->performedOn($user->client)
                ->causedBy($user)
                ->withProperty('client_id', $user->client->id)
                ->withProperty('file_name', $fileName)
                ->log('The package id is :properties.package_id,
                            the causer name is :causer.name and it was uploaded a file which is :properties.file_name
                            with id:');
        }
    }

}