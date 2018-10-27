<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::orderBy('created_at', 'desc')->paginate(8);
        return view("imagens.index", compact('images'));
    }

    public function create()
    {
        return view('imagens.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'url' => 'required'
        ];

        $this->validate($request, $rules);

        $file = $request->file('url');

        $validExtensions = ['jpeg','jpg','png','gif'];

        if(!is_null($file) and $file->isValid() and in_array($file->extension(), $validExtensions)) {
            // Achei esse modo mais organizado
            $image = new Image();
            $dir = 'uploads/imagens';
            $extension = strtolower($request->file('url')->getClientOriginalExtension()); // Pega a extensão da imagem e força para caixa baixa
            $fileName = str_random(50) . '_' . date('Y_m_d') . '.' . $extension; // Renomea a imagem com string random em 50 mais a data ex: hashCom50Carateres_2018_10_27
            $request->file('url')->move($dir, $fileName); // Salva a imagem na pasta public/uploads/imagem/nome_da_imagem.jpg

            $image->url = $fileName;
            $image->title = $request->title;
            $image->save();

            // Este outro modo tbm funciona bem

            // $name = $file->getClientOriginalName(); // Recupera nome original da imagem
            // $data = $request->all(); // Recupera todos os dados da requisição
            // $file->storeAs('uploads/imagens', $name); // Salva a imagem na pasta public/uploads/imagens
            // $data['url'] = $name;  // Atualiza a variavel data com o nome do arquivo
            // Image::create($data);

            return redirect('imagens')->with('success','Imagem salva com sucesso!');
        } else {
            // File is invalid
            return redirect('imagens/create')->with('fail','O arquivo não tem possuí extensão do tipo imagem! Os formatos aceitos são somente JPEG, JPG, PNG e GIF');
        }
    }

    public function destroy($id)
    {
        $image = Image::find($id); // Localiza a imagem pelo id

        $imageName = $image->url;  // Recebe o nome completo da imagem com a extensão

        $image_path = "uploads/imagens/".$imageName; // Recebe o path completo da imagem com o nome e extensão

        if(File::exists($image_path)) {
            File::delete($image_path);
            Image::destroy($id);
            return redirect('imagens')->with('success','Imagem excluída com sucesso!');
        } else {
            return redirect('imagens')->with('fail','Erro ao excluír imagem!');
        }
    }
}
