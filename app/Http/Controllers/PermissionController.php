<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        Carbon::setLocale("fr");
        $title = "Permissions";
        $permissions = Permission::paginate(10);
        return view('permissions.index', compact(
            'title', 'permissions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
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
     * Update the specified resource in storage.
     *
     * @param Request $request
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
     * @param Request $request
     * @return RedirectResponse
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
