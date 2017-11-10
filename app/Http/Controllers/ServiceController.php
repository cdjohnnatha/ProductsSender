<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private function rules()
    {
        return [
            'service.title' => 'required|string',
            'service.price' => 'required|numeric',
            'service.description' => 'required',
        ];
    }

    public function index(){
        $services = Service::all();
        return view('service.index', compact('services'));
    }

    public function create(){
        return view('service.create');
    }

    public function store(Request $request){
        $this->validate( $request, $this->rules());

        $service = new Service($request->input('service'));
        $service->save();

        $request->session()->flash('success', __('statusMessage.global_message.entity.created', ['entity' => __('common.titles.services')]));
        return redirect(Route('admin.services.index'));
    }

    public function show($id){
    }

    public function edit($id){
        $service = Service::findOrFail($id);

        return view('service.create', compact('service'));
    }

    public function update(Request $request, $id){
        $this->validate( $request, $this->rules() );

        $service = Service::findOrFail($id);
        $service->fill($request->input('service'));

        $service->save();

        $request->session()->flash('success',
                __('statusMessage.global_message.attribute.updated', [
                'entity' => __('common.titles.service'),
                'attribute' => $service->id]));

        return redirect(Route('admin.services.index'));
    }

    public function destroy(Request $request, $id){
        $service = Service::findOrFail($id)->delete();

        $service->delete();

        $request->session()->flash('success',
            __('statusMessage.global_message.attribute.deleted', [
            'entity' => __('common.titles.offered_services'),
            'attribute' => $id
            ]));
        return redirect(route('admin.offeredservices.index'));

    }
}
