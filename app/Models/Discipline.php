<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'course_id',
        'name',
        'order',
        'days'
    ];

    protected $dates = [
        'expires_at',
        'deleted_at'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class, 'discipline_id');
    }

    public function person(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'discipline_people', 'discipline_id', 'person_id')
                    ->withPivot(['score', 'exam_date', 'started_at', 'finished_at', 'exam_nr', 'registration'])
                    ->withTimestamps();
    }

    public function support_materials(): HasMany
    {
        return $this->hasMany(SupportMaterial::class, 'discipline_id');
    }
}
