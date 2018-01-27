<?php

namespace App\Http\Controllers\Web\Client;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function show($id)
    {
        $data['client'] = $this->clientRepository->findById($id);
        return view('user.client.show', compact('data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'surname' => 'required',
            'identity_document' => 'required',
            'tax_document' => 'required'
        ]);

        if($this->clientRepository->update($id, $request->input())){
            $request->session()->flash('success', 'Updated Successfully!');
            return redirect()->back();
        }

    }
}
