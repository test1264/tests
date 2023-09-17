@if (isset($page->title))
    <title>{{ $page->title }}</title>
@else
<title>Page</title>
@endif

@isset($page->description)
    <meta name="description" content="{{ $page->description }}">
@endisset
@isset($page->keywords)
    <meta name="keywords" content="{{ $page->keywords }}">
@endisset
