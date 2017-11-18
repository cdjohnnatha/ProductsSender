<?php

namespace App\Http\Controllers;

use App\ClientExtraNames;
use App\User;
use Illuminate\Http\Request;

//TODO: essa classe se refere a quem (qual o contexto => USER)?

class AdditionalNamesController extends Controller
{
    protected $additionalNames;

    public function __construct(ClientExtraNames $additionalNames){
        $this->additionalNames = $additionalNames;
    }

    public function index($id){
        $names = $this->additionalNames->where('user_id', $id)->get();
        return view('user.additionalNames.index', compact('names'));
    }

    public function store(Request $request, $id){
        $this->validate($request, [
            'additional.*.id' => 'required|integer'
        ]);

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

    public function destroy($id, $name_id){
        $this->additionalNames->findOrFail($name_id)->delete();

        return back();
    }
}
