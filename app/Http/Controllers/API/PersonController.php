<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonCollection;
use App\Http\Resources\PersonResource;
use Illuminate\Support\Facades\Validator;
use App\Person;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PersonCollection(Person::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = new Person;
        $p->nome = $request->input('nome');
        $p->cpf = $request->input('cpf');

        $validator = Validator::make($request->all(), [
            "nome" => "required",
            "cpf" => "required|size:11|unique:people"
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    'message' => $validator->errors(),
                    'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY
                ]
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $p->save();
            return new PersonResource($p);
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
