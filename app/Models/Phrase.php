<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phrase extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id',
        'text_vi',
        'text_en',
        'text_id',
        'status_id',
        'order',
        'confirmed',
        'confirmed_by_user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'confirmed'     => 'boolean',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status_id'     => PhraseStatus::STATUS_ID_ACTIVE,
        'order'         => 0,
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['audios'];


    /**
     * Scope a query to only include phrase with status active.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status_id', PhraseStatus::STATUS_ID_ACTIVE);
    }

    /**
     * Scope a query to only include phrase with status inactive.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInActive($query)
    {
        return $query->where('status_id', PhraseStatus::STATUS_ID_INACTIVE);
    }

    /**
     * Scope a query to only include phrase with status awaiting approve.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAwaitingApprove($query)
    {
        return $query->where('status_id', PhraseStatus::STATUS_ID_AWAITING_APPROVE);
    }

    /**
     * Scope a query to only include phrase with status invalid.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInvalid($query)
    {
        return $query->where('status_id', PhraseStatus::STATUS_ID_INVALID);
    }

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
    // public function category()
    // {
    //     return $this->belongsTo(PhraseCategory::class, 'category_id');
    // }

    public function categories()
    {
        return $this->belongsToMany(PhraseCategory::class, 'phrase_category_to_phrase', 'phrase_id', 'category_id');
    }


    /**
     * Relationship between Phrase and PhraseStatus
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(PhraseStatus::class, 'status_id');
    }

    /**
     * Relationship between Phrase and PhraseAudio
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function audios()
    {
        return $this->hasMany(PhraseAudio::class);
    }
}
