<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\UpdateRequest;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
        $user = $this->profileService->getProfile($name);
        return view('user.pages.profile.show', compact('user'));
    }

    public function comments($name)
    {
        $user = $this->profileService->getProfile($name);
        return view('user.pages.profile.comments', compact('user'));
    }

    public function posts($name)
    {
        $user = $this->profileService->getProfile($name);
        return view('user.pages.profile.posts', compact('user'));
    }

    public function edit($name)
    {
        $user = $this->profileService->getProfile($name);
        return view('user.pages.profile.edit', compact('user'));
    }

    public function update(UpdateRequest $request, $name)
    {
        $this->profileService->updateProfile($request, $name);
        return redirect()->route('profile.index', $request['name'])->with('success', 'Профиль изменен');
    }

}
