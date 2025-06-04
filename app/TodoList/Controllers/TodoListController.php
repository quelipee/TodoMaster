<?php

namespace App\TodoList\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\TodoList\Models\TodoList;
use App\TodoList\Requests\TodoListRequest;
use App\TodoList\Status;
use App\TodoList\TodoListContracts;
use App\TodoList\TodoListDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
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
    public function index(Request $request): View|RedirectResponse
    {
        $status = $request->get("status");

        if (!in_array($status, [Status::Pending->value, Status::Completed->value])) {
            return redirect()->route('dashboard');
        }

        $todolist = $this->getStatusTodo($status);

        return view('dashboard', compact('todolist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('formTodo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoListRequest $request): RedirectResponse
    {
        $todo = $this->contracts->newTodo(TodoListDTO::FromValidatedRequest($request));
        return redirect()->route('todolist.index', ['status' => $todo->status]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = TodoList::findOrFail($id);
        return \response()->view('show',compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $todo = TodoList::findOrFail($id);
        return response()->view('formTodo', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoListRequest $request, string $id): RedirectResponse
    {
        $todo = $this->contracts->updatedTodo(TodoListDTO::FromValidatedRequest($request), $id);
        return redirect()->route('todolist.index', ['status' => $todo->status]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->contracts->deleteTodo($id);
        return redirect()->route('todolist.index');
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

    /**
     * @param mixed $status
     * @return AbstractPaginator|LengthAwarePaginator
     */
    public function getStatusTodo(mixed $status): AbstractPaginator|LengthAwarePaginator
    {
        return TodoList::query()->where('status', $status)
            ->where('userId', Auth::id())
            ->paginate(10)
            ->withQueryString();
    }
}
