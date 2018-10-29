<?php

namespace App\Http\Controllers;

use App\Email;
use App\Group;
use App\Image;
use Illuminate\Http\Request;
use JavaScript;

class SendController extends Controller
{

    /**
     * SendController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $id
     * Send email for only one user
     */
    public function send_email($id)
    {
        $client = \App\Client::findOrFail($id);
        \Mail::to($client)->send(new \App\Mail\Newsletter($client));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * Send email for all clients
     */
    public function send_all()
    {
        $clients = \App\Client::all();
        $count = 0;

        if($clients->count() > 0) {
            foreach ($clients as $client) {
                $client = \App\Client::findOrFail($client->id);
                $image = \App\Image::findOrFail('1'); // Enviando manualmente a imagem id
                \Mail::to($client)->send(new \App\Mail\Newsletter($client, $image));
                $count++;
            }

            return redirect('home')->with('success','Enviado '. $count . ' e-mails com sucesso para sua lista de clientes');
        } else {
            return redirect('home')->with('fail','Não existem clientes cadastrados para envio de e-mails');
        }
    }

}
