<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Vehicle;
use Validator;
use Carbon\Carbon;
use App\Http\Requests;
use \stdClass;
use App\Type;
use App\Services\VehicleService;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vehicles = Vehicle::with('type')->get();
            foreach ($vehicles as $vehicle) {
                $vehicle->displayImage = $vehicle->displayImage();
            }
            return response()->json([
                'status'=> '200', 
                'data'=>$vehicles
            ]);
        } catch(\Exception $e){
            return response()->json([
                'status' => 400,
                'error' => $e->getTrace()
            ]);
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $vehicle = Vehicle::with(array('type','seller','reviews','images'))->where('id', $id)->get();
            return response()->json([
                'status'=> '200', 
                'data'=> $vehicle
            ]);
        } catch(\Exception $e) {
            return response()->json(
            [
                'status' => '400',
                'error' => $e->getMessage(),
            ]);
        }
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


    //Search
    public function search(Request $request)
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
                $vehicles = Vehicle::with('type')
                                    ->where('vehicles.type_id', '=', $type_id)
                                    ->where(function($query) use ($q) {                         
                                        $query->orWhere('vehicles.meta_deta', 'LIKE', '%'. $q->meta_deta .'%');
                                        $query->orWhereBetween('vehicles.price', array($q->lower_range, $q->higher_range));
                                    })
                                    ->select('vehicles.id', 'vehicles.year', 'vehicles.make', 'vehicles.model', 'vehicles.price', 'type_id')
                                    ->get();
                foreach ($vehicles as $vehicle) {
                    $vehicle->displayImage = $vehicle->displayImage();
                }
            } catch(\Exception $e) {
                return response()->json(
                [
                    'status' => '400',
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return response()->json(
        [
            'status' => '200',
            'data' => $vehicles,
        ]);
    }

    public function reviews($id)
    {
        try {
            $vehicle = Vehicle::with(array('reviews'))->where('id', $id)->get();
            return response()->json([
                'status'=> '200', 
                'data'=>$vehicle
            ]);
        } catch(\Exception $e) {
            return response()->json(
            [
                'status' => '400',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function getVehicleListView()
    {
        $controller = new VehicleController();
        $vehicles = $controller->index();
        if($vehicles->getData()->status == 200) {
            $data = $vehicles->getData()->data;
            return view('vehicle', ['data' => $data]);
        }
    }

    public function getVehicleSearchListView(Request $request)
    {
        $controller = new VehicleController();
        $vehicles = $controller->search($request);
        if($vehicles->getData()->status == 200) {
            $data = $vehicles->getData()->data;
            return view('vehicle-search', ['data' => $data]);
        }
    }

    public function getVehicleDetailsView($id)
    {
        $controller = new VehicleController();
        $vehicles = $controller->show($id);
        if($vehicles->getData()->status == 200) {
            $data = $vehicles->getData()->data;
            return view('vehicle-details', ['data' => $data]);
        }
    }
}
