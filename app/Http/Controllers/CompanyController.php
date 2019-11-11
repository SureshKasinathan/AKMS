<?php

namespace App\Http\Controllers;

use App\Helpers\Stats;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

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
        Company::create(request()->validate([
            'name' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'cell' => '',
            'address' => '',
            'city' => '',
            'state_code' => '',
            'zip' => '',
            'website' => '',
            'nmlsid' => '',
            'timezone' => '',
        ]));

        return redirect('admin/companies');
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
        $company = Company::findOrFail($id);

        return view('company.edit', compact('company'));
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
        if ($request->has('status')) { //Update the active status
            return $this->updateActiveStatus($request, $id);
        }

        Company::whereId($id)->update(request()->validate([
            'name' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'cell' => '',
            'address' => '',
            'city' => '',
            'state_code' => '',
            'zip' => '',
            'website' => '',
            'nmlsid' => '',
            'timezone' => '',
        ]));

        return redirect('companies/' . $id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Company::destroy($id);

        if ($status == 1) {
            return [
                'status' => 'success',
                'message' => 'Company deleted successfully.',
            ];
        } else {
            return [
                'status' => 'failed',
                'message' => 'Unable to delete the company.',
            ];
        }
    }

    /**
     * Update the specified resource in active status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateActiveStatus($request, $id)
    {
        $status = Company::whereId($id)->update([
            'active' => ($request->status) ? 0 : 1,
            'deactivated_at' => date("Y-m-d H:i:s"),
        ]);

        if ($status == 1 && $request->status == 0) {
            return [
                'status' => 'success',
                'message' => 'Company activated successfully.',
            ];
        } else if ($status == 1 && $request->status == 1) {
            return [
                'status' => 'success',
                'message' => 'Company deactivated successfully.',
            ];
        } else {
            return [
                'status' => 'failed',
                'message' => 'Unable to update company status.',
            ];
        }
    }
}
