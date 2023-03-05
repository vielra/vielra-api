<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeechName extends Model
{
    use HasFactory;

    protected $fillable = [
        'voice_code',
        'speech_name',
        'language_code',
    ];

    public function phrase() {
        return $this->hasOne(Phrase::class);
    }
}
