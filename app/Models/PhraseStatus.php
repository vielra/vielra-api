<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhraseStatus extends Model
{
    use HasFactory;

    // Constants
    const STATUS_ID_ACTIVE            = 1;
    const STATUS_ID_INACTIVE          = 2;
    const STATUS_ID_AWAITING_APPROVE  = 3;
    const STATUS_ID_INVALID           = 4;

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
