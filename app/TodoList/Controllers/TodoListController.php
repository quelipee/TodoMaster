<?php

namespace App\TodoList\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\TodoList\Models\TodoList;
use App\TodoList\Requests\TodoListRequest;
use App\TodoList\TodoListContracts;
use App\TodoList\TodoListDTO;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TodoListController extends Controller
{
    public function __construct(
        public TodoListContracts $contracts
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $status = $request->get("status");

        $tasks = TodoList::query()->where('status', $status)
            ->paginate(10)
            ->withQueryString();

        return response()
            ->view('todolist.index',
                compact('tasks', 'status'),
                ResponseAlias::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoListRequest $request): JsonResponse
    {
        $todo = $this->contracts->newTodo(TodoListDTO::FromValidatedRequest($request));
        return response()->json([
            'todo' => $todo,
            'message' => 'Todo created success!!'
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoListRequest $request, string $id): JsonResponse
    {
        $todo = $this->contracts->updatedTodo(TodoListDTO::FromValidatedRequest($request),$id);
        return response()->json([
            'message' => 'Todo updated success',
            'data' => $todo
        ], ResponseAlias::HTTP_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = TodoList::findOrFail($id);
        $todo->delete();

        return response()->json([
            'data' => $todo,
            'message' => 'Todo deleted with success!!'
        ], ResponseAlias::HTTP_NO_CONTENT);
    }

    public function restoreSoftDelete(string $id): JsonResponse
    {
        $todo = TodoList::onlyTrashed()->findOrFail($id);
        $todo->restore();
        return response()->json([
            'data' => $todo,
            'message' => "Restore Todo with success!!"
        ], ResponseAlias::HTTP_NO_CONTENT);
    }
}
