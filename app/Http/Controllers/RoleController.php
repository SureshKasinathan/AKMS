<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('active', 1)
            ->where('company_id', Auth::user()->company_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => '',
        ]);
        $data['company_id'] = Auth::user()->company_id;

        $role = Role::create($data);

        $this->rolePermissions($request, $role->id);

        return redirect('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $permissions = Permission::all();

        $role_permission = DB::table('user_role_permissions')
            ->select(DB::raw('*'))
            ->where('role_id', '=', $id)
            ->get();

        $capabilities = [];
        for($c=0; $c<count($role_permission); $c++) {
            $capabilities[$role_permission[$c]->permission_id] = $role_permission[$c];
        }

        return view('role.edit', compact('role', 'companies', 'permissions', 'capabilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Role::whereId($id)->update(request()->validate([
            'name' => 'required',
            'description' => '',
        ]));

        $this->rolePermissions($request, $id);

        return redirect('roles/' . $id . "/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('user_role_permissions')->where('role_id', '=', $id)->delete(); // Role permissions

        $status = Role::destroy($id);

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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\P  $role
     * @return \Illuminate\Http\Response
     */
    public function rolePermissions($request, $role_id)
    {
        DB::table('user_role_permissions')->whereIn('role_id', [$role_id])->delete();

        $data = [];
        if ($request->has('permissions')) {

            foreach ($request->permissions as $permission => $capabilities) {
                $data[] = [
                    'create' => (isset($capabilities['create'])) ? 1 : 0,
                    'delete' => (isset($capabilities['delete'])) ? 1 : 0,
                    'edit' => (isset($capabilities['edit'])) ? 1 : 0,
                    'permission_id' => $permission,
                    'role_id' => $role_id,
                    'view_global' => (isset($capabilities['view_global'])) ? 1 : 0,
                    'view_own' => (isset($capabilities['view_own'])) ? 1 : 0,
                ];
            }
        }
        DB::table('user_role_permissions')->insert($data);
    }
}
