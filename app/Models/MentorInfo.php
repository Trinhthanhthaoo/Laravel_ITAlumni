<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorInfo extends Model
{
    use HasFactory;

    // Define the table name if it differs from the pluralized model name
    protected $table = 'mentor_info';

    // Define the fillable fields (so they can be mass assigned)
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'expertise',
        'organization',
        'referral_source',
        'suggestions_questions',
        'achievements',
        
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
