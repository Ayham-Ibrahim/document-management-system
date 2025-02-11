<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notificaton;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\NotificationResource;

class NotificatonController extends Controller
{
    use ApiResponseTrait;
    public function showUnreadNotification(){
        // $user_id = Auth::id();
        // $user = User::where('id', $user_id)->first();
        // $unreadNotifications = $user->notifications()->where('is_read', false)->get();
        $unreadNotifications = Notification::all();
        return $this->customeResponse(NotificationResource::collection($unreadNotifications),'Done',200);
    }


    public function markNotificationAsRead(Notification $notification){
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();
        $user->notifications()->updateExistingPivot($notification,['is_read'=>true]);
        return $this->customeResponse(new NotificationResource($notification),'Done',200);
    }
}
