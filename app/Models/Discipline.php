<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Discipline extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'disciplines';

    protected $fillable = [
        'name',
        'order',
        'days'
    ];//

    protected $dates = [
        'expires_at',
        'deleted_at'
    ];

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class, 'discipline_id');
    }

    public function person(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }
}
