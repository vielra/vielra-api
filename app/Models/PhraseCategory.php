<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhraseCategory extends Model
{
    use HasFactory, Uuids;

    public const ID_UNCATEGORY = '97108888-1409-4acb-88f4-673898f0ec4e';

    protected $fillable = [
        'name',
        'slug',
        'color',
        'icon_name',
        'icon_type',
        'image_url',
        'order',
        'is_active'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status_id' => PhraseStatus::ACTIVE,
        'order'     => 0,
        'is_active' => 1,
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['phrases_count'];


    /**
     * Scope a query to only include phrase category is active.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include phrase category is inactive.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInActive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPhrasesCountAttribute()
    {
        return $this->phrases->count();
    }

    /**
     * Relationship between PhraseCategory and Phrase
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phrases()
    {
        return $this->hasMany(Phrase::class, 'category_id');
    }
}
