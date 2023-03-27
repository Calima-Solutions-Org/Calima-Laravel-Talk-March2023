<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'module_id',
    ];

    protected static function booted()
    {
        static::created(function ($note) {
            if (auth()->check()) {
                $note->users()->create([
                    'role' => 'owner',
                    'user_id' => auth()->id(),
                ]);
            }
        });

        static::addGlobalScope('allowed', function ($query) {
            if (auth()->check()) {
                $query->whereHas('users', fn ($q) => $q->where('user_id', auth()->id()));
            }
        });
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function files()
    {
        return $this->hasMany(NoteFile::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
