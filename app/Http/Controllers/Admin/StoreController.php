<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return redirect()->route('admin.stores.create');
        }

        return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
        return view('admin.stores.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();

        if ($request->hasFile('logo'))
        {
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        if ($user->store()->count() == 1)
        {
            flash('Você já tem uma loja')->error();
        } else 
        {
            $store = $user->store()->create($data);
            flash('Loja CRIADA com Sucesso')->success();
        }

        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = \App\Store::find($store);

        return view('admin.stores.edit', compact('store'));
    }
    
    public function update(StoreRequest $request)
    {
        $data = $request->all();

        $store = auth()->user()->store;
        
        if ($request->hasFile('logo'))
        {
            if(Storage::disk('public')->exists($store->logo))
            {
                Storage::disk('public')->delete($store->logo);
            }
            
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store->update($data);

        flash('Loja ATUALIZADA com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy()
    {
        $store = auth()->user()->store;

        $products = $store->products()->get();

        foreach($products as $product)
        {
            $product->photos()->delete();
            $product->categories()->sync([]);
            $product->delete();
        }

        $store->delete();

        flash('Loja REMOVIDA com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }
}
