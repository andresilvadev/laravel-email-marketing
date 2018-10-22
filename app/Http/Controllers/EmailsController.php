<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use Validator;

class EmailsController extends Controller
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
        $emails = Email::latest()->paginate(10);
        return view('emails.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emails.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:emails|max:255',
            'subject' => 'required|max:45',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            $email = new Email();

            $email->name = $request->input('name');
            $email->subject = $request->input('subject');

            $email->save();
            // $result = $email->save_content($request->content);
            return redirect('emails')->with('success','E-mail '. $email->name .' criado com sucesso!');
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
        $email = Email::findOrFail($id);
        return view('emails.show', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email = Email::findOrFail($id);
        $file_path = $email->path_to_email;
        $handle = fopen($file_path, 'r');
        $content = fread($handle,filesize($file_path));
        return view('emails.edit', compact('email', 'content'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:emails|max:255',
            'subject' => 'required|max:45',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }  else {

            $email = Email::findOrFail($id);
            $email->name = $request->name;
            $email->subject = $request->subject;
            $email->save();

            // $result = $email->save_content($request->getContent());

            return redirect('groups')->with('success', 'E-mail '. $email->name .' atualizado com sucesso!');
        }
    }


    /**
     * @param Email $email
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Email $email)
    {
        return redirect()->route('groups.index')->with('success','E-mail '. $email->name .' deletado com sucesso');
    }
}
