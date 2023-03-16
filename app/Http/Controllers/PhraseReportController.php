<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhraseReportRequest;
use App\Http\Resources\PhraseReportCollection;
use App\Models\PhraseReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
    public function store(StorePhraseReportRequest $request)
    {
        $data = $request->only(['phrase_id', 'user_id', 'report_type_id', 'body']);
        try {
            $phrase =  PhraseReport::create($data);
            if ($phrase) return Response::json([
                'message'   => 'Your report has been sent successfully!'
            ]);
        } catch (\Exception $exception) {
            return Response::json([
                'message'   => $exception->getMessage(),
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
