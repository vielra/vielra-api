<?php

namespace App\Services;


use App\Models\Phrase;
use Illuminate\Http\Request;
use App\Models\PhraseCategory;
use App\Http\Requests\CreatePhraseRequest;

class PhrasebookService
{

  /**
   * Find all phrasebook or by category.
   *
   */
  public function findAll(Request $request)
  {
    $phrasebook = null;

    if ($request->category) {
      $phrasebook = PhraseCategory::active()->with(['phrases'])->where('slug', $request->category)->first();
    } else {
      $phrasebook = PhraseCategory::active()->with(['phrases'])->get();
    }
    return $phrasebook;
  }


  /**
   * Create Phrase
   * 
   */
  public function create(CreatePhraseRequest $request)
  {
    $userId = auth()->id();

    $data = $request->merge(['user_id' => $userId])->only([
      'user_id', 'text_vi', 'text_en', 'text_id', 'category_id'
    ]);

    $phrase = Phrase::create($data);
    return $phrase->fresh();
  }

  /**
   * Update Phrase
   * 
   */
  public function update(Request $request, $id)
  {
    $data = $request->only([
      'text_vi', 'text_en', 'text_id', 'category_id', 'order', 'status_id'
    ]);

    $phrase = Phrase::findOrFail($id);

    $phrase->update($data);
    return $phrase->fresh();
  }


  /**
   * Delete Phrase
   * 
   */
  public function delete($request)
  {
    if (is_array($request->all())) {
      return Phrase::whereIn('id', $request->all())->delete();
    } else {
      return false;
    }
  }
}
