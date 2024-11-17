<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MentorInfo; // Import mô hình MentorInfo
use App\Models\MenteeInfo; // Import mô hình MenteeInfo
class CommunityDocument extends Model
{
    use HasFactory;

    protected $table = 'community_documents';

    // Các trường có thể thay đổi trong bảng
    protected $fillable = [
        'mentor_id',
        'mentee_id',
        'title',
        'content',
        'status',
    ];
// Định nghĩa quan hệ với mentor_info
public function mentor()
{
    return $this->belongsTo(MentorInfo::class, 'mentor_id');
}

// Định nghĩa quan hệ với mentee_info
public function mentee()
{
    return $this->belongsTo(MenteeInfo::class, 'mentee_id');
}

// Lấy tên người dùng từ mentor hoặc mentee
public function getUserNameAttribute()
{
    if ($this->mentor) {
        return $this->mentor->user->name;
    } elseif ($this->mentee) {
        return $this->mentee->user->name;
    }

    return null;
}
     
}
