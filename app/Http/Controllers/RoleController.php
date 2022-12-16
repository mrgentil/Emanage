<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $title = "Roles Utilisateur";
        $roles = Role::with('permissions')->get();
        $permissions = Permission::get();
        return view('roles.index',compact(
            'title','roles','permissions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'role'=>'required|max:100',
            'permission'=>'required'
        ]);
        $role = Role::create(['name' => $request->role]);
        $permissions = $request->permission;
        $role->syncPermissions($permissions);
        $notification = array(
            'message'=>"Rôle créé avec succès!!",
            'alert-type'=>"success"
        );
        return back()->with($notification);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'role'=>'required|max:100',
            'permission'=>'required'
        ]);
        $role = Role::find($request->id);
        $role->update([
            'name'=>$request->role,
        ]);
        $permissions = $request->permission;
        $role->syncPermissions($permissions);
        $notification = array(
            'message'=>"Mise à jour du rôle avec succès!!",
            'alert-type'=>"success"
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $role = Role::find($request->id);
        $role->delete();
        $notification = array(
            'message'=>"Le rôle a été supprimé avec succès!!.",
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
}
