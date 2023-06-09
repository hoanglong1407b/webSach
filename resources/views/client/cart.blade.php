@extends('indexfull_layout')
@section('client_content')
        <div class="app__container">
            <div class="grid">
                <div class="row">
                    <div class="col-9">
                        <div class="container__cart">
                            <div class="cart__attributes cart__box">
                                <div class="cart__showing">
                                    <p class="cart__attribute cart--flex4">Sản phẩm</p>
                                    <p class="cart__attribute cart--flex3">Đơn giá</p>
                                    <p class="cart__attribute cart--flex2">Số lượng</p>
                                    <p class="cart__attribute cart--flex2">Thành tiền</p>
                                    <i class="cart__attribute fa-regular fa-trash"></i>
                                </div>
                            </div>
                            <?php
                            $content = Cart::content();
                            ?>
                            @foreach($content as $v_content)
                            <div class="cart__items cart__box">
                                <div class="cart__item cart__showing ">
                                    <div class="cart-item__product cart--flex4">
                                        <div class="cart-item__imgbox">
                                            <img class="cart-item__img" 
                                            src="{{URL::to('./frontend/img/products/'.$v_content->options->image)}}" 
                                            alt="" width="60">
                                        </div>
                                        <div class="cart-item__info">
                                            <h2 class="cart-item__title">{{$v_content->name}}</h2>
                                        </div>
                                    </div>
                                        <div class="cart-item__price cart--flex3">
                                            <p class="cart-item__lastprice">{{number_format($v_content->price).' '.'vnđ'}}</p>
                                        </div>
                                    <form class="cart-item__quantity cart--flex2 quantity"  
                                    action="{{URL::to('/update-cart-quantity')}}" method="POST">
                                        @csrf
                                            <input type="hidden" value="{{$v_content->rowId}}" 
                                            name="rowId_cart" class="form-control">
                                            <input class="cart_quantity_input" type="number" max="5" min="1" 
                                            name="cart_quantity" value="{{$v_content->qty}}" >
                                            <input type="submit" value="Cập nhật" 
                                            name="update_qty" class="cart-item__update"/>
                                    </form>
                                        <p class="cart-item__total cart--flex2"><?php
                                            $subtotal = $v_content->price * $v_content->qty;
                                            echo number_format($subtotal).' '.'vnđ';
                                            ?></p>
                                        <a href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}">
                                            <i class="cart-item__icon fa-regular fa-trash"></i>
                                        </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                     
                    </div>
                   
                    <div class="col-3">
                        <div class="cart__payment">
                            <div class="cart__prices cart__box">
                                <div class="cart-prices__box">
                                    <span>Tổng tiền</span>
                                    <p class="cart-prices__after">{{Cart::total().' '.'vnđ'}}</p>
                                </div>
                            </div>
                            @guest('customer')
                                <div class="cart__box">
                                    <a href="{{URL::to('/signInSignUp')}}">
                                        <button class="cart__button disabled">Đăng nhập</button>
                                    </a>
                                </div>
                            @else
                                <?php if(Cart::count()>0){?>
                                    <div class="cart__box">
                                        <a href="{{URL::to('/payment')}}">
                                            <button class="cart__button">Mua hàng</button>
                                        </a>
                                    </div>
                                <?php } ?>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="{{asset('frontend/js/view.js')}}"></script>

@endsection