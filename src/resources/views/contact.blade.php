@extends("layout.app")
@section("title")
    <span> - Contact Us</span>
@endsection

@section("content")
    <div class="container" style="margin-bottom: 25px">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Contact us.
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Phone Number</label>
                                <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Enter Phone Number" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your number with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="6" required></textarea>
                            </div>
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary text-right">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Address</div>
                    <div class="card-body">
                        <p>21st Street</p>
                        <p>Haatso Accra</p>
                        <p>Ghana</p>
                        <p>Email : email@example.com</p>
                        <p>Tel. 020 585 2014</p>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section("contact_script")
    <script>
        (function(){
            $("#checkout").css("display", "none");
        })
    </script>
@endsection