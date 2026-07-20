# GitHub Task: Add Simple Task Management (Todo) Feature

## Status: ASSIGNED
## Assignee: AI Developer

### Objective
Create a simple task/todo list feature in the Laravel application so users can view and create tasks.

### Requirements

1. **Database Migration**:
   - Create a migration to create a `tasks` table.
   - The table must contain:
     - `id` (primary key, auto-increment)
     - `title` (string, required)
     - `description` (text, nullable)
     - `status` (string, default 'pending')
     - timestamps (`created_at` and `updated_at`)

2. **Model**:
   - Create a `Task` model at `app/Models/Task.php`.
   - Ensure the properties `title`, `description`, and `status` are fillable.

3. **Controller**:
   - Create a controller at `app/Http/Controllers/TaskController.php`.
   - Implement an `index` method that retrieves all tasks from the database and returns them to a view.
   - Implement a `store` method that validates the request (ensure `title` is present, min 3 chars), stores the new task, and redirects back to the tasks page.

4. **Routes**:
   - Register routes in `routes/web.php` for:
     - `GET /tasks` pointing to `TaskController@index`
     - `POST /tasks` pointing to `TaskController@store`

5. **Views**:
   - Create a Blade view at `resources/views/tasks/index.blade.php`.
   - The page must render a list of existing tasks with their title, description, and status.
   - The page must render a simple form to submit a new task (with a CSRF token).

6. **Local Testing**:
   - Run migrations using `php artisan migrate`.
   - Verify that tasks can be loaded and created via the browser or HTTP requests.

7. **Git Workflow**:
   - Once completed, commit the changes to the current branch.
   - Add a list of completed files and database changes under the "Implementation Details" section below.

---

## Implementation Details
- **Files Modified/Created**:
  - `app/Models/Task.php` — added the mass-assignable Task model.
  - `app/Http/Controllers/TaskController.php` — added task listing, validation, and creation.
  - `database/migrations/2026_07_20_000000_create_tasks_table.php` — added the tasks table schema and rollback.
  - `routes/web.php` — registered the named GET and POST task routes.
  - `resources/views/tasks/index.blade.php` — added the task list and CSRF-protected creation form.
  - `tests/Feature/TaskManagementTest.php` — added display, creation, default-status, and validation coverage.
- **Database Migrations Run**: Ran `php artisan migrate --force` successfully against local SQLite; the `tasks` table contains the required ID, title, nullable description, `pending` status default, and timestamps.
- **Local Verification**: `composer test` passed (5 tests, 15 assertions); `vendor/bin/pint --test` passed; both `/tasks` routes were confirmed with `php artisan route:list --path=tasks`.
- **Blockers / Assumptions / Unresolved Issues**: No blockers or unresolved issues. New tasks accept a title and optional description, use the database's `pending` status default, and are displayed newest first.
