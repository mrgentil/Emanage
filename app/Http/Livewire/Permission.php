<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Permission extends Component
{
    public $name;


    public function submit(): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $this->validate([
            'name' => 'required|min:6',
        ]);

        \Spatie\Permission\Models\Permission::create($validatedData);

        return redirect()->to('/form');
    }
    public function render()
    {
        return view('livewire.permission');
    }
}
