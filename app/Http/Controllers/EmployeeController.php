<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class EmployeeController extends Controller
{
    public function index()
    {
        $title = "Employées";
        $employes  = Employee::with('permission')->paginate(10);
        return view('personnels.index',compact(
            'title','employes'
        ));
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('personnels.create',compact('permissions'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|max:100',
            'email'=>'required|email',
            'role'=>'required',
            'password'=>'required|confirmed|max:200',
            'avatar'=>'file|image|mimes:jpg,jpeg,gif,png',
        ]);
        $imageName = null;
        if($request->hasFile('avatar')){
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $imageName);
        }
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'avatar'=>$imageName
        ]);
        $user->assignRole($request->role);
        $notification =array(
            'message'=>"User has been added!!!",
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

}
