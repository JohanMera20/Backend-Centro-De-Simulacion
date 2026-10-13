<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Servicio;
use App\Models\Ambiente;
use App\Models\Reporte;
use App\Models\Equipo;
use App\Models\Insumo;

class Simulacion extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'servicio_id',
        'ambiente_id'
    ];

    protected $allowIncluded = ['servicio','ambiente','reportes','equipos','insumos'];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class,'servicio_id');
    }

    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class,'ambiente_id');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class,'simulacion_id');
    }


    public function equipos()
    {
        return $this->belongsToMany(Equipo::class,'simulacion_equipo');
    }

    public function insumos()
    {
        return $this->belongsToMany(Insumo::class,'simulacion_insumo');
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
