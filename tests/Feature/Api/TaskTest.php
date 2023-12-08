<?php

namespace Tests\Feature\Api;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testIndex(): void
    {
//        $response = $this->get('/api/task');
//        $response->assertStatus(200);

        $user = User::factory(3)->create();
        $task = Task::factory()->create();

        $response = $this->getJson('/api/task');
        $response->assertOk();

        $response->assertJson([
            'data' => [
                [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'date' => $task->date
                ]
            ]
        ]);
    }

    public function testStore(): void
    {
        $user = User::factory(3)->create();
        $task = Task::factory()->make();

        $response = $this->postJson('/api/task', $task->toArray());

        $response->assertCreated();

        $response->assertJson([
            'data' => ['title' => $task->title]
        ]);

        $this->assertDatabaseHas(
            'tasks',
            $task->toArray()
        );
    }

    public function testUpdate(): void
    {
        $user = User::factory(3)->create();
        $existingTask = Task::factory()->create();
        $newTask = Task::factory()->make();

        $response = $this->putJson('/api/task/'.$existingTask->id, $newTask->toArray());
        $response->assertJson([
            'data' => [
                'id' => $existingTask->id,
                'title' => $newTask->title
            ]
        ]);

        $this->assertDatabaseHas(
            'tasks',
            $newTask->toArray()
        );
    }

    public function testDelete(): void
    {
        $user = User::factory(3)->create();
        $existingTask = Task::factory()->create();

        $this->deleteJson('/api/task/'.$existingTask->id)->assertNoContent();

        $this->assertDatabaseMissing(
            'tasks',
            $existingTask->toArray()
        );
    }
}
