<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class Coupon extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'coupons';

    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'observation',
        'code',
        'amount',
        'discount_percentage',
        'started_at',
        'finished_at',
        'status'
    ];

    protected $dates = [
        'started_at',
        'finished_at',
        'expires_at',
        'deleted_at'
    ];

    // Mutator para gerar slug automaticamente
    public function setNameAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'coupon_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
