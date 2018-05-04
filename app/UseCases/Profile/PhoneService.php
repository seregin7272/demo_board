<?php

namespace App\UseCases\Profile;

use App\Entity\User\User;
use App\Http\Requests\Auth\PhoneVerifyRequest;
use App\Services\Sms\SmsSender;
use Carbon\Carbon;

class PhoneService
{
    private $sms;

    /**
     * PhoneService constructor.
     * @param SmsSender $sms
     */
    public function __construct(SmsSender $sms)
    {
        $this->sms = $sms;
    }

    /**
     * @param $id
     */
    public function request($id)
    {
        $user = $this->getUser($id);

        $token = $user->requestPhoneVerification(Carbon::now());
        $this->sms->send($user->phone, 'Phone verification token: ' . $token);
    }

    /**
     * @param $id
     * @param PhoneVerifyRequest $request
     */
    public function verify($id, PhoneVerifyRequest $request)
    {
        $user = $this->getUser($id);
        $user->verifyPhone($request['token'], Carbon::now());
    }

    /**
     * @param $id
     * @return bool
     */
    public function toggleAuth($id): bool
    {
        $user = $this->getUser($id);
        if ($user->isPhoneAuthEnabled()) {
            $user->disablePhoneAuth();
        } else {
            $user->enablePhoneAuth();
        }
        return $user->isPhoneAuthEnabled();
    }

    private function getUser($id): User
    {
        return User::findOrFail($id);
    }
}
