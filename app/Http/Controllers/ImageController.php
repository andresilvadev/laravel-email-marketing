<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view("imagens.index", compact('images'));
    }
    public function create()
    {
        return view('imagens.create');
    }

    public function store(Request $request)
    {
        $file = $request->file('url');

        $validExtensions = ['jpeg','jpg','png','gif'];

        if(!is_null($file) and $file->isValid() and in_array($file->extension(), $validExtensions)) {

            $name = $file->getClientOriginalName(); // Recupera nome original do arquivo
            $data = $request->all(); // Recupera todos os dados da requisição
            $file->storeAs('uploads/imagens', $name); // Salva a imagem na pasta public/uploads/imagens
            $data['url'] = $name;  // Atualiza a variavel data com o nome do arquivo
            Image::create($data);

            return redirect('imagens')->with('success','Imagem salva com sucesso!');
        } else {
            // File is invalid
            return redirect('imagens/create')->with('fail','Erro ao enviar imagem!');
        }
    }
}
