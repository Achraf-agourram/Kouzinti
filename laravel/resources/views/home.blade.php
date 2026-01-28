<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @if (session('success'))
        <div class="absolute top-0 z-50 top-0 mb-4 rounded-lg bg-green-300 border border-green-400 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if (session('failed'))
        <div class="absolute top-0 z-50 mb-4 rounded-lg bg-red-300 border border-red-400 px-4 py-3 text-red-800">
            {{ session('failed') }}
        </div>
    @endif


    <h1>hello</h1>
</body>
</html>