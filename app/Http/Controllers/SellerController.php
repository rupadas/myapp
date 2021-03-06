<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Vehicle;
use Validator;
use Carbon\Carbon;
use App\Http\Requests;
use \stdClass;
use App\Seller;
use Mail;
use Illuminate\Support\Facades\Log;
use App\Services\SellerService;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $sellers = Seller::with('sellerType')->get(array('id','name', 'seller_type_id'));
            return response()->json([
                'status'=> '200', 
                'data'=> $sellers
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
        //
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

    public function sendEmail(Request $request, $id) {

        $rules = [
            'body' => 'required',
            'subject' => 'required',
            'from' => 'required'
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
            $seller = Seller::find($id);
            $data = [
                'to'   => $seller->email,
                'name'   => $seller->name,
                'from'   => $request->input('from'),  
                'subject' => $request->input('subject'),
                'body'    => $request->input('body')
            ];
            try {
                Mail::send('email.seller',['data' => $data], function($message) use ($data) {
                    $message->from($data['from']);
                    $message->to($data['to'],  $data['name'])->subject( $data['subject']);
                });
                return response()->json(
                [
                    'status' => '200',
                    'message' => "Email Sent",
                ]);
            } catch(\Exception $e) {
                return response()->json(
                [
                    'status' => '400',
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
