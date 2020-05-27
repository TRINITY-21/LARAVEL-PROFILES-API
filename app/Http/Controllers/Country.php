<?php

namespace App\Http\Controllers;

use App\CountryModel;
use Validator;
use Illuminate\Http\Request;

class Country extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $countryList = CountryModel::paginate(10);
        return response()->json($countryList, 404);
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
        $rules = [
            'name' => 'required',
            'iso'  => 'required|min:3',

        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){

            return response()->json(["message" => "Request Not Found"], 401); // 401: bad request cos server could not understand the syntax
        }

        $country = CountryModel::create($request->all());

        return response()->json($country, 201); // 201: created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = CountryModel::find($id);
            if(is_null($country)){

                return response()->json(["message" => "Request Not Found"], 404); // 404: Not Found by server but in API the endpoint is valid
            }
        return response()->json(CountryModel::find($id), 200);
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
    public function update(Request $request, $id)
    {
        $country = CountryModel::find($id);
            if(is_null($country)){

                return response()->json(["message" => "Request Not Found"], 404); // 404: Not Found by server but in API the endpoint is valid
            }
            
            $country->update($request->all());

            return response()->json($country, 200); // 200 : success
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = CountryModel::find($id);
        if(is_null($country)){

            return response()->json(["message" => "Request Not Found"], 404); // 404: Not Found by server but in API the endpoint is valid
        }
        
        $country->delete();

        return response()->json(null, 204); //204 : no content 
    }
}
