<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

// phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
class Person extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;


    protected $table = 'people';

    protected $cascadeDeletes = ['documents'];

    protected $fillable = [
        'full_name',
        'social_name',
        'status'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function disciplines(): BelongsToMany
    {
        return $this->belongsToMany(Discipline::class, 'discipline_people', 'person_id', 'discipline_id')
                    ->withPivot(['score', 'exam_date', 'started_at', 'finished_at', 'exam_nr', 'registration'])
                    ->withTimestamps();
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class, 'person_id');
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class, 'person_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'person_id')->withDefault();
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'person_id');
    }

    public function setFullNameAttribute($value): void
    {
        $this->attributes['full_name'] = mb_strtoupper($value);
    }

    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class, 'person_id');
    }
}
