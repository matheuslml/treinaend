<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class DisciplinePersonExercises extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'discipline_people';

    protected $fillable = [
        'discipline_person_id',
        'exercise_id',
        'answer',
        'correct'
    ];

    protected $dates = [
        'expires_at',
        'deleted_at'
    ];

    public function discipline_person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Discipline::class, 'discipline_id');
    }
}
