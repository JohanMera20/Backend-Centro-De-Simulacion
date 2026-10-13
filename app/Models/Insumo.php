<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Simulacion;
use App\Models\Ambiente;


class Insumo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'cantidad',
        'ambiente_id'
    ];


    protected $allowIncluded = ['ambiente', 'simulaciones'];


    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class,'ambiente_id');
    }


    public function simulaciones()
    {
        return $this->belongsToMany(Simulacion::class,'simulacion_insumo');
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
