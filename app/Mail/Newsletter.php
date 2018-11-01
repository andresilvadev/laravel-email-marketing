<?php

namespace App\Mail;

use App\Client;
use App\Email;
use App\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Client
     */
    private $client;
    /**
     * @var Image
     */
    private $image;
    /**
     * @var Email
     */
    private $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Client $client, Email $email)
    {
        $this->client = $client;
        $this->email = $email;
        //$this->image = $image;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('templates.newsletter')
            ->with([
                'clientName' => $this->client->nome,
                'clientCompany' => $this->client->empresa,
                'emailName' => $this->email->name,
                'emailSubject' => $this->email->subject,
                'emailBody' => $this->email->body,
                'emailImage' => $this->email->image,
            ]);
    }
}
