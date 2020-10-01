<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use Illuminate\Http\Request;

class CultureController extends Controller
{
    public function getAllCultures() {
        $cultures = Culture::get()->toJson(JSON_PRETTY_PRINT);
        return response($cultures, 300);
      }

      public function createCulture(Request $request) {
        request()->validate([

            'name' => ['required', 'string'],
            'country' => ['required', 'string']
        ]);

        $culture = new Culture;
        $culture->name = $request->name;
        $culture->country = $request->country;
        $culture->save();

        return response()->json([
        "message" => "culture record created"
          ], 201);
      }

      public function getCulture($id) {
        // logic to get a culture record goes here
        if (Culture::where('id', $id)->exists()) {
            $culture = Culture::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($culture, 200);
          } else {
            return response()->json([
              "message" => "culture not found"
            ], 404);
          }
      }


      public function updateCulture(Request $request, $id) {
        // logic to update a culture record goes here
        if (Culture::where('id', $id)->exists()) {
            $culture = Culture::find($id);
            $culture->name = is_null($request->name) ? $culture->name : $request->name;
            $culture->country = is_null($request->country) ? $culture->country : $request->country;
            $culture->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Culture not found"
            ], 404);

        }
      }

      public function deleteCulture ($id) {
        // logic to delete a culture record goes here
        if(Culture::where('id', $id)->exists()) {
            $culture = Culture::find($id);
            $culture->delete();

            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Culture not found"
            ], 404);
          }
        }


        public function searchCultureByName (Request $request){

            //   if ($SearchName = $request->name){
            //       $culture =Culture::select('*')
            //       ->from('cultures')
            //       ->where('name', '=', $SearchName)
            //       ->get()->toJson(JSON_PRETTY_PRINT);
            //       return response($culture, 200);
            //     }else{
            //             return response()->json([
            //               "message" => "Cultur not found"
            //             ], 404);
            //           }

            //         }


            if ($SearchName = $request->name){
                $culture =Culture::select('*')
                ->from('cultures')
                ->where('name', '=', $SearchName)
                ->where('name', 'LIKE', `$SearchName%`, 'OR')
                ->where('country', '=', $SearchName)
                ->get()->toJson(JSON_PRETTY_PRINT);
                return response($culture, 200);
              }else{
                      return response()->json([
                        "message" => "Culture not found"
                      ], 404);
                    }

                  }
}
