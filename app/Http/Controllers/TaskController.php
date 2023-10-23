<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\SetTaskCompletedAtRequest;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index() : Response{

        $tasks = Task::select('id', 'name', 'description', 'completed_at')
            ->get();

        return response()->json([
            'message' => 'Tasks retrieved successfully.',
            'data' => $tasks,
        ], Response::HTTP_OK);
    }

    public function store(TaskRequest $request): Response{

        $validated = $request->validated();

        try {

            $new_task = new Task;
            $new_task->name =  $validated['name'];

            if (array_key_exists('description', $validated)) {
                $new_task->description = $validated['description'];
            }

            if (array_key_exists('completed_at', $validated)) {
                $new_task->completed_at = $validated['completed_at'];
            }
           
            $new_task->save();

        } catch (\Exception $e) {

            return response()->json([
                'message' => "Something went wrong, please try again later.",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        return response()->json([
            'message' => 'Task created successfully.',
            'data' => $new_task,
        ], Response::HTTP_CREATED);
    }

    public function update(TaskRequest $request, Task $task): Response{

        $validated = $request->validated();

        try {

            $task->name =  $validated['name'];

            if (array_key_exists('description', $validated)) {
                $task->description = $validated['description'];
            }

            if (array_key_exists('completed_at', $validated)) {
                $task->completed_at = $validated['completed_at'];
            }
           
            $task->save();

        } catch (\Exception $e) {

            return response()->json([
                'message' => "Something went wrong, please try again later.",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        return response()->json([
            'message' => 'Task updated successfully.',
            'data' => $task,
        ], Response::HTTP_OK);
    }

    public function set_completed_at(SetTaskCompletedAtRequest $request, Task $task): Response{

        $validated = $request->validated();

        try {

            $task->completed_at = $validated['completed_at'];
            $task->save();

        } catch (\Exception $e) {

            return response()->json([
                'message' => "Something went wrong, please try again later.",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        return response()->json([
            'message' => 'Task completed_at updated successfully.',
            'data' => $task,
        ], Response::HTTP_OK);
    }
}
