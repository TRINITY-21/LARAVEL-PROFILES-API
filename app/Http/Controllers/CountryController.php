<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CountryModel;
use Validator;
class CountryController extends Controller
{
    public function country(){

        return response()->json(Country::get(), 404);

    }

    public function CountryID($id){
        $country = Country::find($id);
            if(is_null($country)){

                return response()->json(["message" => "Request Not Found"], 404); // 404: Not Found by server but in API the endpoint is valid
            }
        return response()->json(Country::find($id), 200);
    }

    public function countrySave(Request $request){

        $rules = [
            'name' => 'required',
            'iso'  => 'required|min:3|max:3',

        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){

            return response()->json(["message" => "Request Not Found"], 401); // 401: bad request cos server could not understand the syntax
        }

        $country = Country::create($request->all());

        return response()->json($country, 201); // 201: created
    }

    public function countryEdit(Request $request, $id){
        //country and country model object
       
       $country = Country::find($id);
            if(is_null($country)){

                return response()->json(["message" => "Request Not Found"], 404); // 404: Not Found by server but in API the endpoint is valid
            }
            
            $country->update($request->all());

            return response()->json($country, 200); // 200 : success

    }


    public function countryDestroy(Request $request, $id){

        $country = Country::find($id);
        if(is_null($country)){

            return response()->json(["message" => "Request Not Found"], 404); // 404: Not Found by server but in API the endpoint is valid
        }
        
        $country->delete();

        return response()->json(null, 204); //204 : no content 
    }
}
