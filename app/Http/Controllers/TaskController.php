<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\SetTaskCompletedAtRequest;

class TaskController extends Controller
{
    public function index() : Response{

        $tasks = Task::select('id', 'name', 'description', 'completed', 'created_at', 'updated_at')
            
            ->orderBy('completed','ASC')
            ->orderBy('id', 'DESC')
            ->get();
            

        return response()->json([
            'message' => 'Tasks retrieved successfully.',
            'data' => $tasks,
        ], Response::HTTP_OK);
    }

    public function show(Task $task) : Response{
        return response()->json([
            'message' => 'Task retrieved successfully.',
            'data' => $task,
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

            if (array_key_exists('completed', $validated)) {
                $new_task->completed = $validated['completed'];
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

            if (array_key_exists('completed', $validated)) {
                $task->completed =  $validated['completed'];
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

            $task->completed = $validated['completed'];
            $task->save();

        } catch (\Exception $e) {

            return response()->json([
                'message' => "Something went wrong, please try again later.",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        return response()->json([
            'message' => 'Task completed updated successfully.',
            'data' => $task,
        ], Response::HTTP_OK);
    }
}
