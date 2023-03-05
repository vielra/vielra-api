<?php

namespace App\Services;

use App\Http\Requests\CreatePhraseAudioRequest;
use App\Models\Phrase;
use Illuminate\Http\Request;
use App\Models\PhraseCategory;
use App\Models\PhraseAudio;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhraseAudioService
{

  /**
   * Create Phrase audio
   * 
   */
  public function create($data)
  {
    $file           = $data['audio_file'];
    $speech_name_id = isset($data['speech_name_id']) ? $data['speech_name_id'] : null;

    $extension          = $file->getClientOriginalExtension();
    $mimeType           = $file->getClientMimeType();
    $filePath           = 'audios/phrasebook';

    // Generate a file name with extension
    $fileName = Str::random(10) . '.' . $extension;

    // Save the file
    Storage::putFileAs("public/$filePath", $file, $fileName);

    $newPhaseAudio = [
      'user_id'               => auth()->id(),
      'speech_name_id'        => $speech_name_id,
      'locale'                => $data['locale'],
      'phrase_id'             => $data['phrase_id'],
      'mime_type'             => $mimeType,
      'audio_url'             => "/$filePath/$fileName",
    ];

    $phraseAudio = PhraseAudio::create($newPhaseAudio);
    return $phraseAudio->fresh();
  }

  /**
   * Update Phrase audio
   * 
   */
  public function update($data, $id)
  {
    //  Nothing
  }


  /**
   * Delete Phrase audio
   * 
   */
  public function delete(string $id)
  {
    $phraseAudio = PhraseAudio::findOrFail($id);

    $filePath = "/public$phraseAudio->audio_url";

    if (Storage::exists($filePath)) {
      Storage::delete($filePath);
    }

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
