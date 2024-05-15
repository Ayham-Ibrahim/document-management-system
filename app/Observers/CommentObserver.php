<?php

namespace App\Observers;

use App\Models\Comment;
use App\Http\Traits\NotificationTrait;

class CommentObserver
{ 
    use NotificationTrait;
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        $content ='New comment added to document: ' . $comment->document->title . 'by :' . $comment->user->full_name; 
        $comment->notifications()->create([
            'message' => $content,
        ]);
        $this->sendNotification('new notification',$content);
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        //
    }
}
