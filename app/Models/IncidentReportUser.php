<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReportUser extends Model
{
    protected $fillable = [
    'report_title',
    'report_date',
    'report_type',
    'report_description',
    'report_image',
    'is_actioned',
];

    use HasFactory;
}
