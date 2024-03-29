<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhraseCategory extends Model
{
    use HasFactory, Uuids;

    public const ID_UNCATEGORY = '97108888-1409-4acb-88f4-673898f0ec4e';
    public const LIST_MOBILE_ICONS = ['material-icon', 'material-community-icon', 'ionicon', 'feather'];

    protected $fillable = [
        'name',
        'slug',
        'color',
        'mobile_icon',
        'mobile_icon_type',
        'web_icon',
        'image_url',
        'order',
        'is_initial',
        'is_active',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
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
        return $this->belongsToMany(Phrase::class, 'phrase_category_to_phrase', 'category_id', 'phrase_id');
    }
}
