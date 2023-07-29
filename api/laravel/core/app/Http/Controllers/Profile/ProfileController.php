<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\RequestAvatarUpdate;
use app\Services\Interfaces\IImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController
{
    public function __construct(protected IImageService $imageService )
    {
    }

    public function updateAvatar(RequestAvatarUpdate $request)
    {
        $user = Auth::user();
        if ($user==null)
        {
            return response()->json(['error' => "Unauthorized", 401]);
        }
        if ($request->hasFile('avatar')) {
            $avatarFile = $request->file('avatar');
            $fileName = 'new_avatar_' . time() . '.' . $avatarFile->getClientOriginalExtension();
            $url = $this->imageService->uploadImage($avatarFile, $fileName, 'avatars');
            $user->avatar = $url;
            $user->save();
            return response()->json(['avatarPath' => $url], 200);
        }
    }
}
