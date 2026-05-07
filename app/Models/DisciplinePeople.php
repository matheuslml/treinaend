<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class DisciplinePeople extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'discipline_people';

    protected $fillable = [
        'discipline_id',
        'person_id',
        'exam_date',
        'exam_started_at',
        'exam_finished_at',
        'started_at',
        'finished_at',
        'current_question',
        'score',
        'exam_nr',
        'registration'//remover
    ];

    protected $dates = [
        'exam_date',
        'exam_started_at',
        'exam_finished_at',
        'started_at',
        'finished_at',
        'expires_at',
        'deleted_at'
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class, 'discipline_id');
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class)->withPivot('order', 'answer', 'correct')->withTimestamps();
    }

    public function discipline_people_exercises(): HasMany
    {
        return $this->hasMany(DisciplinePeopleExercise::class, 'discipline_people_id');
    }
}
