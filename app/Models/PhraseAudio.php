<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhraseAudio extends Model
{
    use HasFactory, Uuids;

    protected $table = 'phrase_audios';

    /** 
     * Eager load on every query
     */
    protected $with = ['speech_name'];

    protected $fillable = [
        'speech_name_id',
        'audio_url',
        'locale',
        'user_id',
        'phrase_id',
        'mime_type'
    ];

    /**
     * Relationship between PhraseAudio and Phrase
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phrase()
    {
        return $this->belongsTo(Phrase::class, 'audio_id');
    }

    /**
     * Relationship between PhraseAudio and SpeechName
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function speech_name()
    {
        return $this->belongsTo(SpeechName::class, 'speech_name_id');
    }
}
