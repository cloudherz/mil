<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Log;

class CleanupApplicationAttachments
{
    public function handle(MessageSent $event): void
    {
        $message = $event->message;

        $headers = $message->getHeaders();
        $appIdHeader = $headers->get('X-Application-Id');

        if (!$appIdHeader) {
            return;
        }

        $applicationId = $appIdHeader->getBodyAsString();

        $deleted = [];

        foreach ($message->getAttachments() as $attachment) {
            $body = $attachment->getBody();

            $path = null;
            if (method_exists($body, 'getPath')) {
                $path = $body->getPath();
            }

            if ($path && is_file($path) && is_writable($path)) {
                @unlink($path);
                $deleted[] = basename($path);
            }
        }

        Log::info('Application attachments cleaned up', [
            'application_id' => $applicationId,
            'deleted' => $deleted,
        ]);
    }
}
