<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Module extends Model
{
    use HasUuids;

    protected $table = "modules";

    protected $fillable = [
        'title',
        'slug',
        'cover',
        'description',
        'body',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
