<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{

    public function get(Type $type)
    {
        return view('types.details')->with('type', $type);
    }

    public function getAll()
    {
        $types = Type::paginate(2);
        return view('types.list')->with('types', $types);
    }

    //TODO: el update va raro en la forma de pedir datos
    //TODO: si la exclusivity es muy top cagaste

    public function store(Request $data)
    {
        $data->validate([
            'name' => 'required|max:50|unique:types,name',
            'description' => 'max:50',
            'exclusivity' => 'required|gte:0|numeric'
        ]);

        Type::create([
            'name' => $data->name,
            'description' => $data->description,
            'exclusivity' => $data->exclusivity
        ]);

        return back();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'iddelete' => 'required|exists:types,id'
        ]);
        $type = Type::find($request->iddelete);
        $type->delete();
        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_update' => 'required|exists:types,id',
        ]);
        $newType = Type::find($request->id_update);
        if ($request->filled('name_update')) {
            $newType->name = $request->name_update;
        }
        if ($request->filled('description_update')) {
            $request->validate([ //TODO: mirar
                'description_update' => 'max:50'
            ]);
            $newType->description = $request->description_update;
        }
        if ($request->filled('exclusivity_update')) {
            //TODO: FIX not working if string? 
            //TODO: hay que poner estos errores en el list y update errors!!
            $request->validate([
                'exclusivity_update' => 'numeric'
            ]);
            $newType->exclusivity = $request->exclusivity_update;
        }

        $newType->update();
        return back();
    }

    public function sortByExclusivity(Request $request)
    {
        if ($request->sortByExclusivity == 0) {
            $types = Type::orderBy('exclusivity', 'ASC')->paginate(2);
        } elseif ($request->sortByExclusivity == 1) {
            $types = Type::orderBy('exclusivity', 'DESC')->paginate(2);
        } else {
            $types = Type::paginate(2);
        }

        return view('types.list')->with('types', $types);
    }

    /*public function sortByCount(Request $request)
    {
        IT WORKS BUT CANT PAGINATE BTW
        $types = Type::all()->toArray();
        //How to paginate array laravel
        if ($request->sortByCount == 0) {
            usort($types, function ($first, $second) {
                if ($first['count'] < $second['count']) {

                    return 1;
                }
                return -1;
            });
        } elseif ($request->sortByCount == 1) {
            usort($types, function ($first, $second) {
                if ($first['count'] < $second['count']) {
                    return -1;
                }
                return 1;
            });
        } else {
            $types = Type::paginate(2);
        }

        return view('types.list')->with('types', $types);
    }*/
}
