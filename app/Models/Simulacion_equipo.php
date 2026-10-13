<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Simulacion;
use App\Models\Equipo;

class SimulacionEquipo extends Model
{
    use HasFactory;

    protected $table = 'simulacion_equipo';

    protected $fillable = [
        'simulacion_id',
        'equipo_id'
    ];

    protected $allowIncluded = ['simulacion','equipo'];

    public function simulacion()
    {
        return $this->belongsTo(Simulacion::class, 'simulacion_id');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
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