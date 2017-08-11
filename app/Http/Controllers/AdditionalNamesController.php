<?php

namespace App\Http\Controllers;

use App\AdditionalNames;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;

class AdditionalNamesController extends Controller
{

    private function rules()
    {
        return [
            'additional.*.id' => 'required|integer'
        ];
    }

    public function index($id)
    {
        $names = AdditionalNames::where('user_id', $id)->get();
        return view('user.additionalNames.index', compact('names'));
    }


    public function store(Request $request, $id)
    {
        $this->validate($request, $this->rules());
        $user = User::with('additionalNames')->findOrFail($id);
        foreach ($request->input('additional') as $name) {
            if(!is_null($name['name'])) {
                $user->additionalNames()->updateOrCreate(
                    ['id' => $name['id']],
                    ['name' => $name['name']]
                );
            }
        }
        return redirect(route('user.additional-names.index', $id));

    }

    public function destroy($id, $name_id)
    {
        $name = AdditionalNames::findOrFail($name_id);
        $name->delete();
        if($name->trashed())
            return back();
    }
}
