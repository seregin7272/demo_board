<?php

namespace App\Http\Controllers\Api\User;

use App\Entity\User\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileEditRequest;
use App\Http\Resources\User\ProfileResource;
use App\UseCases\Profile\ProfileService;
use Illuminate\Http\Request;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\User
 */
class ProfileController extends Controller
{
    private $service;

    /**
     * ProfileController constructor.
     * @param ProfileService $service
     */
    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return ProfileResource
     */
    public function show(Request $request)
    {
        return new ProfileResource($request->user());
    }

    /**
     * @param ProfileEditRequest $request
     * @return ProfileResource
     */
    public function update(Request $request)
    {
        dd($request);

        $this->service->edit($request->user()->id, $request);

        $user = User::findOrFail($request->user()->id);
        return new ProfileResource($user);
    }
}
