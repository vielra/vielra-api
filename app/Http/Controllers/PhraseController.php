<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\PhrasebookService;
use App\Http\Requests\CreatePhraseRequest;
use App\Http\Resources\PhrasebookCollection;
use App\Http\Resources\Phrase as PhraseResource;
use App\Http\Resources\Phrasebook as PhrasebookResource;

class PhraseController extends Controller
{

    private PhrasebookService $phrasebookService;

    public function __construct(PhrasebookService $phrasebookService)
    {
        $this->phrasebookService = $phrasebookService;

        // Middleware
        $this->middleware(['auth:sanctum'])->only(['store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $phrasebook = $this->phrasebookService->findAll($request);

        if ($phrasebook) {
            if ($request->category) {
                return new PhrasebookResource($phrasebook);
            }

            return new PhrasebookCollection($phrasebook);
        }
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
    public function store(CreatePhraseRequest $request)
    {
        try {
            $phrase = $this->phrasebookService->create($request);
            return response()->json(
                new PhraseResource($phrase),
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
        try {
            $phrase = $this->phrasebookService->update($request, $id);
            if ($phrase) return new PhraseResource($phrase);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $result = $this->phrasebookService->delete($request);
            if ($result) return response()->json([
                'message'   => 'Phrase has been delete!'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message'   => $exception->getMessage(),
            ]);
        }
    }
}
