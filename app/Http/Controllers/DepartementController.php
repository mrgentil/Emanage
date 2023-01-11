<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class DepartementController extends Controller
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
        $title = "Département";
        $departements = Departement::latest()->paginate(10);
        return view('departements.index', compact(
            'title', 'departements'
        ));
    }

    public function create()
    {

        $title = "Département Création";
        return view('departements.create', compact(
            'title'
        ));
    }

    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        $departement = Departement::create($data);
        Alert::success('Département', 'Ajouté avec succès');

        return redirect()->route('departements.index');
    }


    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }


    public function update(Request $request, Departement $departement)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $departement->fill($request->post())->save();
        Alert::success('Département', 'Modifié avec succès');
        return redirect()->route('departements.index');
    }


    public function destroy(Departement $departement)
    {
        $departement->delete();
        Alert::warning('Département', 'Suprimer avec succès');
        return back();
    }

}
