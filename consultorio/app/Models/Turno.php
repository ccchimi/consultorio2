<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Turno extends Model
{
    use HasFactory;

    protected $fillable = ['dni_paciente', 'fecha', 'status', 'user_id']; // Agregamos 'user_id'

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class); // Relación inversa con User
    }

    /**
     * @method static Builder|Turno create(array $attributes = [])
     */
}
