<?php

namespace App\Traits;

use Laravel\Sanctum\HasApiTokens as SanctumHasApiTokens;

trait HasApiTokens
{

  use SanctumHasApiTokens {
    tokens as protected sanctumTokens;
  }

  /**
   * Get the access tokens that belong to model.
   *
   * @return \Illuminate\Database\Eloquent\Relations\MorphMany
   */
  public function tokens()
  {
    return $this->morphMany(\App\Models\PersonalAccessToken::class, 'tokenable');
  }
}
