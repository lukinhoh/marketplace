<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\ProductPhoto;

class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request)
    {
        $name = $request->get('photo_name');

        // Removo os arquivos
        if(Storage::disk('public')->exists($name))
        {
            Storage::disk('public')->delete($name);
        }

        // Removo a imagem do banco
        $removePhoto = ProductPhoto::where('image', $name);
        $removePhoto->delete();

        flash ('Imagem REMOVIDA com Sucesso!')->success();
        return redirect()->back();
    }
}
