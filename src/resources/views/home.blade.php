@extends('layout.app')
@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading"><strong>Company Name</strong></h1>
            <hr>
            <img style="height: 320px !important;" class="d-block w-100" src=" {{asset('images/carousel/3.jpeg') }}" alt="">
            <hr>
            <p class="lead text-muted mb-0">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
            </p>

        </div>
    </section>
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
                                    <div class="card">
                                        <img class="card-img-top" style="height: 250px !important;  ; width: 200px !important;" src="{{ asset("images/onSale/" . $sale->path) }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title text-center"><a href="product.html" title="View Product">GHC {{ $sale->price }}</a></h4>
                                            <div class="row">
                                                <div class="col">
                                                    <button onclick="openModal('{{ asset("images/onSale/" . $sale->path) }}')" class="btn btn-danger btn-block viewImage"><i class="fa fa-eye"></i>View</button>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="cart.html" class="btn btn-success btn-block"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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