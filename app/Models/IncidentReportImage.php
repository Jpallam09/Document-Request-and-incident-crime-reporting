<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReportImage extends Model
{
    use HasFactory;

    protected $fillable = ['file_path']; // ✅ Allow mass assignment

    public function report()
    {
        return $this->belongsTo(IncidentReportUser::class, 'incident_report_user_id');
    }
}
