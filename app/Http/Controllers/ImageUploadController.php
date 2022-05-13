<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ImageUploadController extends Controller
{
    //Store image
    public function storeImage(Request $request)
    {
        if ($request->file('img_url')) {
            //$filename = date('c') . $file->getClientOriginalName();
            //Con la linea comentada podemos sacar el timestamp de la hora que se ha subido para evitar que entre ellos se borren fotos, el problema es que por como esta construido el sistema ahora mismo no puede hacer upload y update con el mismo timestamp.
            $file = $request->file('img_url');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('../public/images'), $filename);
            $data['img_url'] = $filename;
            session()->flash('msg', 'Image uploaded correctly!');
        }
        return back();
    }
}
