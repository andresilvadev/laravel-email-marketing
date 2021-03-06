<?php

namespace App\Http\Controllers;

use App\Client;
use App\CsvData;
use Illuminate\Http\Request;
use Validator;

class ClientsController extends Controller
{
    /**
     * ClientsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $clients = Client::paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'empresa' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $client = new Client();
            $client->nome = $request->input('nome');
            $client->empresa = $request->input('empresa');
            $client->email = $request->input('email');
            $client->save();

            return redirect('clients')->with('success','Cliente '. $client->nome .' criado com sucesso!');
        }
    }

    /**
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Client $client)
    {
        return view('clients.show',compact('client'));
    }

    /**
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }


    /**
     * @param Request $request
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'empresa' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $client->update($request->all());
            return redirect('clients')->with('success','Client '. $request->nome .' autalizado com sucesso!');
        }
    }

    /**
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success','Cliente excluído com sucesso!');
    }

}
