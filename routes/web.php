<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CategoryDetailController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DeliveryAddress;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RevenueController;

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
//     return view('index');
// });

//Shop
Route::get('shop',[ShopController::class, 'index'])->name('shop.index');

//Main
Route::get('/',[MainController::class, 'index'])->name('main.index');

//Contact
Route::get('contact',[ShopController::class, 'contact'])->name('contact');
Route::post('send-contact',[ShopController::class, 'insertContact'])->name('contact.send');


//User
Route::middleware(['AlreadyLoggedIn'])->group(function () {
    Route::get('login',[UserAuthController::class, 'login']);
    Route::get('register',[UserAuthController::class, 'register']);

    //Login Google + FaceBook
    Route::get('redirect/{provider}',[UserAuthController::class, 'redirectToProvider'])->name('login.redirect');
    Route::get('/callback/{provider}',[UserAuthController::class, 'handleProviderCallback']);
});

Route::post('create',[UserAuthController::class, 'create'])->name('auth.create');
Route::post('check',[UserAuthController::class, 'check'])->name('auth.check');

//Check login
Route::middleware(['isLogged'])->group(function () {

    //Admin
    Route::resource('filemanager',AdminController::class);
    Route::get('user-staff',[AdminController::class, 'userStaff'])->name('user.staff');
    Route::get('user-customer',[AdminController::class, 'userCustomer'])->name('user.customer');
    Route::post('createStaff',[AdminController::class, 'createStaff'])->name('user.createStaff');
    Route::post('updateStaff',[AdminController::class, 'updateStaff'])->name('user.updateStaff');
    Route::post('delete-user',[AdminController::class, 'deleteUser'])->name('user.delete');
    Route::get('profile-admin',[AdminController::class, 'profileAdmin'])->name('admin.profile');
    Route::get('staff-show/{id}',[AdminController::class, 'getUserStaffByID']);

    Route::get('home',[UserAuthController::class, 'home']);
    Route::get('logout',[UserAuthController::class, 'logout']);
    
    
    //category
    Route::resource('category',CategoryController::class);
    Route::get('category-show/{id}',[CategoryController::class, 'getCategoryById']);
    Route::post('category-update',[CategoryController::class, 'updateCategory'])->name('category.update');
    Route::get('category-delete/{id}',[CategoryController::class, 'deleteCategory']);
    Route::get('category-status/{id}/{status}',[CategoryController::class, 'updateStatusCategory']);
    

    //Unit - pending
    Route::resource('unit',UnitController::class);

    //Category Detail
    Route::get('category-detail',[CategoryDetailController::class, 'index'])->name('category_detail.index');
    Route::post('category-detail/create',[CategoryDetailController::class, 'create'])->name('category_detail.create');
    Route::get('category-detail-show/{id}',[CategoryDetailController::class, 'getCategoryDetailById']);
    Route::post('category-detail-update',[CategoryDetailController::class, 'update'])->name('category_detail.update');
    Route::get('category-detail-delete/{id}',[CategoryDetailController::class, 'destroy']);
    
    

    //Publisher
    Route::resource('publisher',PublisherController::class);
    Route::get('publisher-show/{id}',[PublisherController::class, 'getPublisherById']);
    Route::post('publisher-update',[PublisherController::class, 'updatePublisher'])->name('publisher.update');
    Route::get('publisher-delete/{id}',[PublisherController::class, 'deletePublisher']);

    //Product
    Route::resource('product',ProductController::class);
    Route::get('product-create',[ProductController::class, 'createProduct'])->name('product.createProduct');
    Route::post('product-update',[ProductController::class, 'updateProduct'])->name('product.updateProduct');
    Route::get('product-status/{id}/{status}',[ProductController::class, 'updateStatusProduct']);
    Route::post('product-delete',[ProductController::class, 'deleteProduct'])->name('product.deleteProduct');
    Route::get('product-code-create',[ProductController::class, 'createProductCode'])->name('product.createProductCode');
    Route::post('export-csv',[ProductController::class, 'exportProductCSV']);
    Route::post('import-csv',[ProductController::class, 'importProductCSV']);
    Route::post('exportv2-csv',[ProductController::class, 'exportProductV2CSV']);
    Route::post('importnewProduct-csv',[ProductController::class, 'importnewProductCSV']);

    //Shopping Cart
    Route::post('add-cart-ajax',[CartController::class, 'addCartAjax']);
    Route::get('show-cart',[CartController::class, 'showCart'])->name('showCart');
    Route::post('update-to-cart',[CartController::class, 'updateCart']);
    Route::post('delete-to-cart',[CartController::class, 'deleteCart']);
    Route::post('promo-to-cart',[CartController::class, 'promoCart']);
    Route::get('check-out',[CartController::class, 'checkOut'])->name('checkout');
    Route::post('choose-delivery',[CartController::class, 'chooseDelivery'])->name('choose.delivery');

    //Users
    Route::get('profile',[UserAuthController::class, 'profile']);
    Route::post('update-profile',[UserAuthController::class, 'updateProfile'])->name('profile.update');
    


    //Delivery
    Route::get('delivery-address',[DeliveryAddress::class, 'deliveryAddress'])->name('dilivery.address');
    Route::post('delivery-add',[DeliveryAddress::class, 'addDelivery'])->name('delivery.addAddress');
    Route::get('delivery-delete/{id}',[DeliveryAddress::class, 'deleteDelivery'])->name('delivery.deleteAddress');
    Route::post('delivery-checkout',[DeliveryAddress::class, 'checkOutDelivery'])->name('delivery.checkOutDelivery');

    //Order
    Route::post('create-order',[OrderController::class, 'createOrder'])->name('order.create');
    Route::get('order-list',[OrderController::class, 'getListOrderByUser'])->name('order.list');
    Route::get('order',[OrderController::class, 'index'])->name('order.index');
    Route::get('change-status/{order_code}/{status}',[OrderController::class, 'updateStatusOrder']);
    Route::post('order-detail',[OrderController::class, 'getListOrderDetail'])->name('order_detail');
    Route::post('update-estimate-date',[OrderController::class, 'updateEstimateDate'])->name('estimate_date');
    Route::post('order-filter',[OrderController::class, 'orderFilter'])->name('order.filter');
    Route::get('print-order/{order_code}',[OrderController::class, 'print_order']);

    //Promotion
    Route::get('promotion',[PromotionController::class, 'index'])->name('promotion.index');
    Route::post('create-promotion',[PromotionController::class, 'createPromotion'])->name('promotion.createPromotion');
    Route::post('update-promotion',[PromotionController::class, 'updatePromotion'])->name('promotion.updatePromotion');
    Route::get('promotion-show/{id}',[PromotionController::class, 'getPromotionById']);
    Route::post('delete-promotion',[PromotionController::class, 'deletePromotion'])->name('promotion.deletePromotion');
    Route::get('voucher',[PromotionController::class, 'showPromotion'])->name('promotion.showPromotion');

    //Comments
    Route::post('comment',[CommentController::class, 'userComment'])->name('user.comment');

    //Wishlist
    Route::get('add-wishlist/{slug}',[UserAuthController::class, 'addWishlist']);
    Route::get('remove-wishlist/{slug}',[UserAuthController::class, 'removeWishlist']);
    Route::get('wishlist',[UserAuthController::class, 'getListWishList'])->name('wishlist.list');

    //Contact
    Route::get('contact-list',[AdminController::class, 'getListContact'])->name('contact.list');
    Route::get('contact-show/{id}',[AdminController::class, 'contactShow']);
    Route::post('feedbackContact',[AdminController::class, 'feedbackContact'])->name('contact.feedback');
    Route::post('delete-contact',[AdminController::class, 'deleteContact'])->name('contact.deleteContact');

    //Banner
    Route::get('banner-list',[AdminController::class, 'getListBanner'])->name('banner.list');
    Route::post('banner-create',[AdminController::class, 'createBanner'])->name('banner.createBanner');
    Route::post('banner-update',[AdminController::class, 'updateBanner'])->name('banner.updateBanner');
    Route::get('banner-show/{id}',[AdminController::class, 'bannerShow']);
    Route::post('delete-banner',[AdminController::class, 'deleteBanner'])->name('banner.deleteBanner');

    //Inventory
    Route::get('inventory-list',[InventoryController::class, 'getListInventory'])->name('inventory.list');

    //Revenue
    Route::get('revenue',[RevenueController::class, 'index'])->name('revenue');
    Route::post('profit',[RevenueController::class, 'profit'])->name('revenue.profit');
});

Route::get('/{slug}',[ShopController::class, 'productDetail'])->name('productDetail.product');
Route::get('the-loai/{slug}',[ShopController::class, 'subCategoryProduct'])->name('subcategory.product');
Route::get('danh-muc/{slug}',[ShopController::class, 'categoryProduct'])->name('category.product');
Route::get('progress-order/{data}',[OrderController::class, 'progressOrder'])->name('progress.order');
Route::get('cancel-order/{data}',[OrderController::class, 'cancelOrder'])->name('cancel.order');

Route::get('qrcode-order/{order_code}',[OrderController::class, 'qrCodeOrder']);
Route::post('qrcode-order-return',[OrderController::class, 'qrCodeOrderReturn'])->name('order.return');
Route::post('search',[ProductController::class, 'searchProduct']);
Route::post('search-product',[ProductController::class, 'search'])->name('product.search');
