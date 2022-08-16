<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Post example on vue</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    @if(auth()->user())
        <script>window.appUser = @php echo auth()->user()->load(['roles']);@endphp</script>
    @else
        <script>window.appUser = {};</script>
    @endif
</head>

<body>
    <div id="app">
    </div>
</body>
</html>
