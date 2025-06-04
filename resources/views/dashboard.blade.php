@php use App\TodoList\Status; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">

            <div class="flex justify-between">
                <form method="GET" action="{{ route('todolist.index') }}" class="flex items-center space-x-4">
                    <label for="status" class="text-sm text-gray-700 dark:text-gray-300 font-semibold">Filtrar por
                        status:</label>
                    <select name="status" id="status" class="rounded-lg p-1 bg-white dark:bg-gray-700 dark:text-white">
                        <option value="">Todos</option>
                        <option value="Pending" {{ request('status') === Status::Pending->value ? 'selected' : '' }}>
                            Pendentes
                        </option>
                        <option value="Completed" {{ request('status') === Status::Completed->value ? 'selected' : '' }}>
                            Concluídas
                        </option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filtrar
                    </button>
                </form>

                <a href="{{ route('todolist.create') }}"
                   class="inline-block mb-4 px-4 py-2 text-white rounded transition">
                    + Novo Todo
                </a>
            </div>

            @foreach($todolist as $todo)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100 space-y-2">
                        <div class="flex justify-between">
                            <h2 class="text-lg font-semibold">#{{ $todo['id'] }} - {{ $todo['title'] }}</h2>


                            <div class="flex justify-end">

                                <a href="{{ route('todolist.show', $todo->id) }}"
                                   class="inline-block rounded transition text-white px-3 py-1">
                                    Visualizar
                                </a>

                                <form action="{{ route('todolist.destroy', $todo['id']) }}" method="POST"
                                      onsubmit="return confirm('Tem certeza que quer deletar este item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white px-3 py-1 rounded">
                                        Deletar
                                    </button>
                                </form>
                            </div>

                        </div>
                        <div onclick="window.location='{{ route('todolist.edit', $todo['id']) }}'"
                             class="space-y-1">
                            <p class="text-sm text-gray-400">Status: <span
                                    class="font-medium">{{ $todo['status'] }}</span>
                            </p>
                            <p class="text-sm">Descrição: {{ $todo['description'] }}</p>
                            <p class="text-sm text-gray-400">Criado
                                em: {{ \Carbon\Carbon::parse($todo['created_at'])->format('d/m/Y H:i') }}</p>
                            <p class="text-sm text-gray-400">Última
                                atualização: {{ \Carbon\Carbon::parse($todo['updated_at'])->format('d/m/Y H:i') }}</p>
                            <p class="text-sm text-gray-400">Usuário: {{ $todo['userId'] }}</p>
                            @if($todo['deleted_at'])
                                <p class="text-red-500 text-sm">Excluído
                                    em: {{ \Carbon\Carbon::parse($todo['deleted_at'])->format('d/m/Y H:i') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="mt-4">
                {{ $todolist->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
onclick="window.location='{{ route('todolist.edit', $todo['id']) }}'"
