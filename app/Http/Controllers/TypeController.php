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
        $types = Type::getAll();
        return view('types.list')->with('types', $types);
    }

    public function store(Request $data)
    {
        $data->validate([
            'name' => 'required|max:50|unique:types,name',
            'description' => 'max:50',
            'exclusivity' => 'required|gte:0|numeric|digits_between:1,8|unique:types,exclusivity'


        ]);
        Type::createType($data->name, $data->description, $data->exclusivity);
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
        $updates = ['name_update' => false, 'description_update' => false, 'exclusivity_update' => false];
        $request->validate([
            'id_update' => 'required|exists:types,id',
        ]);
        $newType = Type::find($request->id_update);
        if ($request->filled('name_update')) {
            $request->validate([
                'name_update' => 'unique:types,name|max:50',
            ]);
            $updates['name_update'] = $request->name_update;
        }
        if ($request->filled('description_update')) {
            $request->validate([
                'description_update' => 'max:50'
            ]);
            $updates['description_update'] = $request->description_update;
        }
        if ($request->filled('exclusivity_update')) {
            $request->validate([
                'exclusivity_update' => 'numeric|unique:types,exclusivity|gte:0|digits_between:1,8'
            ]);
            $updates['exclusivity_update'] = $request->exclusivity_update;
        }
        Type::updateType($updates, $newType);
        return back();
    }

    public function sortByExclusivity(Request $request)
    {
        $types = Type::sortingBy('exclusivity', $request->sortByExclusivity);
        return view('types.list')->with('types', $types);
    }
}
