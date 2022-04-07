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

    //TODO: El field exclusivity esta como optional en el texto pero es obligatorio!!!
    //TODO: Si de input metes una string muy larga peta todo
    //TODO: el create no va: SQLSTATE[HY000]: General error: 1364 Field 'exclusivity' doesn't have a default value (SQL: insert into `types` (`name`, `description`, `updated_at`, `created_at`) values (pruebas, the best, 2022-04-07 21:17:57, 2022-04-07 21:17:57))
    //TODO: el update va raro en la forma de pedir datos
    //TODO: el actual price no puede ser negativo

    public function store(Request $data)
    {
        $data->validate([
            'name' => 'required',
            'exclusivity' => 'required'
        ]);

        $type = Type::create([
            'name' => $data->name,
            'description' => $data->description,
            'exclusivity' => $data->exclusiviy
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
            $newType->description = $request->description_update;
        }
        if ($request->filled('exclusivity_update')) {
            //TODO: FIX not working if string?
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
