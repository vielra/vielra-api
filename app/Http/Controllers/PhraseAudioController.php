<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\PhraseAudioService;
use App\Http\Requests\CreatePhraseAudioRequest;
use App\Http\Resources\PhraseAudio as PhraseAudioResource;

class PhraseAudioController extends Controller
{

    private PhraseAudioService $phraseAudioService;

    public function __construct(PhraseAudioService $phraseAudioService)
    {
        $this->phraseAudioService = $phraseAudioService;

        // Middleware
        $this->middleware(['auth:sanctum'])->only(['store', 'update', 'delete']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message'   => 'Awww.. Dont\'t cry! it\'s a just a 404 error!',
        ], JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePhraseAudioRequest $request)
    {
        try {
            $phraseAudio = $this->phraseAudioService->create($request->only([
                'phrase_id', 'locale', 'speech_name_id', 'audio_file'
            ]));
            return response()->json(
                new PhraseAudioResource($phraseAudio),
                JsonResponse::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return response()->json([
                'messages' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'message'   => 'Awww.. Dont\'t cry! it\'s a just a 404 error!',
        ], JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //  Nothing
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        try {
            $result = $this->phraseAudioService->delete($id);
            if ($result) return response()->json([
                'message'   => 'Audio phrase has been delete!'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message'   => $exception->getMessage(),
            ]);
        }
    }
}
