<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
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
            'image' => 'mimes:jpeg,jpg,gif,png',
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
            $email->body = $request->input('body');

            if(Input::hasFile('image')) {
                $dir = 'uploads/email_images';
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $fileName = str_random(50) . '_' . date('Y_m_d') . '.' . $extension;
                $request->file('image')->move($dir, $fileName);
                $email->image = $fileName;
            }

            $email->save();

            return redirect('emails')->with('success','E-mail '. $email->name .' criado com sucesso!');
        }

    }

    /**
     * @param Email $email
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Email $email)
    {
        return view('emails.show',compact('email'));
    }


    /**
     * @param Email $email
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Email $email)
    {
        return view('emails.edit', compact('email'));
    }


    /**
     * @param Request $request
     * @param Email $email
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Email $email)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:emails,id|max:255',
            'subject' => 'required|max:70',
            'body' => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }  else {
            $email->update($request->all());
            return redirect('emails')->with('success', 'E-mail '. $request->name .' atualizado com sucesso!');
        }
    }


    /**
     * @param Email $email
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Email $email)
    {
        $email = Email::find($email->id);

        $imageName = $email->image;

        $image_path = "uploads/email_images/".$imageName;

        if(File::exists($image_path)) {
            File::delete($image_path);
            $email::destroy($email->id);
            return redirect()->route('emails.index')->with('success','E-mail excluído com sucesso!');
        } else {
            return redirect('emails.index')->with('fail','Erro ao excluír e-mail!');
        }


    }

}
