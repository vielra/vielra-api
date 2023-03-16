<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhraseReport extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'phrase_id',
        'user_id',
        'report_type_id',
        'body',
    ];

    public function phrase()
    {
        return $this->hasMany(Phrase::class);
    }
}
