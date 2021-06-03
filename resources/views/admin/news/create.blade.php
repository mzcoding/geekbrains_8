@extends('layouts.admin')
@section('title') Добавить новость - @parent @stop
@section('content')
    <div class="col-md-8">
        <br>
        <h1 class="h2">Добавить новость</h1>
        <div>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <form method="post" action="{{ route('news.store', ['name' => 'test']) }}">
                @csrf
                <div class="form-group">
                    <label for="title">Заголовок *</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="slug">Слаг *</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                </div>
                <div class="form-group">
                    <label for="image">Логотип</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="description">Описание *</label>
                    <textarea class="form-control" name="description" id="description">{!! old('description') !!}</textarea>
                </div>
                <br>
                <button class="btn btn-success" type="submit">Добавить новость</button>
            </form>

        </div>
    </div>



@endsection