<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NoteUser extends Pivot
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
