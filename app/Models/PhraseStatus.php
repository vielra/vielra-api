<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhraseStatus extends Model
{
    use HasFactory;


    // Constants
    const ACTIVE            = 1;
    const INACTIVE          = 2;
    const AWAITING_APPROVE  = 3;
    const INVALID           = 4;

    public $timestamps = false;

    /**
     * Relationship between PhraseStatus and Phrase
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phrases()
    {
        return $this->hasMany(Phrase::class, 'status_id');
    }
}
