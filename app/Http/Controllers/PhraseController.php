<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhraseRequest;
use App\Http\Resources\Phrase as PhraseResource;
use App\Http\Resources\PhraseCollection;
use App\Models\Phrase;
use Illuminate\Http\Request;

class PhraseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $phrases = Phrase::all();
        return new PhraseCollection($phrases);
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
            $data = $request->only(['text', 'category_id']);
            $newPhrase = Phrase::create($data);
            return new PhraseResource($newPhrase);
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
