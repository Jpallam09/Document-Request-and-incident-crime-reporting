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
    protected $fillable = [
        'report_title',
        'report_date',
        'report_type',
        'report_description',
        'is_actioned',
        'user_id',
    ];

    /**
     * Relationship: One incident report can have many attached images.
     * This assumes a separate table (incident_report_images) where each image belongs to a report.
     */
    public function images()
    {
        return $this->hasMany(IncidentReportImage::class);
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
        return $this->hasOne(EditRequest::class, 'incident_report_id');
    }

    // Delete request relationship
    // public function deleteRequest()
    // {
    //     return $this->hasOne(DeleteRequest::class, 'incident_report_id');
    // }
}
