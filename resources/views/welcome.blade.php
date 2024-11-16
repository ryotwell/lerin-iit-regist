<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }} - LERIN (Lembaga Edukasi Riset dan Inovasi) NTB</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script>
        const faqQuestions = @json(config('lerin.faq'));
    </script>

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/js/app.tsx', 'resources/css/app.css'])
</head>
<body class="font-sans antialiased">
    <div id="root"></div>
</body>
</html>
