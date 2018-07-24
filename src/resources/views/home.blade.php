@extends('layout.app')
@section('content')
    <div class=" mt-3 mb-4" style="margin-left: 10px; margin-right: 10px">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header bg-primary text-white text-uppercase text-center">
                        <i class="fa fa-trophy"></i> Our products
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($data as $sale)
                                <div class="col-sm" style="margin-top: 25px">
                                    <div class="card simpleCart_shelfItem">
                                        <img class="card-img-top" style="height: 250px !important;  ; width: 200px !important;" src="{{ asset("images/onSale/" . $sale->path) }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title text-center item_price">GHC {{ $sale->price }}</h4>
                                            <div class="row">
                                                <div class="col">
                                                    <button onclick="openModal('{{ asset("images/onSale/" . $sale->path) }}')" class="btn btn-danger btn-block viewImage"><i class="fa fa-eye"></i>View</button>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <button onclick="addToCart('{{ $sale }}')" class="btn btn-success btn-block item_add"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection