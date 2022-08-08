<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhraseCategory extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
        'slug',
        'color',
        'icon_name',
        'icon_type',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['phrases_count'];

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
