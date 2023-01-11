<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DirectionController extends Controller
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

    public function index()
    {
        Carbon::setLocale("fr");
        $title = "Direction Liste";
        $directions = Direction::latest()->paginate(10);
        return view('directions.index', compact(
            'title', 'directions'
        ));
    }

    public function create()
    {
        $title = "Direction Création";
        return view('directions.create', compact(
            'title'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        $direction = Direction::create($data);
        Alert::success('Direction', 'Ajoutée avec succès');

        return redirect()->route('directions.index');
    }

    public function edit(Direction $direction)
    {
        return view('directions.edit', compact('direction'));
    }


    public function update(Request $request, Direction $direction)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $direction->fill($request->post())->save();
        Alert::success('Direction', 'Modifiée avec succès');
        return redirect()->route('directions.index');
    }


    public function destroy(Direction $direction)
    {
        $direction->delete();
        Alert::warning('Direction', 'Suprimer avec succès');
        return back();
    }
}
