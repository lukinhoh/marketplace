@extends('layouts.app')

@section('content')
    <h1>Atualizar Produto</h1>
    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="">Nome do Produto</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">

            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$product->description}}">

            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Conteúdo</label>
            <textarea name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$product->body}}</textarea>

            @error('body')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Preço</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">

            @error('price')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Categorias</label>
            <select name="categories[]" class="form-control" multiple>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                        @if ($product->categories->contains($category))
                            selected
                        @endif
                    >{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Fotos do Produto</label>
            <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>

            @error('photos.*')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div>
            <button type="submit"  class="btn btn-lg btn-success">Atualizar Produto</button>
        </div>
    </form>

    <hr>

    <div class="row">
        @foreach ($product->photos as $photo)
            <div class="col-4 text-center">
                <img src="{{asset('storage/' . $photo->image)}}" alt="" class="img-fluid">
                
                <form action="{{route('admin.photo.remove')}}" method="post">
                    @csrf
                    <input type="hidden" name="photo_name" value="{{$photo->image}}">
                    
                    <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                </form>
            </div>
        @endforeach
    </div>

    <hr>

@endsection