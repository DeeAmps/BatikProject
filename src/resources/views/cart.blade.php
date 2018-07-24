@extends("layout.app")
@section("title")
    <span> - Your Cart</span>
@endsection
@section("content")
    <div class=" mt-3 mb-4" style="margin-left: 10px; margin-right: 10px">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header bg-primary text-white text-uppercase text-center">
                        <i class="fa fa-shopping-cart"></i> Selected Products  <h3 >Total Amount : GHC <span style="color: red" id="cartTotal"></span></h3>
                        <span style="float: right" id="mainCartContainer"></span>
                    </div>
                    <div class="card-body">
                        <div id="cart" class="row">
                            <table class="table" id="cartTable" style="width:100%">
                                <tr>
                                    <th class="text-center"><h2>Product Image</h2></th>
                                    <th class="text-center"><h2>Price</h2></th>
                                    <th class="text-center"></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
    $(document).ready(function(){
        renderItems();
    })

    function removeItem(rem){
        //var item = JSON.parse(rem)
        //console.log(typeof(rem));
        var cart = JSON.parse(localStorage.getItem("cartItems"));
        var result = cart.filter(function(element){
            return element != JSON.stringify(rem);
        })
        localStorage.setItem("cartItems", JSON.stringify(result));
        $("#cartCount").text(result.length);
        renderItems()
    }
</script>
@section("script")
    <script>
    function renderItems(){
        $("#cartTable").html("");
        var cartItems = JSON.parse(localStorage.getItem("cartItems"));
        var total = 0;
        if(cartItems.length > 0){
            cartItems.forEach(function(item){
                let parsedItem = JSON.parse(item);
                total += parsedItem.price
                $("#cartTable").append("<tr style='margin-top: 15px'>" +
                    "<td class='text-center'><img style='border: 3px solid blue' width='95px' height='95px' src='/images/onSale/" + parsedItem.path  +"' + /></td>" +
                    "<td class='text-center'>GHC <strong>" + parsedItem.price + "</strong></td>" +
                    "<td class='text-center'><button onclick='removeItem(" + JSON.stringify(parsedItem) + ")' class='btn btn-danger removeItemButton'><i class='fa fa-trash'></i>" + "Remove" + "<span style='display: none'>"+ JSON.stringify(parsedItem) +"</span></button>" +
                    "</td>" +
                    "</tr>")
            })
            $("#cartTotal").text(total);
            $("#checkout").css("display", "inline");
        }
        else{
            $("#cartTable").append("<p class='text-center lead'>You have no Items in your Cart</p>");
            $("#cartTotal").text("0");
            $("#checkout").css("display", "none");
        }
    }
</script>
@endsection
