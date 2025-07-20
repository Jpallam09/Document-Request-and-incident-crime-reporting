<?php

namespace App\Models\IncidentReporting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'incident_report_id',
        'requested_by',
        'requested_title',
        'requested_description',
        'requested_type',
        'requested_image',
        'status',
        'requested_at',
        'reviewed_at',
    ];
    // This lets Laravel treat JSON image data as array automatically
    protected $casts = [
        'requested_image' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'requested_by');
    }

    public function report()
    {
        return $this->belongsTo('App\Models\IncidentReporting\IncidentReportUser', 'incident_report_id');
    }
}
