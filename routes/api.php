<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

/**
 * @api                {get} /v1/task Входная точка API ресурса
 * @apiName            TaskList
 * @apiDescription     (GET/POST/PUT/DELETE)/v1/task Входная точка API ресурса для получения, создания, редактирования и удаления "Списка дел"
 * @apiVersion         1.0.0
 * @apiGroup           Tasks
 *
 * @apiHeader          Accept application/json
 *
 * @apiSuccessExample  {json}       Success-Response:
 *   HTTP/1.1 200 OK
 *   {
 *     "data": {
 *       "id": "owpzanmh",
 *       "title": "Super Admin",
 *       "description": "admin@admin.com"
 *       "date": "admin@admin.com"
 *       ...
 *   }
 *
 * @apiErrorExample  {json}       Error-Response:
 *   {
 *      "message":"401 Credentials Incorrect.",
 *      "status_code":401
 *   }
 *
 * @apiErrorExample  {json}       Error-Response:
 *   {
 *      "message":"Invalid Input.",
 *      "errors":{
 *         "title":[
 *            "The email field is required."
 *         ]
 *      },
 *      "status_code":422
 *   }
 */
Route::prefix('v1')->group(function () {
    Route::resources([
        'task' => TaskController::class,
    ]);
});
