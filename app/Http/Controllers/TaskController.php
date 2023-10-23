<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index() : Response{

        $tasks = Task::get();

        return response()->json([
            'message' => 'Tasks retrieved successfully.',
            'data' => $tasks,
        ], Response::HTTP_OK);
    }

    public function store(): Response{

        try {

            $new_task = new Task;
            $new_task->name = "Test";
            $new_task->description = "Test Description";
            $new_task->created_by = "Dave";
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
}
