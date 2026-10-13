<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Usser;

class Role extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre_rol',
        'descripcion'
    ];

    protected $allowIncluded = ['ussers'];

    // Rol tiene muchos usuarios
    public function ussers()
    {
        return $this->hasMany(Usser::class, 'role_id');
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
