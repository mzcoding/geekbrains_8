@extends('layouts.admin')
@section('title') Список новостей  - @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список новостей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('news.create') }}" class="btn btn-sm btn-outline-secondary">Добавить новость</a>

            </div>

        </div>
    </div>
    <div class="table-responsive">
        @if(session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Категория</th>
                <th>Заголовок</th>
                <th>Статус</th>
                <th>Дата добавления</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($newsList as $news)
                <tr>
                    <td>{{ $news->id }}</td>
                    <td>{{ $news->category->title }}</td>
                    <td>{{ $news->title }}</td>
                    <td>{{ $news->status }}</td>
                    <td>{{ $news->created_at->format('d-m-Y H:i') }}</td>
                    <td><a href="{{ route('news.edit', ['news' => $news]) }}">Ред.</a>&nbsp;||&nbsp;
                        <a href="javascript:;" class="delete" rel="{{ $news->id }}">Уд.</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"><h3>Записей нет</h3></td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div>{{ $newsList->links() }}</div>
    </div>


@endsection
@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const el = document.querySelectorAll(".delete");
            console.log(el);
            el.forEach(function(e, k) {
               e.addEventListener("click", function() {
                    const rel = e.getAttribute("rel");
                    if(confirm("Подтверждаете удаление c #ID " + rel + " ?")) {
                        submit("/admin/news/" + rel).then(() => {
                            location.reload();
                        })
                    }
                });
            })

        });

        async function submit(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });


            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
