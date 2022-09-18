<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhraseReportRequest;
use App\Http\Resources\PhraseReport as PhraseReportResource;
use App\Http\Resources\PhraseReportCollection;
use App\Models\PhraseReport;
use Illuminate\Http\Request;

class PhraseReportController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Check specific user maybe only isAdmin can see report list.
        $reports = PhraseReport::paginate(25);
        return new PhraseReportCollection($reports);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePhraseReportRequest $request)
    {
        $data = $request->only(['phrase_id', 'user_id', 'report_type_id', 'body']);
        try {
            $phrase =  PhraseReport::create($data);
            if ($phrase) return response()->json([
                'message'   => 'Your report has been sent successfully!'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message'   => $exception->getMessage(),
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
