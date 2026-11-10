<x-app-layout>
    <body>
        <a href="/reports" class="text-[40px] text-red-500">Посмотреть заявки</a>
        <form action="{{route('reports.store')}}" method = "POST">
            @csrf
            <input type="text" placeholder="Введите номер авто" required name="number"><br>
            <input type="text" placeholder="Описание" required name="des"><br>
            <input type="submit" value="Создать">
        </form>
    </body>
</x-app-layout>