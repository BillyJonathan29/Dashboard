<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\User;

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
        'publisher_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }
}
