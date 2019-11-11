<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::where('active', 1)
            ->where('company_id', Auth::user()->company_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_value = [
            'email' => 'required',
            'username' => 'required|unique:clients',
            'firstname' => 'required',
            'lastname' => '',
            'password' => 'required|min:8|confirmed',
            'cell' => '',
            'phonenumber' => '',
            'address' => '',
            'city' => '',
            'state_code' => '',
            'zip' => '',
            'email_signature' => '',
        ];

        $data = request()->validate($post_value);

        $data['company_id'] = Auth::user()->company_id;

        Client::create($data);

        return redirect('clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('status')) { //Update the active status
            return $this->updateActiveStatus($request, $id);
        }

        $post_value = [
            'email' => 'required',
            'username' => 'required',
            'firstname' => 'required',
            'lastname' => '',
            'cell' => '',
            'phonenumber' => '',
            'address' => '',
            'city' => '',
            'state_code' => '',
            'zip' => '',
            'email_signature' => '',
        ];
        if ($request->password != '') $data['password'] = 'required|min:8|confirmed';

        $data = request()->validate($post_value);

        Client::whereId($id)->update($data);

        return redirect('clients/' . $id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Client::destroy($id);

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
        $status = Client::whereId($id)->update([
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
