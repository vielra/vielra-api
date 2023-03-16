<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhraseCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\PhraseCategoryCollection;
use App\Http\Resources\PhraseCategory as PhraseCategoryResource;

class PhraseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PhraseCategory::all();
        return new PhraseCategoryCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->only([
                'name', 'slug', 'icon_name', 'icon_type', 'color', 'order', 'is_active'
            ]);
            $data['name'] = json_encode($request->name);

            $newCategory = PhraseCategory::create($data);
            return new PhraseCategoryResource($newCategory);
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
        //
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
                'name', 'slug', 'icon_name', 'icon_type', 'color', 'order', 'is_active'
            ]);
            $data['name'] = json_encode($request->name);

            $phraseCategory = PhraseCategory::findOrFail($id);
            $phraseCategory->update($data);
            return new PhraseCategoryResource($phraseCategory);
        } catch (\Exception $e) {
            return Response::json([
                'messages' => $e->getMessage()
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $phraseCategory = PhraseCategory::findOrFail($id);
            $phraseCategory->delete();
            return Response::json([
                'message'   => 'Phrase category has been delete!'
            ]);
        } catch (\Exception $exception) {
            return Response::json([
                'message'   => $exception->getMessage(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
