<?php

namespace App\Observers;

use App\Models\Category;
use App\Jobs\SendEmailToAllUsers;
use App\Http\Traits\NotificationTrait;
use App\Jobs\AttachNotificationTOUser;

class CategoryObserver
{
    use NotificationTrait;
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        $message = "A new category titled '{$category->name}' has been added to Ayham's Document Management System.";
        $notification = $category->notifications()->create([
            'message' => $message,
        ]);
        // dd($notification);
        AttachNotificationTOUser::dispatch($notification);
        $this->sendNotification('new notification',$message);
        SendEmailToAllUsers::dispatch($message);
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        $message = "category titled '{$category->name}' has been updated by admin in Ayham's Document Management System.";
        SendEmailToAllUsers::dispatch($message);
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $message = "category titled '{$category->name}' has been deleted by admin in Ayham's Document Management System.";
        SendEmailToAllUsers::dispatch($message);
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
