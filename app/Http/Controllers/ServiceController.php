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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, $this->rules());
        $service = new Service($request->input('service'));
        if($service->save()){
            $request->session()->flash('status',
                __('statusMessage.global_message.entity.created', [
                    'entity' => __('common.titles.services')]));
            return redirect(Route('admin.services.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('service.create', compact('service'));
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
        $this->validate( $request, $this->rules() );
        $service = Service::findOrFail($id);
        $service->fill($request->input('service'));
        if($service->save()){
            $request->session()->flash('status',
                __('statusMessage.global_message.attribute.updated', [
                    'entity' => __('common.titles.service'),
                    'attribute' => $service->id]));
            return redirect(Route('admin.service.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        if($service->trashed()){
            $request->session()->flash('status',
                __('statusMessage.global_message.attribute.deleted', [
                    'entity' => __('common.titles.offered_services'),
                    'attribute' => $id
                ]));
            return redirect(route('admin.offeredservices.index'));
        }
    }
}
