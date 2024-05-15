<?php

namespace App\Observers;

use App\Models\Document;
use App\Jobs\SendEmailToAllUsers;
use App\Jobs\SendEmailToAllFollowers;
use App\Http\Traits\NotificationTrait;
use App\Jobs\AttachNotificationTOUser;

class DocumentObserver
{
    use NotificationTrait;
    /**
     * Handle the Document "created" event.
     */
    public function created(Document $document): void
    {
        $content = "A new Document titled '{$document->title}' has been added to '{$document->category->name}' category by '{$document->user->full_name}'.";
        $notification = $document->notifications()->create([
            'message' => $content,
        ]);
        AttachNotificationTOUser::dispatch($notification);

        $this->sendNotification('new notification',$content);
        SendEmailToAllFollowers::dispatch($document,$content);
    }

    /**
     * Handle the Document "updated" event.
     */
    public function updated(Document $document): void
    {
        //
    }

    /**
     * Handle the Document "deleted" event.
     */
    public function deleted(Document $document): void
    {
        //
    }

    /**
     * Handle the Document "restored" event.
     */
    public function restored(Document $document): void
    {
        //
    }

    /**
     * Handle the Document "force deleted" event.
     */
    public function forceDeleted(Document $document): void
    {
        //
    }
}
