<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Group\Http\Controllers\GroupController;
//Route::pattern('group', '[0-9]+');
Route::prefix('group')->group(function() {

    Route::get('/{group}', [GroupController::class , 'getGroupDetails'])->name('group.details');

    Route::post('add-member/{group}', [GroupController::class , 'addMember'])->name('group.add.member');
});
