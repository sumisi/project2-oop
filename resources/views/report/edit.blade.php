<x-app-layout>
    <body>
        <a href="/reports" class="text-[40px] text-red-500">Посмотреть заявки</a>
        <form action="{{route('reports.update', $report->id)}}" method = "POST">
            @csrf
            @method('put')
            <input type="text" placeholder="Введите номер авто" required name="number" value="{{$report->number}}"><br>
            <input type="textarea" placeholder="Описание" required name="des" value="{{$report->des}}"><br>
            <input type="submit" value="Обновить">
        </form>
    </body>
</x-app-layout>