<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Usser;
use App\Models\Simulacion;

class Reporte extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'descripcion',
        'usser_id',
        'simulacion_id'
    ];

        protected $allowIncluded = ['usser', 'simulacion'];

    public function usser()
    {
        return $this->belongsTo(Usser::class,'usser_id');
    }

    public function simulacion()
    {
        return $this->belongsTo(Simulacion::class,'simulacion_id');
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
