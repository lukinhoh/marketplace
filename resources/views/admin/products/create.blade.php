@extends('layouts.app')

@section('content')
    <h1>Criar Produto</h1>
    <form action="{{route('admin.products.store')}}" method="post">
        @csrf
        
        <div class="form-group">
            <label for="">Nome do Produto</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('description')}}">
            
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('phone')}}">

            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Conteúdo</label>
        <textarea name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{old('body')}}</textarea>

            @error('mobile_phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Preço</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('phone')}}">

            @error('price')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Slug</label>
            <input type="text" name="slug" class="form-control">
        </div>
        
        <div>
            <button type="submit"  class="btn btn-lg btn-success">Criar Produto</button>
        </div>
    </form>
@endsection
