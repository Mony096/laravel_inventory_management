<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GoodsReceiptController;
use App\Http\Controllers\GoodsIssueController;
use App\Http\Controllers\BusinessPartnerController;
use App\Http\Controllers\BusinessPlaceController;
use App\Http\Controllers\InventoryCountController;
use App\Http\Controllers\InventoryPostingController;

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

Route::get('/', function () {
    return view('dashboard'); // dashboard UI
});

Route::resources([
    'items' => ItemController::class,
    'warehouses' => WarehouseController::class,
    'employees' => EmployeeController::class,
    'goods_receipts'=> GoodsReceiptController::class,
    'goods_issues' => GoodsIssueController::class,
    'business_partners' =>  BusinessPartnerController::class,
    'business_places' =>  BusinessPlaceController::class,
    'inventory_counts' =>  InventoryCountController::class,
]);