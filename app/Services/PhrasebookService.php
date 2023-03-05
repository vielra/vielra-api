<?php

namespace App\Services;

use App\Http\Requests\CreatePhraseReportRequest;
use App\Models\Phrase;
use Illuminate\Http\Request;
use App\Models\PhraseCategory;
use App\Http\Requests\CreatePhraseRequest;
use App\Models\PhraseReport;

class PhrasebookService
{

  /**
   * Find all phrasebook or by category.
   *
   */
  public function findAll($data)
  {
    $phrasebook = null;

    if (isset($data['category'])) {
      $phrasebook = PhraseCategory::active()->with(['phrases'])->where('slug', $data['category'])->first();
    } else {
      $phrasebook = PhraseCategory::active()->with(['phrases'])->get();
    }
    return $phrasebook; // ->orderBy('order', 'asc')->get();
  }

  /**
   * Get phrase by id
   * 
   */
  public function findById($id)
  {
    return Phrase::findOrFail($id);
  }


  /**
   * Create Phrase
   * 
   */
  public function create($data)
  {
    $newPhrase = $data;

    if (isset($data['confirmed']) && $data['confirmed']) {
      $newPhrase['confirmed_by_user_id'] = auth()->id();
    }

    $newPhrase['category_id'] = isset($data['category_id']) ? $data['category_id'] : PhraseCategory::ID_UNCATEGORY;

    if (isset($data['mark_as_created_by_system']) && $data['mark_as_created_by_system']) {
      $newPhrase['user_id'] = null;
    } else {
      $newPhrase['user_id'] = auth()->id();
    }

    $phrase = Phrase::create($newPhrase);
    return $phrase->fresh();
  }

  /**
   * Update Phrase
   * 
   */
  public function update($data, $id)
  {
    $phrase = Phrase::findOrFail($id);
    $phrase->update($data);
    return $phrase->fresh();
  }


  /**
   * Delete Phrase
   * 
   */
  public function delete($phraseIds)
  {
    if (is_array($phraseIds) && count($phraseIds) > 0) {
      return Phrase::whereIn('id', $phraseIds)->delete();
    } else {
      return false;
    }
  }

  /**
   * Confirm phrases
   * 
   */
  public function confirm($phraseIds)
  {
    if (is_array($phraseIds) && count($phraseIds) > 0) {
      foreach ($phraseIds as $id) {
        $item = Phrase::findOrFail($id)->first();
        if ($item)
          $item->update([
            'confirmed'             =>  1,
            'confirmed_by_user_id'  => auth()->id(),
          ]);
      }
      return true;
    } else {
      return false;
    }
  }
}
