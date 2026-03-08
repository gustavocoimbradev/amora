<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'next_run_at', 'frequency', 'last_sent_at', 'user_id'];

    protected function casts(): array
    {
        return [
            'next_run_at' => 'date:Y-m-d',
            'last_sent_at' => 'date:Y-m-d',
        ];
    }

    // Relationships

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Scopes

    public function scopeLatestFirst($query, $auth = false) {
        if ($auth) {
            return $query->orderBy('id', 'desc')->where('user_id', auth()->id());
        }
        return $query->orderBy('id', 'desc');
    }

    public function scopePending($query) {
        return $query->with('user')
            ->where('next_run_at', '<=', now())
            ->orderBy('id', 'desc');
    }

}
