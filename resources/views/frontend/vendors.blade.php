@extends('layouts.frontend')

@section('title')
    Ekomalls | Become a Vendor
@endsection

@section('content')
<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Become a Vendor</li>
            </ul>
        </div>
    </div>
      
     @if($errors->all())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
               <li> {{ $error }}</li>
            @endforeach
        </div>
     @endif
    <div class="ps-vendor-banner bg--cover" data-background="{{ asset('frontend_assets/img/bg/vendor.jpg') }}">
        <div class="container">
            <h2>Millions Of Shoppers Can’t Wait To See What You Have In Store</h2><a class="ps-btn ps-btn--lg" href="{{ route('shops.create') }}">Start Selling</a>
        </div>
    </div>
    <div class="ps-section--vendor ps-vendor-about">
        <div class="container">
            <div class="ps-section__header">
                <p>WHY SELL ON Ekomalls</p>
                <h4>Join a marketplace where nearly 50 million buyers around <br> the world shop for unique items</h4>
            </div>
            <div class="ps-section__content">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--icon-box-2">
                            <div class="ps-block__thumbnail"><img src="{{ asset('frontend_assets/img/icons/vendor-1.png') }}" alt=""></div>
                            <div class="ps-block__content">
                                <h4>Low Fees</h4>
                                <div class="ps-block__desc" data-mh="about-desc">
                                    <p>It doesn’t take much to list your items and once you make a sale, Ekomalls’s transaction fee is just 5%.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--icon-box-2">
                            <div class="ps-block__thumbnail"><img src="{{ asset('frontend_assets/img/icons/vendor-2.png') }}" alt=""></div>
                            <div class="ps-block__content">
                                <h4>Powerful Tools</h4>
                                <div class="ps-block__desc" data-mh="about-desc">
                                    <p>Our tools and services make it easy to manage, promote and grow your business.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--icon-box-2">
                            <div class="ps-block__thumbnail"><img src="{{ asset('frontend_assets/img/icons/vendor-3.png') }}" alt=""></div>
                            <div class="ps-block__content">
                                <h4>Support 24/7</h4>
                                <div class="ps-block__desc" data-mh="about-desc">
                                    <p>Our support agents are available 24/7 to make it easy to manage your queries, promote and grow your business.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-section--vendor ps-vendor-milestone">
        <div class="container">
            <div class="ps-section__header">
                <p>How it works</p>
                <h4>Easy to start selling online on Ekomalls just 4 simple steps</h4>
            </div>
            <div class="ps-section__content">
                <div class="ps-block--vendor-milestone">
                    <div class="ps-block__left">
                        <h4>Register and list your products</h4>
                        <ul>
                            <li>Register your business for free and create a product catalogue. Get free training on how to run your online business</li>
                            <li>Our Ekomalls Advisors will help you at every step and fully assist you in taking your business online</li>
                        </ul>
                    </div>
                    <div class="ps-block__right"><img src="{{ asset('frontend_assets/img/vendor/milestone-1.png') }}" alt=""></div>
                    <div class="ps-block__number"><span>1</span></div>
                </div>
                <div class="ps-block--vendor-milestone reverse">
                    <div class="ps-block__left">
                        <h4>Receive orders and sell your product</h4>
                        <ul>
                            <li>Recieve orders from customers. Deliver the product to the customer and mark the order as delivered, and get paid immediately in your account.</li>
                            <li>Our Ekomalls Advisors will help you at every step and fully assist you in taking your business online</li>
                        </ul>
                    </div>
                    <div class="ps-block__right"><img src="{{ asset('frontend_assets/img/vendor/milestone-2.png') }}" alt=""></div>
                    <div class="ps-block__number"><span>2</span></div>
                </div>
                <div class="ps-block--vendor-milestone">
                    <div class="ps-block__left">
                        <h4>Cash on Delivery</h4>
                        <ul>
                            <li>When you receive a cash on delivery orders.After you deliver the product and mark as complete we will deduct 5% of total amount of the order from your wallet.</li>
                            <li>Our Ekomalls Advisors will help you at every step and fully assist you in taking your business online</li>
                        </ul>
                    </div>
                    <div class="ps-block__right"><img src="{{ asset('frontend_assets/img/vendor/milestone-3.png') }}" alt=""></div>
                    <div class="ps-block__number"><span>3</span></div>
                </div>
                <div class="ps-block--vendor-milestone reverse">
                    <div class="ps-block__left">
                        <h4>Promoting Your store</h4>
                        <ul>
                            <li>You can also feature your products with our homepage banners. A small onetime charge and we will promote your product the entire month</li>
                            <li>Our Ekomalls Advisors will help you at every step and fully assist you in taking your business online</li>
                        </ul>
                    </div>
                    <div class="ps-block__right"><img src="{{ asset('frontend_assets/img/vendor/milestone-4.png') }}" alt=""></div>
                    <div class="ps-block__number"><span>4</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-section--vendor ps-vendor-best-fees">
        <div class="container">
            <div class="ps-section__header">
                <p>BEST FEES TO START</p>
                <h4>Affordable, transparent, and secure</h4>
            </div>
            <div class="ps-section__content">
                <h5>It only costs 0.20 USD to list a product, and you only pay 5% of the total amount after your stuff sells. It’s just a small percent of the money you earn</h5>
                <div class="ps-section__numbers">
                    <figure>
                        <h3>$0.20</h3><span>List Fee</span>
                    </figure>
                    <figure>
                        <h3>5%</h3><span>Final Value Fee</span>
                    </figure>
                </div>
                <div class="ps-section__desc">
                    <figure>
                        <figcaption>Here's what you get for your fee:</figcaption>
                        <ul>
                            <li>A worldwide community of online shoppers.</li>
                            <li>Seller protection and customer support to help you sell your stuff.</li>
                        </ul>
                    </figure>
                </div>
                <div class="ps-section__highlight"><img src="{{ asset('frontend_assets/img/icons/vendor-4.png') }}" alt="">
                    <figure>
                        <p>We process payments with PayPal and Bank Transfers, an external payments platform that allows you to process transactions with a variety of payment methods. Funds from PayPal sales on Ekomalls will be deposited into your PayPal account.Or we will deposit your balances directly into your bank account.Any of the two methods you are comfortable with.</p>
                    </figure>
                </div>
                <div class="ps-section__footer">
                    <p>Listing fees are billed for 0.20 USD, so if your bank’s currency is not USD, the amount in your currency may vary based on changes in the exchange rate.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-section--vendor ps-vendor-faqs">
        <div class="container">
            <div class="ps-section__header">
                <p>FREQUENTLY ASKED QUESTIONS</p>
                <h4>Here are some common questions about selling on Ekomalls</h4>
            </div>
            <div class="ps-section__content">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <figure>
                            <figcaption>How do fees work on Ekomalls?</figcaption>
                            <p>Joining and starting a shop on Ekomalls is free. There are three basic selling fees: a listing fee, and a payment processing fee.</p>
                            <p>It costs USD 0.20 to publish a listing to the website. A listing lasts for one month or until the item is sold. Once an item sells, there is a 5% transaction fee on the sale price (not including shipping costs). If you accept payments with PayPal, there is also a payment processing fee based on their fee structure.</p>
                            <p>Listing fees are billed for $0.20 USD, so if your bank’s currency is not USD, the amount may differ based on changes in the exchange rate.</p>
                        </figure>
                        <figure>
                            <figcaption>What do I need to do to create a shop?</figcaption>
                            <p>It’s easy to set up a shop on Ekomalls. Create an Ekomalls account (if you don’t already have one), set your shop location, choose a shop name, create a listing, set a payment method (how you want to be paid), and finally set a billing method (how you want to pay your Ekomallsfees).</p>
                        </figure>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <figure>
                            <figcaption>How do I get paid?</figcaption>
                            <p>If you accept payments with PayPal, funds from PayPal sales on Ekomalls will be deposited into your PayPal account. We encourage sellers to use a PayPal Business account and not a Personal account, as personal accounts are subject to monthly receiving limits and cannot accept payments from buyers that are funded by a credit card. We can also deposit your balances directly into your bank account.Any of the two methods you are comfortable with.</p>
                        </figure>
                        <figure>
                            <figcaption>Do I need a credit or debit card to create a shop?</figcaption>
                            <p>No, a credit or debit card is not required to create a shop. To be verified as a seller you have to provide us a soft copies of your legal business documents.</p>
                        </figure>
                        <figure>
                            <figcaption>What can I sell on Ekomalls?</figcaption>
                        </figure>
                        <p>Ekomalls provides a platform for any sellers to sell any type of products (Products must be legal).So, if you have an offline store to make your presence online.This is the best time to join us and grow your business.</p>
                    </div>
                </div>
            </div>
            <div class="ps-section__footer">
                <p>Still have more questions? Feel free to contact us.</p><a class="ps-btn" href="#">Contact Us</a>
            </div>
        </div>
    </div>
    <div class="ps-vendor-banner bg--cover" data-background="{{ asset('frontend_assets/img/bg/vendor.jpg') }}">
        <div class="container">
            <h2>It's time to start making money.</h2><a class="ps-btn ps-btn--lg" href="{{ route('shops.create') }}">Start Selling</a>
        </div>
    </div>
</div>
@endsection