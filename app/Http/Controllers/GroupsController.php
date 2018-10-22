<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use JavaScript;
use Validator;

class GroupsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $groups = Group::all();
        return view('groups.index',compact('groups'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:groups|max:70',
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $group = new Group();
            $group->name = $request->input('name');
            $group->save();

            return redirect('groups')->with('success','Grupo '. $group->name .' criado com sucesso!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);
        return view('groups.show', compact('group'));
    }

    /**
     * @param Group $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
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
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }  else {
            $group = Group::findOrFail($id);
            $group->name = $request->name;
            $group->save();
            return redirect('groups')->with('success', 'Grupo '. $group->name .' atualizado com sucesso!');
        }
    }

    /**
     * @param Group $group
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Group $group)
    {
        try {
            $group = Group::findOrFail($group->id);
            $group->delete();
            return redirect()->route('groups.index')->with('success','Grupo '. $group->name .' deletado com sucesso');
        } catch(\Exception $exception){
            return redirect()->route('groups.index')->with('fail','Grupo '. $group->name .' não pode ser removido pois existem clientes neste grupo!');
        }
    }
}
