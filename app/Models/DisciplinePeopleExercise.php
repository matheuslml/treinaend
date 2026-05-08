<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class DisciplinePeopleExercise extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'discipline_people_exercise';

    protected $fillable = [
        'discipline_people_id',
        'exercise_id',
        'order',
        'answer',
        'correct'
    ];

    protected $dates = [
        'expires_at',
        'deleted_at'
    ];

    public function discipline_person(): BelongsTo
    {
        return $this->belongsTo(DisciplinePeople::class, 'discipline_people_id');
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }
}
