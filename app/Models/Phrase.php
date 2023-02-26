<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phrase extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {

            $uuid =  Str::orderedUuid()->toString();

            // Override Uuids trait
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = $uuid;
            }

            // Order
            $model->order = self::getNextOrderNumber($model);

            /** user id */
            $model->user_id = auth()->user()->id;
        });
    }

    private function getNextOrderNumber($model)
    {
        $lastRow = $model->orderBy('order', 'desc')->first();
        if ($lastRow) {
            return $lastRow->order + 1;
        }
        return 0;
    }

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id',
        'text_vi',
        'text_en',
        'text_id',
        'category_id',
        'status_id',
        'order',
    ];


    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status_id' => PhraseStatus::ACTIVE,
        'order'     => 0,
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
        return $query->where('status_id', PhraseStatus::ACTIVE);
    }

    /**
     * Scope a query to only include phrase with status inactive.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInActive($query)
    {
        return $query->where('status_id', PhraseStatus::INACTIVE);
    }

    /**
     * Scope a query to only include phrase with status awaiting approve.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAwaitingApprove($query)
    {
        return $query->where('status_id', PhraseStatus::AWAITING_APPROVE);
    }

    /**
     * Scope a query to only include phrase with status invalid.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInvalid($query)
    {
        return $query->where('status_id', PhraseStatus::INVALID);
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
    public function category()
    {
        return $this->belongsTo(PhraseCategory::class, 'category_id');
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
