<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_page_displays_existing_tasks(): void
    {
        Task::create([
            'title' => 'Review project requirements',
            'description' => 'Read the assigned GitHub issue.',
            'status' => 'in_progress',
        ]);

        $response = $this->get(route('tasks.index'));

        $response->assertOk()
            ->assertSee('Review project requirements')
            ->assertSee('Read the assigned GitHub issue.')
            ->assertSee('in_progress');
    }

    public function test_a_task_can_be_created(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title' => 'Implement task management',
            'description' => 'Add the model, controller, routes, and view.',
        ]);

        $response->assertRedirect(route('tasks.index'))
            ->assertSessionHas('success', 'Task created successfully.');

        $this->assertDatabaseHas('tasks', [
            'title' => 'Implement task management',
            'description' => 'Add the model, controller, routes, and view.',
            'status' => 'pending',
        ]);
    }

    public function test_a_task_title_is_required_and_has_a_minimum_length(): void
    {
        $response = $this->from(route('tasks.index'))->post(route('tasks.store'), [
            'title' => 'ab',
        ]);

        $response->assertRedirect(route('tasks.index'))
            ->assertSessionHasErrors('title');

        $this->assertDatabaseCount('tasks', 0);
    }
}
