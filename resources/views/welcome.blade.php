<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="canonical" href="https://iit.lerinntb.com" />
	<meta property="og:locale" content="id_ID" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ config('app.name', 'Laravel') }} - LERIN NTB (Lembaga Edukasi Riset & Inovasi Nusa Tenggara Barat)" />
	<meta property="og:description" content="UNHAZ x LERIN presents the Robotic Competition. Show your team's skill and innovation!" />
	<meta property="og:url" content="https://iit.lerinntb.com" />
	<meta property="og:site_name" content="LERIN NTB (Lembaga Edukasi Riset & Inovasi Nusa Tenggara Barat)" />
	<meta property="og:image" content="{{ url('/thumbnail.jpg') }}" />
	<meta name="twitter:card" content="summary_large_image" />

    <title>{{ config('app.name', 'Laravel') }} - LERIN NTB (Lembaga Edukasi Riset & Inovasi Nusa Tenggara Barat)</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/js/app.tsx', 'resources/css/app.css'])
</head>
<body class="font-sans antialiased">
    <div id="root"></div>
</body>
</html>
