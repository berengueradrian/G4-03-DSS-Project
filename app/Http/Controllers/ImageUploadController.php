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
        $data = new User();
        $data->name = "marioasaooo";
        $data->email = "vengxskss2a@gmail.com";
        $data->password = "1123";
        if ($request->file('img_url')) {
            $file = $request->file('img_url');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('../public/uploadedByUsers'), $filename);
            $data['img_url'] = $filename;
            $data->img_url = $file;
        }
        $data->save();
        return view('profileSettings');
    }
}
