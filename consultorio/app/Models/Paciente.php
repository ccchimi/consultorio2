<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'dni', 'email', 'telefono', 'fecha_nacimiento', 'user_id']; // Agregamos 'user_id'

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class); // Relación inversa con User
    }

    /**
     * @method static \Illuminate\Database\Eloquent\Builder|Paciente create(array $attributes = [])
     * @method static \Illuminate\Database\Eloquent\Builder|Paciente where(string $column, mixed $value)
     */
}
