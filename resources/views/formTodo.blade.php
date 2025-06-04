@php use App\TodoList\Status; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($todo) ? '✏️ Editar Tarefa: ' . $todo->title : '📝 Criar Nova Tarefa' }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <form method="POST"
                  action="{{ isset($todo) ? route('todolist.update', $todo->id) : route('todolist.store') }}">
                @csrf
                @if(isset($todo))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Título</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title', $todo->title ?? '') }}"
                           class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:text-white" required>
                </div>

                <div class="mb-4">
                    <label for="description"
                           class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Descrição</label>
                    <textarea name="description" id="description"
                              class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:text-white"
                              rows="4">{{ old('description', $todo->description ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Status</label>
                    <select name="status" id="status"
                            class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:text-white">
                        <option
                            value="{{ Status::Pending->value }}" {{ old('status', $todo->status ?? '') === Status::Pending->value ? 'selected' : '' }}>
                            Pendente
                        </option>
                        <option
                            value="{{ Status::Completed->value }}" {{ old('status', $todo->status ?? '') === Status::Completed->value ? 'selected' : '' }}>
                            Concluído
                        </option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('dashboard') }}"
                       class="mr-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancelar</a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        {{ isset($todo) ? 'Atualizar' : 'Criar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
