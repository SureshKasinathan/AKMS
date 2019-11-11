<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('users.active', 1)
            ->leftjoin('roles', 'users.id', '=', 'roles.id')
            ->select('users.*', 'roles.name AS role')
            ->where('users.company_id', Auth::user()->company_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('active', 1)
            ->where('company_id', Auth::user()->company_id)
            ->orderBy('name')
            ->get()
            ->keyBy('id');

        return view('user.create', compact('roles'));
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
            'role_id' => 'required',
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

        if ($request->password != '')
            $post_value['password'] = 'required|min:8|confirmed';

        $data = request()->validate($post_value);

        if ($request->password != '')
            $data['password'] = Hash::make($data['password']);

        $data['admin'] = (isset($request->admin)) ? 1 : 0;

        $data['company_id'] = Auth::user()->company_id;

        User::create($data);

        return redirect('users');
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
        $user = User::where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        $roles = Role::where('active', 1)
            ->where('company_id', Auth::user()->company_id)
            ->orderBy('name')
            ->get();

        return view('user.edit', compact('user', 'roles'));
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

        $post_value = [
            'role_id' => 'required',
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

        if ($request->password != '')
            $data['password'] = 'required|min:8|confirmed';

        $data = request()->validate($post_value);

        if ($request->password != '')
            $data['password'] = Hash::make($data['password']);

        $data['admin'] = (isset($request->admin)) ? 1 : 0;

        User::whereId($id)->update($data);

        return redirect('users/' . $id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = User::destroy($id);

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
        $status = User::whereId($id)->update([
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
