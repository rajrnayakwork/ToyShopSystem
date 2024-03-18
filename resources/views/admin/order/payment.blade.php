@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container">
        <div class="py-3 text-center">
            <h2>Checkout form</h2>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <form method="POST" action="{{ route('order.storeOrUpdate') }}">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">{{ count($carts) }}</span>
                    </h4>
                    <div class="overflow-auto p-3 mb-4 bg-light"
                        style="max-width: 420px; max-height: 200px; min-height: 200px;">
                        <ul class="list-group mb-3">
                            <input type="hidden" value="{{ $total_amount = 0 }}">
                            @foreach ($carts as $index => $cart)
                                <input type="hidden"
                                    value="{{ $total_amount += $cart->product->price * $cart->quantity }}">
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ $index + 1 }}. {{ $cart->product->name }}</h6>
                                        <small class="text-muted">product Quantity : {{ $cart->quantity }}</small>
                                    </div>
                                    <span class="text-muted">Rs. {{ $cart->product->price }}</span>
                                </li>
                                <input type="hidden" name="cart[{{ $index }}][quantity]"
                                    value="{{ $cart->quantity }}">
                                <input type="hidden" name="cart[{{ $index }}][product_id]"
                                    value="{{ $cart->product->id }}">
                            @endforeach
                        </ul>
                    </div>
                    <div class="">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Summary</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Products Price
                                        <span>Rs. {{ $total_amount }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Shipping Charge
                                        <span>Rs. 0</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-1">
                                        <div>
                                            <strong>Total amount</strong>
                                        </div>
                                        <span><strong>Rs. {{ $total_amount }}</strong></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                @csrf
                <input type="hidden" name="total_amount" value="{{ $total_amount }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" name="first_name" class="form-control" id="firstName" placeholder=""
                            value="">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" name="last_name" class="form-control" id="lastName" placeholder=""
                            value="">
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Phone Number <span class="text-muted">(Optional)</span></label>
                        <input type="text" name="phone_number" class="form-control" id="email"
                            placeholder="1234567890">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" id="address"
                        placeholder="1234 xyz society, area, city">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" name="country">
                            <option value="" disabled>Choose...</option>
                            <option value="india" selected>India</option>
                        </select>
                        <div class="invalid-feedback"> Please select a valid country. </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" id="state" name="state">
                            <option value="" disabled selected>Choose...</option>
                            <option value="gujarat">Gujarat</option>
                            <option value="mumbai">Mumbai</option>
                            <option value="delhi">Delhi</option>
                        </select>
                        <div class="invalid-feedback"> Please provide a valid state. </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" name="zip">
                        <div class="invalid-feedback"> Zip code required. </div>
                    </div>
                </div>

                <hr class="mb-4">

                <h4 class="mb-3">Payment</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="payment_method" type="radio" class="custom-control-input"
                            value="1" checked>
                        <label class="custom-control-label" for="credit">Cash On Delivery (COD)</label>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
    </div>
@endsection
