<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $title = "Roles Utilisateur";
        $roles = Role::with('permissions')->paginate(5);
        $permissions = Permission::get();
        return view('roles.index',compact(
            'title','roles','permissions'
        ));
    }

    public function create(): Factory|View|Application
    {

        $title = "Role";
        $permissions = Permission::get();
        return view('roles.create', compact(
            'title','permissions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request,[
            'role'=>'required|max:100',
            'permission'=>'required'
        ]);
        $role = Role::create(['name' => $request->role]);
        $permissions = $request->permission;
        $role->syncPermissions($permissions);
        dd($role);
        Alert::success('ROle', 'Ajouté avec succès');
        return back();
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
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
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
     * @param Request $request
     * @return RedirectResponse
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
