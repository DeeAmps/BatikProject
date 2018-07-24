@extends('layout.app')
@section('content')
    <div class="container" style="margin-bottom: 25px">
        <h1 class="text-center">Pending Orders</h1>
        <p class="lead text-center">Click on the order image to reveal Order Details</p>
        <hr>
        @if(count($orders) > 0)
            @foreach($orders as $order => $value)
                <div id="accordion">
                    <div class="card" style="margin-bottom: 15px">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#{{ $order }}" aria-expanded="true" aria-controls="collapseOne">
                                    PHONE NUMBER - {{ $order }}
                                </button>
                                <button onclick="markCompleted({{ $order }})" style="margin-left: 55%" class="btn btn-success">
                                    Mark all as Completed
                                </button>
                                </h5>
                            </div>

                            <div id="{{ $order }}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    @foreach($value as $prop)
                                        <img style="cursor: pointer" onclick="showName('{{$prop->name}}', '{{ $prop->created_at }}')" width="115px" height="115px" src="{{ asset("images/onSale/" . $prop->order_path) }}" alt="{{$prop->name}}">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                </div>
            @endforeach
        @else
            <div id="accordion">
                <div class="card" style="margin-bottom: 15px">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                        </h5>
                    </div>

                    <div class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <h3 class="text-center">No Pending Orders</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section("adminScript")
    <script>
        function showName(name, date){
            var dt = new Date(date);
            alertify.alert("Order Details", name + " placed the order on " + dt.toUTCString());
        }

        function encrypt(timeStamp){
            var st = timeStamp + 20 + 585 + 2014;
            return sha512(st.toString())

        }

        function markCompleted(phoneNumber){
            var timeStamp = new Date().getMilliseconds();
            alertify.confirm('Order Completed?', 'Mark Order from ' + phoneNumber + ' as completed?', function(){
                    $.ajax({
                        type: "POST",
                        url: "/api/completed",
                        data: {
                            phoneNumber: phoneNumber,
                            timeStamp: timeStamp,
                            Crypt: encrypt(timeStamp)
                        },
                        success: function(data){
                            if(data.success){
                                alertify.alert("Success", "Order marked as completed!");
                                setTimeout(function(){
                                    location.reload();
                                }, 2000)

                            }
                            else{
                                alertify.alert("Error", "Server Error! Please Contact Support");
                            }
                        },
                        fail: function(xhr, textStatus, errorThrown){
                            alertify.alert("Error", "Server Error! Please Contact Support");
                        },
                        dataType: "json"
                    });
                }
                , function(){
                    return
                });

        }
    </script>

@endsection
