<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

// api route

Route::post("/user_registration_core", [UserController::class,"user_registration_core"])->name("user_registration_core");
Route::post("/user_login_core", [UserController::class,"user_login_core"])->name("user_login_core");
Route::post("/send_otp", [UserController::class,"send_otp"])->name("send_otp");
Route::post("/verify_otp_core", [UserController::class,"verify_otp_core"])->name("verify_otp_core");
Route::post("/reset_password_core",[UserController::class,"reset_password_core"])->middleware([TokenVerificationMiddleware::class])->name("reset_password_core");

//customer api route
Route::post("/customer_create",[CustomerController::class,"customer_create"])->middleware([TokenVerificationMiddleware::class])->name('customer_create');


//user log out route
Route::get("/logout",[UserController::class,"logout"])->name("logout");

//page route

Route::get("/",[HomeController::class,"home_page"]);

Route::get("/user_login",[UserController::class,"user_login"])->name("user_login");
Route::get("/send_otp_page",[UserController::class,"send_otp_page"])->name("send_otp_page");
Route::get("/verify_otp_page",[UserController::class,"verify_otp_page"])->name("verify_otp_page");
Route::get("/reset_password_page",[UserController::class,"reset_password_page"])->name("reset_password_page")->middleware([TokenVerificationMiddleware::class]);

Route::get("/user_registration",[UserController::class,"user_registration"])->name("user_registration");
Route::get("/dashboard",[DashboardController::class,"dashboard"])->middleware([TokenVerificationMiddleware::class])->name("dashboard");
// customer route

Route::get("/customer_page",[CustomerController::class,"customer_page"])->middleware([TokenVerificationMiddleware::class])->name("customer_page");
Route::get("/list_customer",[CustomerController::class,"list_customer"])->middleware([TokenVerificationMiddleware::class])->name("list_customer");
Route::post("/customer_by_id",[CustomerController::class,"customer_by_id"])->middleware([TokenVerificationMiddleware::class])->name("customer_by_id");
Route::post("/customer_delete",[CustomerController::class,"customer_delete"])->middleware([TokenVerificationMiddleware::class])->name("customer_delete");

//category page route

Route::get("/category_page",[CategoryController::class,"category_page"])->middleware([TokenVerificationMiddleware::class])->name("category_page");
Route::get("/list_category",[CategoryController::class,"list_category"])->middleware([TokenVerificationMiddleware::class])->name("list_category");
Route::post("/category_create",[CategoryController::class,"category_create"])->middleware([TokenVerificationMiddleware::class])->name("category_create");
Route::post("/category_by_id",[CategoryController::class,"category_by_id"])->middleware([TokenVerificationMiddleware::class])->name("category_by_id");
Route::post("/category_update",[CategoryController::class,"category_update"])->middleware([TokenVerificationMiddleware::class])->name("category_update");
Route::post("/category_delete",[CategoryController::class,"category_delete"])->middleware([TokenVerificationMiddleware::class])->name("category_delete");

//product Route
Route::get("/product_page",[ProductController::class,"product_page"])->middleware([TokenVerificationMiddleware::class])->name("product_page");
Route::get("/list_product",[ProductController::class,"list_product"])->middleware([TokenVerificationMiddleware::class])->name("list_product");
Route::post("/create_product",[ProductController::class,"create_product"])->middleware([TokenVerificationMiddleware::class])->name("create_product");
Route::post("/product_by_id",[ProductController::class,"product_by_id"])->middleware([TokenVerificationMiddleware::class])->name("product_by_id");
Route::post("/update_product",[ProductController::class,"update_product"])->middleware([TokenVerificationMiddleware::class])->name("update_product");
Route::post("/delete_product",[ProductController::class,"delete_product"])->middleware([TokenVerificationMiddleware::class])->name("delete_product");
//SALE PAGE


Route::get("/sale_Page",[InvoiceController::class,"sale_Page"])->middleware([TokenVerificationMiddleware::class])->name("sale_Page");

Route::post("/invoice_create",[InvoiceController::class,"invoice_create"])->middleware([TokenVerificationMiddleware::class])->name("invoice_create");
Route::post("/invoice_details",[InvoiceController::class,"invoice_details"])->middleware([TokenVerificationMiddleware::class])->name("invoice_details");
Route::post("/invoice_delete",[InvoiceController::class,"invoice_delete"])->middleware([TokenVerificationMiddleware::class])->name("invoice_delete");
Route::get("/invoice_page",[InvoiceController::class,"invoice_page"])->middleware([TokenVerificationMiddleware::class])->name("invoice_page");
Route::get("/invoice_select",[InvoiceController::class,"invoice_select"])->middleware([TokenVerificationMiddleware::class])->name("invoice_select");
//report_page

Route::get("/summary",[DashboardController::class,"summary"])->middleware([TokenVerificationMiddleware::class])->name("summary");
Route::get("/sales_report/{FormDate}/{ToDate}",[ReportController::class,"sales_report"])->middleware([TokenVerificationMiddleware::class])->name("sales_report");
Route::get("/sales_report_page",[ReportController::class,"sales_report_page"])->middleware([TokenVerificationMiddleware::class])->name("sales_report_page");


