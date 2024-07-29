<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestResume extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'request_resumes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'resume_id',
        'accepted',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function resume()
    {
        return $this->belongsTo(MyResume::class, 'resume_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
