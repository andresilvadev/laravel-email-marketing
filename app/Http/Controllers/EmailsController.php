<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use Validator;

class EmailsController extends Controller
{
    /**
     * EmailsController constructor.
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
        $emails = Email::latest()->paginate(10);
        return view('emails.index', compact('emails'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
            'subject' => 'required|max:70',
            'body' => 'required',
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

            return redirect('emails')->with('success','E-mail '. $email->name .' criado com sucesso!');
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $email = Email::findOrFail($id);
        return view('emails.show', compact('email'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $email = Email::findOrFail($id);
        return view('emails.edit', compact('email'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
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

    public function config() {

    }
}
