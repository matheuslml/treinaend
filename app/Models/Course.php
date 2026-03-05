<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Course extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    protected $dates = [
        'expires_at',
        'deleted_at'
    ];

    public function disciplines(): HasMany
    {
        return $this->hasMany(Discipline::class, 'course_id');
    }
}
