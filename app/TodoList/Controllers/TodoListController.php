<?php

namespace App\TodoList\Controllers;

use App\Http\Controllers\Controller;
use App\TodoList\Requests\TodoListRequest;
use App\TodoList\TodoListContracts;
use App\TodoList\TodoListDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TodoListController extends Controller
{
    public function __construct(
        public TodoListContracts $contracts
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
