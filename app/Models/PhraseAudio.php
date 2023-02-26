<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhraseAudio extends Model
{
    use HasFactory, Uuids;

    protected $table = 'phrase_audios';

    protected $fillable = [
        'audio_url', 'locale', 'user_id', 'phrase_id', 'voice_code', 'mime'
    ];

    /**
     * Relationship between PhraseAudio and Phrase
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phrase()
    {
        return $this->belongsTo(Phrase::class, 'audio_id');
    }
}
