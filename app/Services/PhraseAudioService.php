<?php

namespace App\Services;

use App\Http\Requests\CreatePhraseAudioRequest;
use App\Models\Phrase;
use Illuminate\Http\Request;
use App\Models\PhraseCategory;
use App\Models\PhraseAudio;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PhraseAudioService
{

  /**
   * Create Phrase audio
   * 
   */
  public function create(CreatePhraseAudioRequest $request)
  {
    $data = $request->only([
      'phrase_id', 'voice_code', 'locale', 'base64_audio', 'mime',
    ]);

    $fileName = $this->uploadAudio($request->base64_audio, $request->mime);

    if ($fileName) {
      $data['audio_url'] = $fileName;
    }

    $phrase = PhraseAudio::create($data);
    return $phrase->fresh();
  }

  /**
   * Update Phrase audio
   * 
   */
  public function update(Request $request, $id)
  {
    $data = $request->only([
      'phrase_id', 'voice_code', 'locale', 'base64_audio', 'mime',
    ]);

    $fileName = $this->uploadAudio($request->base64_audio, $request->mime);

    if ($fileName) {
      $data['audio_url'] = $fileName;
    }

    $phraseAudio = PhraseAudio::findOrFail($id);
    $phraseAudio->update($data);

    return $phraseAudio->fresh();
  }


  /**
   * Delete Phrase audio
   * 
   */
  public function delete(string $id)
  {
    $phraseAudio = PhraseAudio::findOrFail($id);
    return $phraseAudio->delete();
  }

  /**
   * Upload audio
   * 
   * @param string $base64Audio
   * @param string $mime
   * @return string
   */
  private function uploadAudio(string $base64Audio, string $mime)
  {
    $fileName     = time();
    $destination  = storage_path('/app/public/phrasebook/audios/');

    if ($mime === 'audio/mpeg' || $mime === 'audio/mp3') {
      $fileName = $fileName . '.mp3';
    } else {
      $fileName = $fileName;
    }

    if (!File::isDirectory($destination)) {
      File::makeDirectory($destination, 0777, true, true);
    }

    $path = $destination . $fileName;
    File::put($path, base64_decode($base64Audio));

    return $fileName;
  }
}
