<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @api                {get} /v1/task Получение полного списка дел
     * @apiName            Index
     * @apiVersion         1.0.0
     * @apiGroup           Tasks
     * @apiHeader          Accept application/json
     *
     * @apiSuccessExample  {json}       Success-Response:
     *    HTTP/1.1 200 OK
     *    {
     *      "data": [
     *        {
     *          "id": "1",
     *          "title": "Dolores pariatur sit et impedit aut.",
     *          "description": "Voluptatibus ratione aliquam et..."
     *          "date": "2023-12-08"
     *        },
     *      ...
     *    }
     *
     * @apiErrorExample  {json}       Error-Response:
     *    {
     *       "message":"401 Credentials Incorrect.",
     *       "status_code":401
     *    }
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * @api            {post} /v1/task Создание дела
     * @apiName        Store
     * @apiVersion     1.0.0
     * @apiGroup       Tasks
     * @apiHeader      Accept application/json
     *
     * @apiParam       {String[255]}  title Заголовок дела
     * @apiParam       {String} [description=255] Описание дела
     * @apiParam       {Number} user_id ID исполнителя
     * @apiParam       {Date} date Дата выполнения дела
     *
     * @apiSuccessExample  {json}       Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": {
     *           "id": "1",
     *           "title": "Dolores pariatur sit et impedit aut.",
     *           "description": "Voluptatibus ratione aliquam et..."
     *           "date": "2023-12-08"
     *         }
     *     }
     *
     * @apiErrorExample  {json}       Error-Response:
     *     {
     *        "message":"401 Credentials Incorrect.",
     *        "status_code":401
     *     }
     */
    public function store(TaskStoreRequest $request)
    {
        $task = Task::create($request->validated());

        return new TaskResource($task);
    }

    /**
     * @api            {get} /v1/task/{id} Получение дела по ID
     * @apiName        Show
     * @apiVersion     1.0.0
     * @apiGroup       Tasks
     * @apiHeader      Accept application/json
     *
     * @apiParam       {Number} id ID дела
     *
     * @apiSuccessExample  {json}       Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": {
     *           "id": "1",
     *           "title": "Dolores pariatur sit et impedit aut.",
     *           "description": "Voluptatibus ratione aliquam et..."
     *           "date": "2023-12-08"
     *         }
     *     }
     *
     * @apiErrorExample  {json}       Error-Response:
     *     {
     *        "message":"401 Credentials Incorrect.",
     *        "status_code":401
     *     }
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * @api            {put} /v1/task/{id} Обновление дела по ID
     * @apiName        Update
     * @apiVersion     1.0.0
     * @apiGroup       Tasks
     * @apiHeader      Accept application/json
     *
     * @apiParam       {Number} id ID дела
     *
     * @apiParam       {String[255]}  title Заголовок дела
     * @apiParam       {String} [description=255] Описание дела
     * @apiParam       {Number} user_id ID исполнителя
     * @apiParam       {Date} date Дата выполнения дела
     *
     * @apiSuccessExample  {json}       Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": {
     *           "id": "1",
     *           "title": "Dolores pariatur sit et impedit aut.",
     *           "description": "Voluptatibus ratione aliquam et..."
     *           "date": "2023-12-08"
     *         }
     *     }
     *
     * @apiErrorExample  {json}       Error-Response:
     *     {
     *        "message":"401 Credentials Incorrect.",
     *        "status_code":401
     *     }
     */
    public function update(TaskStoreRequest $request, Task $task)
    {
        $task->update($request->validated());

        return new TaskResource($task);
    }

    /**
     * @api            {delete} /v1/task/{id} Обновление дела по ID
     * @apiName        Destroy
     * @apiVersion     1.0.0
     * @apiGroup       Tasks
     * @apiHeader      Accept application/json
     *
     * @apiParam       {Number} id ID дела
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response(null, 204);
    }
}
