<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Exercise extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'exercises';

    protected $fillable = [
        'discipline_id',
        'file',
        'answers',
        'correct_answer',
        'type'
    ];//

    protected $dates = [
        'expires_at',
        'deleted_at'
    ];

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class, 'discipline_id');
    }
}
