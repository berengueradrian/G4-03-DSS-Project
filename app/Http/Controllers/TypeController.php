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

    public function create(Request $data)
    {
        $type = Type::create([
            'name' => $data->name,
            'description' => $data->email,
        ]);

        return response()->json(['success' => true, 'type' => $type]);
    }

    public function delete(Type $type)
    {
        if (Type::whereId($type->id)->count()) {
            $type->delete();
            return response()->json(['success' => true, 'type' => $type]);
        }
        return response()->json(['success' => false]);
    }

    public function update(Request $request, Type $type)
    {

        $newType = Type::find($type->id);
        $newType->name = $request->name;
        if ($request->filled('description')) {
            $newType->description = $request->description;
        }

        $newType->save();
    }

    public function sortByExclusivity(Request $request)
    {
        if ($request->sortByExclusivity == 0) {
            $types = Type::orderBy('name', 'DESC')->paginate(2);
        } elseif ($request->sortByExclusivity == 1) {
            $types = Type::orderBy('name', 'ASC')->paginate(2);
        } else {
            $types = Type::paginate(2);
        }

        return view('types.list')->with('types', $types);
    }
}
