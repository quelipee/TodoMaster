@php use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Bem-vindo à página de tarefas! de ' . $todo->title }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 space-y-4">

            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Título</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ $todo->title }}</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Descrição</h3>
                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $todo->description }}</p>
            </div>

            <div class="flex space-x-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Status</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $todo->status }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Usuário</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $todo->userId }}</p>
                </div>
            </div>

            <div class="flex space-x-6 text-sm text-gray-500 dark:text-gray-400">
                <div>
                    Criado em: {{ Carbon::parse($todo->created_at)->format('d/m/Y H:i') }}
                </div>
                <div>
                    Última atualização: {{ Carbon::parse($todo->updated_at)->format('d/m/Y H:i') }}
                </div>
                @if($todo->deleted_at)
                    <div class="text-red-500">
                        Excluído em: {{ Carbon::parse($todo->deleted_at)->format('d/m/Y H:i') }}
                    </div>
                @endif
            </div>

            <div class="flex justify-between space-x-4 mt-6">
                <a href="{{ route('todolist.edit', $todo->id) }}"
                   class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded">
                    Editar
                </a>
                <a href="{{ route('todolist.index') }}"
                   class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">
                    Voltar para lista
                </a>
            </div>
        </div>
    </div>

</x-app-layout>
