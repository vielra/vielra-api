<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phrase extends Model
{
    use HasFactory, Uuids;

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id',
        'text',
        'category_id',
        'notes',
    ];


    /**
     * Relationship between Phrase and User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship between Phrase and PhraseCategory
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(PhraseCategory::class, 'category_id');
    }
}
