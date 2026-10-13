<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Simulacion;
use App\Models\Equipo;
use App\Models\Insumo;

class Equipo extends Model
{

    use HasFactory;

    
    protected $fillable = [
        'nombre',
        'serial',
        'ambiente_id'
    ];

    protected $allowIncluded = ['ambiente', 'simulaciones'];

    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class,'ambiente_id');
    }

    public function simulaciones()
    {
        return $this->belongsToMany(
            Simulacion::class,'simulacion_equipo');
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
