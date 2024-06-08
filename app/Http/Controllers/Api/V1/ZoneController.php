<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Zone;
use App\Http\Controllers\Controller;
use App\Models\areas;
use App\Models\cities;
use App\Models\countries;
use App\Models\states;
use Illuminate\Http\Request;
use Twilio\Rest\Pricing\V1\Messaging\CountryList;

class ZoneController extends Controller
{
    public function get_zones(Request $request)
    {
        return response()->json(Zone::where('status',1)->get(), 200);
    }

    public function countries_list(Request $request){
        return response()->json(countries::where('status',1)->get(), 200);
    }

    public function states_by_country($id){
        return response()->json(states::where('country_id',$id)->where('status',1)->get(), 200);
    }

    public function cities_by_state(){
        $id = 1;
        return response()->json(cities::where('state_id',$id)->where('status',1)->get(),200);
    }

    public function areas_by_city($id){
        return response()->json(areas::where('city_id',$id)->where('status',1)->get(),200);
    }
}
