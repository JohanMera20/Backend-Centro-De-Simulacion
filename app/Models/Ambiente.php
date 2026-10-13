<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Simulacion;
use App\Models\Equipo;
use App\Models\Insumo;


class Ambiente extends Model
{

    use HasFactory;

    
    protected $fillable = [
        'nombre',
        'ubicacion'
    ];

    protected $allowIncluded = ['simulacion', 'equipos','insumos'];



    public function simulacion()
    {
        return $this->hasMany(Simulacion::class,'ambiente_id');
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class,'ambiente_id');
    }

    public function insumos()
    {
        return $this->hasMany(Insumo::class,'ambiente_id');
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
