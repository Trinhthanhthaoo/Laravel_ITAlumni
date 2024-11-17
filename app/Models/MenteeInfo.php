<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenteeInfo extends Model
{
    use HasFactory;

    protected $table = 'mentee_info';

    // Các trường có thể thay đổi trong bảng
    protected $fillable = [
        'user_id',
        'gpa',
        'achievements',
        'goals',
    ];

    /**
     * Định nghĩa mối quan hệ với model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
