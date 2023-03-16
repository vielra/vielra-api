<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\PhraseAudioService;
use App\Http\Resources\PhraseAudio as PhraseAudioResource;
use App\Http\Requests\StorePhraseAudioRequest;
use App\Http\Resources\PhraseAudioCollection;
use Illuminate\Support\Facades\Response;

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
    public function index(Request $request)
    {
        try {
            $audios = $this->phraseAudioService->findAll($request->all());
            return new PhraseAudioCollection($audios);
        } catch (\Exception $e) {
            return Response::json([
                'messages' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhraseAudioRequest $request)
    {
        try {
            $phraseAudio = $this->phraseAudioService->create($request->only([
                'phrase_id', 'locale', 'speech_name_id', 'audio_file'
            ]));
            return Response::json(
                new PhraseAudioResource($phraseAudio),
                JsonResponse::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return Response::json([
                'messages' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
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
        return Response::json([
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
            if ($result) return Response::json([
                'message'   => 'Audio phrase has been delete!'
            ]);
        } catch (\Exception $exception) {
            return Response::json([
                'message'   => $exception->getMessage(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
