<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhraseCategoryRequest;
use App\Http\Resources\PhraseCategoryCollection;
use App\Models\PhraseCategory;
use Illuminate\Http\Request;

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
    public function store(CreatePhraseCategoryRequest $request)
    {
        try {
            $data = $request->only(['name', 'slug', 'icon_name', 'icon_type', 'color']);
            $newCategory = PhraseCategory::create($data);
            return new PhraseCategory($newCategory);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
