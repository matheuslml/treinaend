<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class Course extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditableTrait;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'slug',
        'acronym',
        'order',
        'grade',
        'payment_value',
        'certificate_file',
        'image_card',
        'image_banner',
        'image_conclusion',
        'type',
        'excerpt',
        'body',
        'meta_description',
        'meta_keywords',
        'status'
    ];

    protected $dates = [
        'expires_at',
        'deleted_at'
    ];

    // Mutator para gerar slug automaticamente
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function disciplines(): HasMany
    {
        return $this->hasMany(Discipline::class, 'course_id');
    }
    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class, 'course_id');
    }
}
