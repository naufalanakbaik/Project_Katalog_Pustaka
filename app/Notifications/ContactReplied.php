<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactReplied extends Notification
{
    use Queueable;

    protected $contact;

    /**
     * Terima data contact yang dibalas
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Channel notifikasi (DATABASE)
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Data yang disimpan ke tabel notifications
     */
    public function toDatabase($notifiable)
    {
        return [
            'contact_id' => $this->contact->id,
            'message'    => 'Pesan Anda telah dibalas oleh admin.',
            'preview'    => \Illuminate\Support\Str::limit($this->contact->reply, 60),
            'contact_id' => $this->contact->id,
        ];
    }
}
