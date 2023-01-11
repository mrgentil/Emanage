<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
    public function index(): View|Factory|Application
    {
        Carbon::setLocale("fr");
        $title = "Permissions";
        $permissions = Permission::latest()->paginate(10);
        return view('permissions.index', compact(
            'title', 'permissions'
        ));
    }

    public function create(): Factory|View|Application
    {

        $title = "Permissions";
        return view('permissions.create', compact(
            'title'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        //
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        $permission = Permission::create($data);
        Alert::success('Permission', 'Ajoutée avec succès');

        return redirect()->route('permission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return Application|Factory|View
     */
    public function show(Permission $permission): View|Factory|Application
    {
        return view('permissions.show',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Permission $permission
     * @return Application|Factory|View
     */
    public function edit(Permission $permission): View|Factory|Application
    {
        return view('permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
        ]);
        $permission->fill($request->post())->save();
        Alert::success('Permission', 'Modifiée avec succès');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        Alert::warning('Permission', 'Suprimer avec succès');
        return back();
    }
}
