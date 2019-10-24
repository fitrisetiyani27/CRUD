<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubChapter;
use Validator;

class SubChapterController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
     public function sendResponse($result, $message)
     {
         $response = [
             'success' => true,
             'data'    => $result,
             'message' => $message,
         ];
 
         return response()->json($response, 200);
     }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subchapter = SubChapter::all();
        return $this->sendResponse($subchapter->toArray(), 'Subchapter retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'uuid' => 'required',
            'thumbnail' => 'required',
            'content' => 'required',
            'title' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $subchapter = SubChapter::create($input);

        return $this->sendResponse($subchapter->toArray(), 'Subchapter created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $subchapter = SubChapter::where('uuid', $uuid)->first();

        if (is_null($subchapter)) {
            return $this->sendError('Subchapter not found.');
        }

        return $this->sendResponse($subchapter->toArray(), 'Subchapter retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, SubChapter $subchapter)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'uuid' => 'required',
            'thumbnail' => 'required',
            'content' => 'required',
            'title' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $subchapter->uuid = $input['uuid'];
        $subchapter->thumbnail = $input['thumbnail'];
        $subchapter->title = $input['title'];
        $subchapter->content = $input['content'];
        $subchapter->save();


        return $this->sendResponse($subchapter->toArray(), 'Subchapter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubChapter $subchapter)
    {
        $subchapter->delete();
        return $this->sendResponse($subchapter->toArray(), 'Subchapter deleted successfully.');
    }
}
