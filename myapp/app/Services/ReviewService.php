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
use App\Seller;
use Mail;
use Illuminate\Support\Facades\Log;

class ReviewService extends ServiceProvider
{
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public static function getSeller()
    {
        try{
            $seller = Seller::join('seller_type','seller_type.id','sellers.seller_type_id')->select('sellers.id','sellers.name', 'sellers.email', 'sellers.phone', 'sellers.address', 'sellers.website', 'seller_type.name as type')->get();
            return response()->json($seller);
        } catch(\Exception $e){
            return response()->json([
                'status' => 400,
                'error' => $e->getTrace()
                
            ]);
        }
    }


    //Email
    public static function sendEmail(Request $request,$id)
    {
        
        $rules = [
            'email' => 'required',
            'body' => 'required',
            'subject' => 'required'
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
                'to'   => $request->input('email'),
                'name'   => $seller->name,
                'from'   => $seller->email,  
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
                    'description' => "Email Sent",
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
