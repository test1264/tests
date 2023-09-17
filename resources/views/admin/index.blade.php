@extends('app')

@section('content')
    <div class="container">
        <form class="admin-form" action="admin" method="post">
            @csrf
            <label for="slug">slug</label>
            <input type="text" class="form-control" name="slug">
            <label for="title">title</label>
            <input type="text" class="form-control" name="title">
            <label for="description">description</label>
            <input type="text" class="form-control" name="description">
            <label for="keywords">keywords</label>
            <input type="text" class="form-control" name="keywords">
            <label for="body">content</label>
            <textarea class="form-control" rows="6" cols="80" name="body"></textarea>

            <button type="submit" class="btn btn-outline-primary">Добавить</button>
        </form>
    </div>
@endsection