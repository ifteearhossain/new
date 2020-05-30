<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);



// FrontendController

Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('/search', 'FrontendController@search')->name('homePage.search');
Route::get('/about/us/', 'FrontendController@about')->name('frontend.about');
Route::get('/frequently/asked/questions', 'FrontendController@faq')->name('frontend.faq');
Route::get('/policy', 'FrontendController@policy')->name('frontend.policy');
Route::get('/contact', 'FrontendController@contact')->name('frontend.contact');
Route::post('/contact/post', 'FrontendController@contactPost')->name('frontend.contactPost');
Route::get('/terms/and/conditions', 'FrontendController@terms')->name('frontend.term');

// END FrontendController


// FrontProductController 

 Route::get('/product', 'FrontProductController@index')->name('front.product');
 Route::get('/product/asc', 'FrontProductController@indexAtoZ')->name('front.product.atoz');
 Route::get('/product/desc', 'FrontProductController@indexZtoA')->name('front.product.ztoa');
 Route::get('/category/{category_id}/product', 'FrontProductController@byCategory')->name('category.product');
 Route::get('/sub_category/{sub_category_id}/product', 'FrontProductController@bySubCategory')->name('sub_category.product');
 Route::get('/product/search', 'FrontProductController@filter')->name('productPage.search');
 Route::get('/product/{slug}', 'FrontProductController@productdetails')->name('product.details');

// END FrontProductController


// CartController

Route::resource('cart', 'CartController');
Route::get('cart/{cart_id}/remove', 'CartController@cartremove')->name('cart.remove');
Route::get('cart/{coupon_name}/coupon-trxID029', 'CartController@index');

// END CartController

// WishlistController
  Route::get('/wishlist', 'WishlistController@index')->name('wishlist.index');
  Route::get('/add/{product_id}/wish', 'WishlistController@addwish')->name('add.wish');
  Route::get('/remove/{id}/wish', 'WishlistController@removewish')->name('remove.wish');
// END WishlistController

// CheckoutController 

Route::post('checkout', 'CheckoutController@index')->name('checkout.index');
Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('order', 'CheckoutController@order')->name('checkout.order');
Route::get('/banktransfer','CheckoutController@bank')->name('bank.transfer');

// END CheckoutController 

// VerifyController 
 Route::post('verify', 'VerifyController@verify')->name('checkout.verify');
 Route::post('verify/paypal', 'VerifyPayPalController@verify')->name('paypal.verify');
 Route::post('verify/user', 'VerifyController@userVerify')->name('regular.verify');
 Route::post('verify/done', 'VerifyController@verifyDone')->name('verify.done');
// END VerifyController

// StripePaymentController

 Route::get('stripe', 'StripePaymentController@stripe');
 Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

// END StripePaymentController

// PayPalController

Route::post('/create-payment', 'PayPalController@create')->name('create-payment');
Route::get('/execute-payment', 'PayPalController@execute')->name('execute-payment');

// END PayPalController


// SubscriptionController
 Route::post('/subscribe', 'SubscriptionController@subscribe')->name('subscribe');
// END SubscriptionController

// LoginController

Route::get('auth/social', 'Auth\LoginController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

// END LoginController

// HomeController

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/edit/profile', 'HomeController@profileedit')->name('profile.edit');
Route::post('/update/profile', 'HomeController@profileupdate')->name('profile.update');
Route::get('/change/password', 'HomeController@changepassword')->name('change.password');
Route::post('/password/post', 'HomeController@passwordchanged')->name('password.changed');
Route::get('/user/{user_id}/profile', 'HomeController@userprofile')->name('users.profile');
Route::get('/make/{user_id}/admin', 'HomeController@makeadmin')->name('make.admin');
Route::get('/delete/{user_id}/user', 'HomeController@deleteuser')->name('delete.user');
Route::post('/pay/seller/', 'HomeController@payseller')->name('pay.seller');

// END HomeController

// Ajax Requests 
  Route::post('/get/state', 'AjaxController@getstate');
  Route::post('/get/city', 'AjaxController@getcity');
  Route::post('/get/code', 'AjaxController@getcode');



// AdminController
 Route::resource('admin', 'AdminController');
// End Admin Controller


// SellerController
  Route::resource('seller', 'SellerController');
  Route::get('download/{order_id}/invoice/seller', 'SellerController@downloadInvoice')->name('download.invoiceseller');
// End SellerController


// CustomerController
  Route::resource('customer', 'CustomerController');
  Route::get('download/{order_id}/invoice', 'CustomerController@downloadInvoice')->name('download.invoice');
  Route::post('add/review', 'CustomerController@addreview')->name('add.review');
// End CustomerController


// ComplainController 

  Route::post('/complain', 'ComplainController@index');
  Route::get('/view/{complain_id}/complain', 'ComplainController@show')->name('view.complain');

// EndComplainController 

// CategoryController
  Route::resource('category', 'CategoryController');
// End CategoryController


// SubCategoryController
  Route::resource('sub_category', 'SubCategoryController');
// End SubCategoryController

// ProductController
  // Ajax Request Route
  Route::post('/get/subcategory', 'ProductController@getsubcategory');
  // End Ajax Request Route
  Route::resource('products', 'ProductController');
// END ProductController

// ShopController
  Route::resource('shops', 'ShopController');
  Route::get('shops/{id}/approve', 'ShopController@approve')->name('shops.approve');
// END ShopController

// CouponController
  Route::get('/coupons', 'CouponController@index')->name('coupon.index');
  Route::post('/coupons/store', 'CouponController@store')->name('coupon.store');
// END CouponController 

// SaleController

  Route::get('/all/sales', 'SaleController@index')->name('sale.index');
  Route::get('/cod/sales', 'SaleController@saleCod')->name('sale.cod');
  Route::get('/card/sales', 'SaleController@saleCard')->name('sale.card');
  Route::get('/paypal/sales', 'SaleController@salePayPal')->name('sale.paypal');
  Route::get('/bank/sales', 'SaleController@saleBank')->name('sale.bank');
  Route::get('/wallet/sales', 'SaleController@saleWallet')->name('sale.wallet');
  Route::get('/delivered/{order_id}/order', 'SaleController@delivered')->name('sale.delivered');
  Route::get('/received/{order_id}/payment', 'SaleController@receivedPayment')->name('sale.receivedPayment');
  Route::post('/send/sms/', 'SaleController@sendsms');
  Route::get('/sale/{order_id}/cancel', 'SaleController@cancel')->name('sale.cancel');

// END SaleController  

// VendorController 

 Route::get('/sell/with/ekomalls', 'VendorController@index')->name('vendor.index');
 Route::get('/stores', 'VendorController@storelist')->name('all.stores');
 Route::get('/stores/old/new', 'VendorController@storeoldtonew')->name('all.storesold');
 Route::get('/stores/{store_name}', 'VendorController@show')->name('single.store');
 Route::get('/stores/{store_name}/about', 'VendorController@about')->name('single.about');
 Route::get('/store/search/{store_name}', 'VendorController@storesearch')->name('store.search');

// END VendorController

// WalletController 

 Route::get('/deposit/ekowallet', 'WalletController@deposit')->name('deposit.ekowallet');
 Route::post('/deposit/post', 'WalletController@depositPost')->name('deposit.post');
 Route::get('/transaction', 'WalletController@transaction')->name('transaction.ekowallet');
 Route::get('/withdraw', 'WalletController@withdraw')->name('withdraw.ekowallet');
 Route::post('/withdraw/post', 'WalletController@withdrawPost')->name('withdraw.post');

// END WalletController

// UserWalletController 

Route::get('/user/wallet', 'UserWalletController@index')->name('user.wallet');
Route::post('/user/topup', 'UserWalletController@topup')->name('user.topup');
Route::post('/user/withdraw', 'UserWalletController@withdraw')->name('user.withdraw');
Route::get('/user/{withdraw_id}/transfer', 'UserWalletController@transferdone')->name('transfer.done');

// END UserWalletController


// CoronaController
Route::get('/corona-update', 'CoronaController@index');
// END CoronaController

// AboutController 
 Route::resource('about', 'AboutController');
// END AboutController

// FaqController 
  Route::resource('faqs', 'FaqController');
// END FaqController

// PolicyController 
  Route::resource('policies', 'PolicyController' );
// END PolicyController

// ContactController 
  Route::resource('contacts', 'ContactController');
// END ContactController

// TocController
  Route::resource('toc', 'TocController');
// END TocController

// PendingVerificationController
  Route::get('/pending/verify', 'PendingVerificationController@index')->name('verification.index');
// END PendingVerificationController

// BannerController 
  Route::get('/add/banner/home/big', 'BannerController@bannerHomeBig')->name('bannerHome.big');
  Route::post('/add/banner/home/big/post', 'BannerController@bannerHomeBigPost')->name('bannerHome.bigPost');
  Route::get('/add/banner/home/big/delete/{banner_id}', 'BannerController@bannerHomeBigDelete')->name('bannerHome.bigDelete');


  Route::get('/add/banner/home/small', 'BannerController@bannerHomeSmall')->name('bannerHome.small');
  Route::post('/add/banner/home/small/post', 'BannerController@bannerHomeSmallPost')->name('bannerHome.smallPost');
  Route::get('/add/banner/home/small/delete/{banner_id}', 'BannerController@bannerHomeSmallDelete')->name('bannerHome.smallDelete');


  Route::get('/add/banner/home/middle', 'BannerController@bannerHomeMiddle')->name('bannerHome.middle');
  Route::post('/add/banner/home/middle/post', 'BannerController@bannerHomeMiddlePost')->name('bannerHome.middlePost');
  Route::get('/add/banner/home/middle/delete/{banner_id}', 'BannerController@bannerHomeMiddleDelete')->name('bannerHome.middleDelete');


  Route::get('/add/banner/home/footer/big', 'BannerController@bannerFooterBig')->name('bannerFooter.big');
  Route::post('/add/banner/home/footer/post', 'BannerController@bannerFooterBigPost')->name('bannerFooter.bigPost');
  Route::get('/add/banner/home/footer/big/delete/{banner_id}', 'BannerController@bannerFooterBigDelete')->name('bannerFooter.bigDelete');


  Route::get('/add/banner/home/footer/small', 'BannerController@bannerFooterSmall')->name('bannerFooter.small');
  Route::post('/add/banner/home/footer/small/post', 'BannerController@bannerFooterSmallPost')->name('bannerFooter.smallPost');
  Route::get('/add/banner/home/footer/delete/{banner_id}', 'BannerController@bannerFooterSmallDelete')->name('bannerFooter.smallDelete');

  Route::get('/add/banner/product/big', 'BannerController@bannerProductBig')->name('bannerProduct.big');
  Route::post('/add/banner/product/big/post', 'BannerController@bannerProductBigPost')->name('bannerProduct.bigPost');
  Route::get('/add/banner/product/delete/{banner_id}', 'BannerController@bannerProductBigDelete')->name('bannerProduct.bigDelete');

// END BannerController