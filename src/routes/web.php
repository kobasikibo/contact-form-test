<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ExportController;

// お問い合わせフォーム
Route::get('/', [ContactController::class, 'create']);
Route::get('/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/store', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

// 管理画面
Route::get('/admin', [AdminController::class, 'search'])->name('admin.search');
Route::get('/admin/contact/{id}', [AdminController::class, 'show'])->name('admin.contact.show');
Route::post('/admin/export', [AdminController::class, 'export'])->name('admin.export');
Route::delete('/contacts/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

// ユーザー登録ページのルート
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// ログインページ表示
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// ログアウト処理
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// データエクスポート
Route::get('/export', [ExportController::class, 'export'])->name('export');