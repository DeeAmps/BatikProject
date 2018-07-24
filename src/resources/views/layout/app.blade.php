<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Company') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <style>
        label, input { display:block; }
        input.text { margin-bottom:12px; width:95%; padding: .4em; }
        fieldset { padding:0; border:0; margin-top:25px; }
        h1 { font-size: 1.2em; margin: .6em 0; }
        div#users-contain { width: 350px; margin: 20px 0; }
        div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
        div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
        .ui-dialog .ui-state-error { padding: .3em; }
        .validateTips { border: 1px solid transparent; padding: 0.3em; }
    </style>
</head>
<body>
<div id="dialog" style="display: none" title="Check Out">
    <p class="validateTips">Please fill the fields and will be get back to you.</p>

    <form id="checkoutForm" method="post" action="">
        {{csrf_field()}}
        <fieldset>
            <label for="name">Name</label>
            <input required type="text" name="name" id="name"placeholder="John Doe" class="text ui-widget-content ui-corner-all">
            <label for="email">Phone Number</label>
            <input required type="text" name="phone"  placeholder="0241234321" class="text ui-widget-content ui-corner-all">
            <!-- Allow form submission with keyboard without duplicating the dialog button -->
            <input id="cartInput" type="hidden" name="cart">
            <button type="submit" class="btn btn-primary">Checkout</button>
            <button  type="button" onclick="closeDialog()" class="btn btn-danger">Cancel</button>
        </fieldset>
    </form>
</div>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">Company Name</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ (\Request::route()->getName() == 'home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url("/") }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ (\Request::route()->getName() == 'cart') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url("cart") }}">Cart</a>
                </li>
                <li class="nav-item {{ (\Request::route()->getName() == 'contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url("contact") }}">Contact</a>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto">
                @guest
                <li class="nav-item {{ (\Request::route()->getName() == 'login') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url("/login") }}">Login <span class="sr-only">(current)</span></a>
                </li>
                @else
                    <li class="nav-item {{ (\Request::route()->getName() == 'admin') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url("admin") }}">Orders</a>
                    </li>
                    @endguest
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a class="btn btn-success btn-sm ml-3" href="{{ url("cart") }}">
                    <i class="fa fa-shopping-cart"></i> Cart
                    <span id="cartCount" class="badge badge-light"></span>
                </a>
                <a id="checkout" onclick="proceedToCheckOut()" style="display: none" class="btn btn-warning btn-sm ml-3">
                    <i class="fa fa-check"></i> Check Out
                </a>
            </form>
        </div>
        <div class="my-2 my-lg-0" style="margin-left: 70px;">
            <ul class="navbar-nav mr-auto">
                @guest

                @else
                    <li class="nav-item dropdown">
                        <a style="color: #FFFFFF;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           Welcome, {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
            </ul>
        </div>
    </div>
</nav>
<div>
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading"><strong>Company Name @yield('title')</strong></h1>
            <hr>
            @include("includes.flash")
            <img style="height: 320px !important;" class="d-block w-100" src=" {{asset('images/carousel/3.jpeg') }}" alt="">
            <hr>
            <p class="lead text-muted mb-0">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
            </p>

        </div>
    </section>
    @yield('content')
</div>

<div id="my-popup" class="mfp-hide white-popup">
</div>

<footer class="text-light">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-4 col-xl-3">
                <h5>About</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <p class="mb-0">
                    Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.
                </p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3">
                <h5>Contact</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <ul class="list-unstyled">
                    <li><i class="fa fa-home mr-2"></i> My company</li>
                    <li><i class="fa fa-envelope mr-2"></i> email@example.com</li>
                    <li><i class="fa fa-phone mr-2"></i> + 33 12 14 15 16</li>
                </ul>
            </div>
            <div class="col-12 copyright mt-3">
                <p class="float-left">
                    <a href="#">Back to top</a>
                </p>
            </div>
        </div>
    </div>
</footer>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
<script src="{{ asset("js/sha512.min.js")  }}"></script>
<script src="{{ asset("js/magnific-popup.min.js")  }}"></script>
@yield("script")
<script>
    $("#checkoutForm").submit(function(){
        var cart = {};
        var total = 0;
        var items = JSON.parse(localStorage.getItem("cartItems"))
        items.forEach(function(item){
            let parsedItem = JSON.parse(item);
            cart[parsedItem.path] = parsedItem.price;
        })
        $("#cartInput").val(JSON.stringify(cart))
        return true
    })

    $(document).ready(function(){
        $('.viewImage').magnificPopup({
            type: 'image' // this is a default type
        });

        var status = "{!! session("status") !!}";
        if(status != ""){
            $("#cartTable").append("<p class='text-center lead'>You have no Items in your Cart</p>");
            localStorage.removeItem("cartItems");
        }

       var cartItems = localStorage.getItem("cartItems");
       var attr = "";
       if(cartItems == null || JSON.parse(cartItems).length == 0){
           cartItems = [];
           $("#cartCount").text(cartItems.length);
           attr = "none";
           localStorage.setItem("cartItems", JSON.stringify(cartItems));
       }
       else{
           $("#checkout").css("display", "inline");
           attr = "inline";
           addToCart("")
       }
        $("#checkout").css("display", attr);
    });

        $('.viewImage').magnificPopup({
            type: 'image' // this is a default type
        });

    function clearStorage(){
        console.log("HERE");
    }

    function addToCart(cart){
        var cartItems = JSON.parse(localStorage.getItem("cartItems"));
        if(cart !== ""){
            cartItems.push(cart);
            $("#checkout").css("display", "inline");
        }
        $("#cartCount").text(cartItems.length);
        localStorage.setItem("cartItems", JSON.stringify(cartItems))
    }

    function closeDialog(){
        $("#dialog").dialog("close");
    }

    function proceedToCheckOut(){
        var cartItems = JSON.parse(localStorage.getItem("cartItems"));
        if(cartItems.length <= 0){
            ("#checkout").css("display", "none");
        }
        else{
            $("#dialog").dialog({
                height: 400,
                width: 400
            });
        }

    }
    @yield("contact_script")
</script>
@yield("adminScript")
</body>
</html>
