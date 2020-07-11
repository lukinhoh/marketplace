@extends('layouts.front')

@section('content')

    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dados para Pagamento</h2>
                    <hr>
                </div>
            </div>

            <form action="" method="post">
                @csrf
                
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Nome no Cartão</label>
                        <input type="text" name="card_name" class="form-control" placeholder="FULANO DA SILVA">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Número do Cartão</label>
                        <input type="text" name="card_number" class="form-control" placeholder="XXXX XXXX XXXX XXXX">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Mês de Expiração</label>
                        <input type="text" name="card_month" class="form-control" placeholder="01">
                    </div>
                    
                    <div class="col-md-4 form-group">
                        <label for="">Ano de Expiração</label>
                        <input type="text" name="card_year" class="form-control" placeholder="24">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 form-group">
                        <label for="">Código de Segurança</label>
                        <input type="text" name="card_cvv" class="form-control" placeholder="123">
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg">Efetuar Pagamento</button>
            </form>
        </div>
    </div>

@endsection