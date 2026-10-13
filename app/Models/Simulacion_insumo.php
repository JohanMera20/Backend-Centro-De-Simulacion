<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Simulacion;
use App\Models\Insumo;

class SimulacionInsumo extends Model
{
    use HasFactory;

     protected $table = 'simulacion_insumo';

    protected $fillable = [
        'simulacion_id',
        'insumo_id'
    ];

    protected $allowIncluded = ['simulacion','insumo'];

    public function simulacion()
    {
        return $this->belongsTo(Simulacion::class, 'simulacion_id');
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class, 'insumo_id');
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
