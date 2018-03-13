<?php
namespace App\Services;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Vehicle;
use Validator;
use Carbon\Carbon;
use App\Http\Requests;
use \stdClass;
use App\Type;
use Illuminate\Support\Facades\Log;

class VehicleService extends ServiceProvider
{
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public static function getVehicles()
    {
        try {
            $vehicles = Vehicle::all();
            return response()->json($vehicles);
            return response()->json($vehicles);
        } catch(\Exception $e){
            return response()->json([
                'status' => 400,
                'error' => $e->getTrace()
            ]);
        }
    }

    //Search
    public static function search(Request $request)
    {
        $rules = [
            'type_id' => 'required|integer',
        ]; 
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(
            [
                'status' => '400',
                'error' => $errors->first()
            ]);
        } else {
            try {
                $q = new stdClass();
                $q->meta_deta = $request->input('key');
                $q->lower_range = $request->input('lower_range');
                $q->higher_range = $request->input('higher_range');
                $type_id = $request->input('type_id');
                $vehicles = Vehicle::join('types', 'vehicles.type_id', 'types.id')
                                    ->where('vehicles.type_id', '=', $type_id)
                                    ->where(function($query) use ($q) {                         
                                        $query->orWhere('vehicles.meta_deta', 'LIKE', '%'. $q->meta_deta .'%');
                                        $query->orWhereBetween('vehicles.price', array($q->lower_range, $q->higher_range));
                                    })
                                    ->select('vehicles.id', 'vehicles.year', 'vehicles.make', 'vehicles.model', 'types.name as type')
                                    ->get();
            } catch(\Exception $e) {
                return response()->json(
                [
                    'status' => '400',
                    'error' => $e->getMessage(),
                ]);
            }
        }
        return response()->json($vehicles);
    }
    
    //Reviews
    public static function reviews($id)
    {
        try {
            $vehicle = Vehicle::find($id);
            $type = Type::find($vehicle->type_id);
            $vehicle->type= $type->name;
            $vehicle->seller;
            $vehicle->reviews;
            return response()->json($vehicle);
        } catch(\Exception $e) {
            return response()->json(
            [
                'status' => '400',
                'error' => $e->getMessage(),
            ]);
        }
    }

    //Get dEtails of one Vehicles
    public static function getVehicle($id)
    {
        try {
            $vehicle = Vehicle::find($id);
            $type = Type::find($vehicle->type_id);
            $vehicle->type= $type->name;
            $vehicle->seller;
            $vehicle->images;
            return response()->json($vehicle);
        } catch(\Exception $e){
            return response()->json([
                'status' => 400,
                'error' => $e->getTrace()
            ]);
        }
    }
}
