<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class JobPosting extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'job_postings';

    protected $dates = [
        'expiry_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const JOB_TYPE_SELECT = [
        'Full-Time' => 'Full-Time',
        'Part-Time' => 'Part-Time',
        'Contract'  => 'Contract',
    ];

    protected $fillable = [
        'job_title',
        'job_category_id',
        'job_type',
        'description',
        'requirements',
        'expiry_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function job_category()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function getExpiryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setExpiryDateAttribute($value)
    {
        $this->attributes['expiry_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
