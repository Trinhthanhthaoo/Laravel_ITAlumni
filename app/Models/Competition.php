<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    // Định nghĩa bảng và các cột có thể gán đại trà
    protected $table = 'competitions'; // Tên bảng (tùy chỉnh nếu không phải tên mặc định)
    protected $fillable = [
        'mentor_id',
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    // Định nghĩa mối quan hệ với bảng mentor_info
    public function mentor()
    {
        return $this->belongsTo(MentorInfo::class, 'mentor_id');
    }
}
