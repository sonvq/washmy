<?php

namespace Modules\Authentication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Authentication\Entities\WasherCustomerForgot;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Authentication\Http\Requests\ResetCompleteRequest;
use Carbon\Carbon;
use Hash;
use Modules\Washer\Entities\Washer;
use Modules\Customer\Entities\Customer;

class AuthenticationController extends AdminBaseController
{   
    
    public function getResetComplete($type, $userId, $token)
    {                       
        return view('authentication::public.reset.complete');
    }

    public function postResetComplete($type, $userId, $token, ResetCompleteRequest $request)
    {
        if ($type == 'washer') {
            $object = Washer::where('id', $userId)->first(); 
            
        } else if ($type == 'customer') {
            $object = Customer::where('id', $userId)->first(); 
        } else {
            return redirect()->back()->withInput()
                    ->withError(trans('authentication::messages.invalid_reset_type'));
        }        
        
        if (!$object) {
            return redirect()->back()->withInput()
                ->withError(trans('authentication::messages.user_no_longer_exists'));
        }

        $key = $type . '_id';
        $forgotTokenObject = WasherCustomerForgot::where('status', WasherCustomerForgot::STATUS_PENDING)
                ->where($key, $userId)
                ->where('token', $token)->get();
        
        if (count($forgotTokenObject) == 0) {
            return redirect()->back()->withInput()
                    ->withError(trans('authentication::messages.invalid_reset_code'));
        }
        
        $input = $request->all();
        
        // Mark the token as completed
        WasherCustomerForgot::where('status', WasherCustomerForgot::STATUS_PENDING)
                ->where($key, $userId)
                ->where('token', $token)
                ->update([
                    'status' => WasherCustomerForgot::STATUS_COMPLETED,
                    'completed_at' => Carbon::now()
                ]);
        
        // Update new password to object
        $object->password = Hash::make($input['password']);
        $object->save();

        return redirect()->back()
            ->withSuccess(trans('authentication::messages.password_reset'));
    }
    
    
    public function getPaymentProcess(Request $request)
    {   
        $accessToken = $request->get('access_token');
        
        return view('authentication::public.payment-process', compact('accessToken'));
    }
}
