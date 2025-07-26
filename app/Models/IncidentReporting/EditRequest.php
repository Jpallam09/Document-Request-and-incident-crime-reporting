<?php

namespace App\Models\IncidentReporting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * @property int $id
 * @property int $incident_report_id
 * @property int $requested_by
 * @property string|null $requested_title
 * @property string|null $requested_description
 * @property string|null $requested_type
 * @property array|null $requested_image
 * @property string|null $requested_report_date
 * @property string $status
 * @property \Illuminate\Support\Carbon $requested_at
 * @property int|null $reviewed_by
 * @property \Illuminate\Support\Carbon|null $reviewed_at
 *
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User|null $reviewer
 * @property-read \App\Models\IncidentReporting\IncidentReportUser $report
 */

class EditRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'incident_report_id',
        'requested_by',
        'reviewed_by',
        'requested_title',
        'requested_description',
        'requested_type',
        'requested_image',
        'requested_report_date',
        'status',
        'requested_at',
        'reviewed_at',
    ];
    // This lets Laravel treat JSON image data as array automatically
    protected $casts = [
        'requested_image' => 'array',
        'requested_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

        // Relationships
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'requested_by');
    }

        public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function report()
    {
        return $this->belongsTo('App\Models\IncidentReporting\IncidentReportUser', 'incident_report_id');
    }
}
