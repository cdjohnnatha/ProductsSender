<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CompanyAddonsRepository;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyAddonsController extends Controller
{
    private $companyAddonsRepository;

    public function __construct(CompanyAddonsRepository $companyAddonsRepository)
    {
        $this->companyAddonsRepository = $companyAddonsRepository;
    }

    public function index()
    {
        $addons = $this->companyAddonsRepository->getAll();
        return view('company.addons.index', compact('addons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($companyId)
    {
        return view('company.addons.create')->with('companyId', $companyId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $companyId)
    {
        if($this->companyAddonsRepository->store($request)){
            return redirect(route('admin.companies.show', $companyId));
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
    public function edit($companyId, $id)
    {
        $addon = $this->companyAddonsRepository->findById($id);
        return view('company.addons.create', compact('addon', 'companyId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companyId, $id)
    {
        if($this->companyAddonsRepository->update($id, $request)){
            return redirect(route('admin.companies.show', $companyId));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($companyId, $id)
    {
        if($this->companyAddonsRepository->destroy($id)){
            return redirect(route('admin.companies.show', $companyId));
        }
    }
}
