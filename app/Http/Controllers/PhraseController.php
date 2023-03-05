<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\PhrasebookService;
use App\Http\Requests\CreatePhraseRequest;
use App\Http\Resources\PhrasebookCollection;
use App\Http\Resources\Phrase as PhraseResource;
use App\Http\Resources\Phrasebook as PhrasebookResource;
use Illuminate\Support\Facades\Response;

class PhraseController extends Controller
{

    private PhrasebookService $phrasebookService;

    public function __construct(PhrasebookService $phrasebookService)
    {
        $this->phrasebookService = $phrasebookService;

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
        $phrasebook = $this->phrasebookService->findAll($request->all());

        if ($phrasebook) {
            if ($request->category) {
                return new PhrasebookResource($phrasebook);
            }

            return new PhrasebookCollection($phrasebook);
        }
        return Response::json([
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
            $data = $request->only([
                'category_id',
                'text_vi',
                'text_en', 'text_id',
                'confirmed',
                'mark_as_created_by_system',
                'order'
            ]);
            $phrase = $this->phrasebookService->create($data);
            return Response::json(new PhraseResource($phrase), JsonResponse::HTTP_CREATED);
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
        $phrase = $this->phrasebookService->findById($id);
        return new PhraseResource($phrase);
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
            $data = $request->only([
                'phrase_id',
                'category_id',
                'text_vi',
                'text_en', 'text_id',
                'confirmed',
                'mark_as_created_by_system',
                'order'
            ]);
            $phrase = $this->phrasebookService->update($data, $id);
            if ($phrase) return new PhraseResource($phrase);
        } catch (\Exception $e) {
            return Response::json([
                'messages' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Confirm phrase
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'phrase_ids'           => ['required', 'array'],
            'phrase_ids.*'         => ['required', 'string'],
        ]);
        try {
            $result = $this->phrasebookService->confirm($request->only(['phrase_ids']));
            if ($result) return Response::json([
                'message'   => 'Phrases confirmed successfully!'
            ]);
        } catch (\Exception $exception) {
            return Response::json([
                'message'   => $exception->getMessage(),
            ], JsonResponse::HTTP_BAD_REQUEST);
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
        $request->validate([
            'phrase_ids'           => ['required', 'array'],
            'phrase_ids.*'         => ['required', 'string'],
        ]);
        try {
            $result = $this->phrasebookService->delete($request->only(['phrase_ids']));
            if ($result) return Response::json([
                'message'   => 'Phrases deleted successfully!'
            ]);
        } catch (\Exception $exception) {
            return Response::json([
                'message'   => $exception->getMessage(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
