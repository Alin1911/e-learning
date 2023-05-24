<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $table = 'user_activity';

    public function getLike($id, $type)
    {
       $user = auth()->user();
        if (!$user) {
              return false;
        }
        return $this->where('user_id', $user->id)
            ->where('activity_id', $id)
            ->where('activity_model', $type)
            ->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
