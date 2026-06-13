<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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

// お問い合わせ入力画面（コントローラーのindexを呼び出す）
Route::get('/', [ContactController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);

// 確認画面への送信（フォームのボタンを押したとき、コントローラーのconfirmを呼び出す）
Route::post('/contact/confirm', [ContactController::class, 'confirm']);
// 送信完了画面（確認画面のフォームからPOSTで送られてくる宛先）
Route::post('/contact/thanks', [ContactController::class, 'thanks']);
// --- 認証系 (手動実装用) ---
// ユーザー登録画面と登録処理
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// ログイン画面とログイン処理
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

// ログアウト処理
Route::post('/logout', [AuthController::class, 'logout']);


// --- 管理画面系 ---
// 管理画面（一覧表示）
Route::get('/admin', [ContactController::class, 'admin']);

// 検索・リセット・削除・エクスポート
Route::get('/search', [ContactController::class, 'search']);
Route::get('/reset', [ContactController::class, 'reset']);
Route::post('/delete', [ContactController::class, 'delete']);
Route::get('/export', [ContactController::class, 'export']);