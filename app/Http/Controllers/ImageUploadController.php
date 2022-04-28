<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ImageUploadController extends Controller
{
    //Add image
    public function addImage()
    {
        return view('add_image');
    }
    //Store image
    public function storeImage(Request $request)
    {
        if ($request->file('img_url')) {
            //$filename = date('c') . $file->getClientOriginalName();
            //Con la linea comentada podemos sacar el timestamp de la hora que se ha subido, pero vmaos a simplificar
            $file = $request->file('img_url');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('../public/images'), $filename);
            $data['img_url'] = $filename;
        }
        return redirect()->route('home');
    }
}
