<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'sexe',
        'phone',
        'avatar',
        'annee_debut',
        'adresse',
        'naissance',
        'ville',
        'pays',
        'departement_id',
        'direction_id',
        'user_id',
        'permission_id',

    ];

    public function permission()
    {
        return $this->belongsTo(\Spatie\Permission\Models\Permission::class, 'permission_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
