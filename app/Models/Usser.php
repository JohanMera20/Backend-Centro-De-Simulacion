<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Reporte;

class Usser extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'nombre',
        'apellido',
        'documento',
        'correo',
        'telefono',
        'usuario',
        'password',
        'estado',
        'role_id',

        'especialidad',
        'profesion',
        'experiencia',

        'ficha',
        'programa',
        'trimestre'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected $allowIncluded = ['role','reportes'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Usuario tiene muchos reportes
    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'usser_id');
    }

     public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }
        $relations = explode(',', request('included'));

        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }
}
