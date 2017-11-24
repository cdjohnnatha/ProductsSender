<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompaniesController extends Controller
{
    private $company_repository;

    public function __construct(CompanyRepository $company_repository)
    {
        $this->company_repository = $company_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->company_repository->getAll();
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->company_repository->store($request);
        $request->session()->flash('success', 'Company was successfully registered!');

        return redirect(route('admin.companies.index'));
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
        $company = $this->company_repository->findById($id);
        return view('company.create')->with('company', $company);
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
        $this->company_repository->update($id, $request);

        $request->session()->flash('success', 'Company was successfully updated!');
        return redirect(route('admin.companies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if($this->company_repository->destroy($id)) {
            $request->session()->flash('success', 'Company was successfully deleted!');
            return redirect(route('admin.companies.index'));
        } else {
            $request->session()->flash('error', 'Problem when was deleting! Please try again');
            return redirect(route('admin.companies.index'));
        }


    }
}
