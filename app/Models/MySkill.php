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

class MySkill extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'my_skills';

    protected $dates = [
        'start_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'company',
        'job_title',
        'job_category_id',
        'start_date',
        'to_present',
        'end_date',
        'comments',
        'my_resume_id',
        'user_id',
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

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function my_resume()
    {
        return $this->belongsTo(MyResume::class, 'my_resume_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
