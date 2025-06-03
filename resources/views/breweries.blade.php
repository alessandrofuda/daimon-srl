<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex-grow container mx-auto flex flex-col items-center justify-center p-6">
    <div class="w-full max-w-xl bg-white p-8 rounded-lg shadow-xl mb-8" >

        <ul class="list-disc pl-5 space-y-2">
            @foreach($breweries as $brewerie)
                <li class="border p-2">
                    <div>Name: {{$brewerie['name'] ?? 'N/A'}}</div>
                    <div>Type: {{$brewerie['brewery_type'] ?? 'N/A'}}</div>
                    <div>Address: {{$brewerie['address_1'] ?? 'N/A'}}</div>
                    <div>City: {{$brewerie['city'] ?? 'N/A'}}</div>
                    <div>State: {{$brewerie['state_province'] ?? 'N/A'}}</div>
                </li>
            @endforeach
        </ul>

        @php
            $currentPage = request('page') ?? 1;
            $linkStyle = 'text-blue-600 hover:text-blue-800 underline font-medium';
            $totalPages = 100; // !IMP: valore arbitrario. Il totalPages andrebbe calcolato con una seconda chiamata Api per avere il totale degli items (vedi note nel README)
        @endphp

        <div class="pagination text-center italic mt-6">
            @if($currentPage > 1)
                <a class="{{ $linkStyle }}" href="{{ request()->fullUrlWithQuery(['page' => (int) $currentPage-1]) }}">Previous</a>
            @endif

            <span class="mx-10">Current page: {{ $currentPage }}</span>

            @if($currentPage < $totalPages)
                    <a class="{{ $linkStyle }}" href="{{ request()->fullUrlWithQuery(['page' => (int) $currentPage+1]) }}">Next</a>
            @endif
        </div>

    </div>
</body>
</html>
