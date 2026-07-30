<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class NotificationTemplate extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use AuditableTrait;

    protected $table = 'notification_templates';

    protected $fillable = [
        'title',
        'content',
        'description',
        'phone_number',
        'type'
    ];

    protected $dates = [
        'scheduled_at'
    ];

    public function notifications(): BelongsToMany
    {
        return $this->belongsToMany(Notification::class);
    }
}