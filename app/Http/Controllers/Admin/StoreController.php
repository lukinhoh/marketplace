<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    public function index()
    {
        $stores = \App\Store::paginate(10);

        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        $users = \App\User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();

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
    
    public function update(StoreRequest $request, $store)
    {
        $data = $request->all();

        $store = \App\Store::find($store);
        $store->update($data);

        flash('Loja ATUALIZADA com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);

        $products = \App\Product::where('store_id', $store->id);
        
        if ($products->count() > 0)
        {
            $products->delete();
        }

        $store->delete();

        flash('Loja REMOVIDA com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }
}
