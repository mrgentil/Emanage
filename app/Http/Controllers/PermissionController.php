<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $title = "Permissions";
        $permissions = Permission::get();
        return view('permissions.index', compact(
            'title', 'permissions'
        ));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'permission' => 'required|max:200',
        ]);
        foreach (explode(',', $request->permission) as $perm) {
            $permission = Permission::create(['name' => $perm]);
            $permission->assignRole('Super Admin');
        }
        $notification = array(
            'message' => "La permission a été créée avec succès!!",
            'alert-type' => "success"
        );
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $permission = Permission::find($request->id);
        $permission->delete();
        $notification = array(
            'message' => "La permission a été supprimée",
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }
}
