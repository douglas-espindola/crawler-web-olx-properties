<?php

    use App\Http\Controllers\Api\OlxCrawlersController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "api" middleware group. Make something great!
    |
    */

    Route::prefix('/pa')->group(function () {
        Route::get('/olx-properties', [OlxCrawlersController::class, 'getProperties'])->name('getProperties');
        Route::get('/download-properties',[OlxCrawlersController::class, 'downloadProperties'])->name('downloadProperties');

    });

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
