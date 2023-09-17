@extends('app')

@section('content')
    {!! $page->body !!}

    @push('scripts')
        <div>pushed part</div>
        <script src="js/extra.js"></script>
    @endpush
@endsection
