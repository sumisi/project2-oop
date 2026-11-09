<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <title>Заявки</title>
</head>
<body>
    <h1 class="text-[40px]">Заявки</h1>
    <a href="/reports/create" class="text-[40px] text-red-500">Создать заявку</a>
    <div class="container mx-auto">
    <div>
        <h2>Фильтрация по новизне:</h2>
        <span>
            <a href="{{route('reports.index', ['sort' => 'desc', 'status' => $status])}}">Сначала новые</a>
            <a href="{{route('reports.index', ['sort' => 'asc', 'status' => $status])}}">Сначала старные</a>
        </span>
    </div>
    <div>
        <h2>Фильтрация по по статусу:</h2>
        <ul>
            @foreach ($statuses as $status)
                <li>
                    <a href="{{route('reports.index', ['sort' => $sort,'status' => $status->id])}}">{{$status->name}}</a>
                </li>
            @endforeach
        </ul>
    </div> 
        <div class="grid grid-cols-4 gap-2 place-items-center">
            @foreach($reports as $report)
            <div class="bg-amber-300 h-[300px] p-[10px] w-[300px]">
                {{$report->number}}<br>
                {{$report->des}}<br>
                {{$report->created_at}}<br>
                <a href="{{route('reports.edit', $report->id)}}">
                    Изменить заявку
                </a><br>
                <form action="{{route('reports.destroy', $report->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Удалить заявку" class="text-red-500 text-[20px] font-bold">
                </form>
            </div>
            @endforeach
        </div>
        {{$reports->appends(request()->query())->links(  )}}
    </div>
</body>
</html>