<?php

namespace App\Mail;

use App\Client;
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
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Client $client, Image $image)
    {
        $this->client = $client;
        $this->image = $image;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('templates.email')
            ->with([
                'clientName' => $this->client->nome,
                'clientCompany' => $this->client->empresa,
                'imageName' => $this->image->url
            ]);
    }
}
