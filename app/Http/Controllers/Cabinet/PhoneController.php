<?php

namespace App\Http\Controllers\Cabinet;

use App\Services\Sms\SmsSender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

class PhoneController extends Controller
{

    public function request(Request $request, SmsSender $sms)
    {
        $user = Auth::user();


        try {
            $token = $user->requestPhoneVerification(Carbon::now());
            $sms->send($user->phone, $token);
            //dd($sms->getMessages());
        } catch (\DomainException $e) {
            $request->session()->flash('error', $e->getMessage());
        }

        return redirect()->route('cabinet.profile.phone');
    }

    public function form()
    {
        $user = Auth::user();

        return view('cabinet.profile.phone', compact('user'));
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        try {
            $user->verifyPhone($request['token'], Carbon::now());
        } catch (\DomainException $e) {
            return redirect()->route('cabinet.profile.phone')->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.profile.home');
    }


    public function auth()
    {
        $user = Auth::user();
        if ($user->isPhoneAuthEnabled()) {
            $user->disablePhoneAuth();
        } else {
            $user->enablePhoneAuth();
        }
        return redirect()->route('cabinet.profile.home');
    }
}
