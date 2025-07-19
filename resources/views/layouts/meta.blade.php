@section('meta')
    @if($metaData)
        <title>{{ $metaData['title'] ?? config('app.name') }}</title>
        <meta name="description" content="{{ $metaData['description'] ?? '' }}">
        <meta name="keywords" content="{{ $metaData['keywords'] ?? '' }}">
        <meta name="author" content="{{ $metaData['author'] ?? 'Travel Guide' }}">
        <meta property="og:title" content="{{ $metaData['title'] ?? 'Travel Guide' }}">
        <meta property="og:description" content="{{ $metaData['description'] ?? '' }}">
        <meta property="og:image" content="{{ $metaData['image'] ?? asset('images/default.png') }}">
        <meta property="og:url" content="{{ $metaData['url'] ?? url()->current() }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $metaData['title'] ?? 'Travel Guide' }}">
        <meta name="twitter:description" content="{{ $metaData['description'] ?? '' }}">
        <meta name="twitter:image" content="{{ $metaData['image'] ?? asset('images/default.png') }}">
    @endif
@endsection
