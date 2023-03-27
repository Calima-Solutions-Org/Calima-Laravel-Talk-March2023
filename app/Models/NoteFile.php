<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class NoteFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'note_id',
        'path',
    ];

    public function fileUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::url($this->path),
        );
    }
}
