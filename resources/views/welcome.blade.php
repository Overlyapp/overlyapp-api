<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OverlyAPI Example</title>
    <script src="{{ mix('css/app.css') }}"></script>
</head>
<body class="antialiased">
    <main>
        <div id="app" class="px-4 py-5 my-5">
            <marker-manager/>
        </div>
    </main>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
