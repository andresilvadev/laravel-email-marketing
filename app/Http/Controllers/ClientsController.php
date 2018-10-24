<?php

namespace App\Http\Controllers;

use App\Client;
use App\Group;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JavaScript;
use Validator;

class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(10);

        JavaScript::put([
            'url' => url('clients').'/',
        ]);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        return view('clients.create',compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:groups|max:70',
            'last_name' => 'required',
            'email' => 'required',
            'company' => 'required',
            'group_id' => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $client = new Client();
            $client->name = $request->input('name');
            $client->last_name = $request->input('last_name');
            $client->email = $request->input('email');
            $client->company = $request->input('company');
            $client->group_id = $request->input('group_id');
            $client->save();

            return redirect('clients')->with('success','Cliente '. $client->name .' criado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $groups = Group::all();
        return view('clients.edit', compact('client', 'groups'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:groups|max:70',
            'last_name' => 'required',
            'email' => 'required',
            'company' => 'required',
            'group_id' => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $client = Client::findOrFail($id);
            dd($client);
            $client->name = $request->name;
            $client->last_name = $request->last_name;
            $client->email = $request->email;
            $client->company = $request->company;
            $client->group_id = $request->group_id;
            $client->update();

            return redirect('clients')->with('success','Cliente '. $client->name .' autalizado com sucesso!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cliente = Client::findOrFail($id);
        } catch(\Exception $exception){
            dd($exception);
            $errormsg = 'No Customer to de!' . $exception->getCode();
            return Response::json(['errormsg'=>$errormsg]);
        }

        $result = $cliente->delete();
        if ($result) {
            $cliente_response['result'] = true;
            $cliente_response['message'] = "Customer Successfully Deleted!";
        } else {
            $cliente_response['result'] = false;
            $cliente_response['message'] = "Customer was not Deleted, Try Again!";
        }
        return json_encode($cliente_response, JSON_PRETTY_PRINT);

    }
}
