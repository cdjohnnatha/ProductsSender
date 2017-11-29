<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CompanyAddonsRepository;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyAddonsController extends Controller
{
    private $companyRepository;
    private $companyAddonsRepository;

    public function __construct(CompanyRepository $companyRepository, CompanyAddonsRepository $companyAddonsRepository)
    {
        $this->companyRepository = $companyRepository;
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
    public function create()
    {
        $companies = $this->companyRepository->getAll();
        return view('company.addons.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->companyAddonsRepository->store($request);
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
        $addon = $this->companyAddonsRepository->findById($id);
        $companies = $this->companyRepository->getAll();
        return view('company.addons.create', compact('addon', 'companies'));
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
        if($this->companyAddonsRepository->update($id, $request)){
            return redirect(route('admin.company-addons.index'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->companyAddonsRepository->destroy($id)){
            return redirect(route('admin.company-addons.index'));
        }
    }
}
