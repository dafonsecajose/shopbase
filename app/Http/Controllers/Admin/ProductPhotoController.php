<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductPhoto;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function removePhoto($id)
    {
        $photo = ProductPhoto::find('id', $id);

        if(Storage::disk('public')->exists($photo->image))
            Storage::disk('public')->delete($photo->image);

        //remove image database
        $productId = $photo->product_id;
        $photo->delete();

        flash('Imagem removida com sucesso!')->success();
        return redirect()->route('admin.products.edit', ['product' => $productId]);

    }
}
