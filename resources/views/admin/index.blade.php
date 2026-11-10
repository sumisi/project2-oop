@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <body>
    <h1>Админ панель</h1>
    <h2 class="text-[40px]">Заявки</h2>
    <a href="/reports/create" class="text-[40px] text-red-500">Создать заявку</a>
<div class="w-full p-4">
    <div class="w-full overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full table-auto border-collapse text-left">
            <thead class="bg-amber-400 text-gray-800 font-bold border-b border-amber-500">
                <tr>
                    <th class="px-6 py-3 text-sm">Номер</th>
                    <th class="px-6 py-3 text-sm w-1/2">Описание</th> 
                    <th class="px-6 py-3 text-sm">Дата создания</th>
                    <th class="px-6 py-3 text-sm">Статус</th>
                    <th class="px-6 py-3 text-sm text-center">Действия</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($reports as $report)
                <tr class="hover:bg-amber-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $report->number }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 break-words"> <!-- Убрано truncate, добавлено break-words -->
                        {{ $report->des }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                        {{ $report->created_at->format('d.m.Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                            {{ $report->status->name ?? 'Без статуса' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('reports.edit', $report->id) }}" class="text-blue-600 hover:text-blue-900 font-medium transition-colors">
                                Изменить
                            </a>
                            <span class="text-gray-300">|</span>
                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold transition-colors">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    </body>
</x-app-layout>