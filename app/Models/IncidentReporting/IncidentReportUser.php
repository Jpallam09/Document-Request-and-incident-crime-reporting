<?php

namespace App\Models\IncidentReporting;

use App\Models\User;
use App\Models\IncidentReporting\IncidentReportImage;
use Illuminate\Database\Eloquent\Model;

class IncidentReportUser extends Model
{
    /**
     * The attributes that are mass assignable.
     * These fields can be set using create() or fill().
     */
    // In IncidentReportUser.php

    // Report types
    const TYPE_SAFETY       = 'Safety';
    const TYPE_SECURITY     = 'Security';
    const TYPE_OPERATIONAL  = 'Operational';
    const TYPE_ENVIRONMENT  = 'Environmental';
    public static $types = [
        self::TYPE_SAFETY,
        self::TYPE_SECURITY,
        self::TYPE_OPERATIONAL,
        self::TYPE_ENVIRONMENT,
    ];

    // Report statuses
    const STATUS_PENDING     = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_SUCCESS     = 'success';
    const STATUS_CANCELED    = 'canceled';

    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_IN_PROGRESS,
        self::STATUS_SUCCESS,
        self::STATUS_CANCELED,
    ];


    protected $fillable = [
        'user_name',
        'report_title',
        'report_date',
        'report_type',
        'report_description',
        'report_status',
        'user_id',
    ];

    protected $casts = [
    'requested_image' => 'array', // Laravel auto-decodes JSON into array
];

    // Check report status
    public function isPending(): bool
    {
        return $this->report_status === self::STATUS_PENDING;
    }

    public function isSuccess(): bool
    {
        return $this->report_status === self::STATUS_SUCCESS;
    }

    public function isCanceled(): bool
    {
        return $this->report_status === self::STATUS_CANCELED;
    }

    /**
     * Relationship: One incident report can have many attached images.
     * This assumes a separate table (incident_report_images) where each image belongs to a report.
     */
    public function images()
    {
        return $this->hasMany(IncidentReportImage::class, 'incident_report_user_id');
    }

    /**
     * Relationship: Each report is submitted by one user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Edit request relationship
    public function editRequest()
    {
        return $this->hasOne(EditRequest::class, 'edit_report_id');
    }

    // Delete request relationship
    public function deleteRequest()
    {
        return $this->hasOne(DeleteRequest::class, 'delete_report_id');
    }

    // Track which staff locations are tied to this report
    public function staffLocations()
    {
        return $this->hasMany(StaffLocation::class, 'report_id');
    }
}
