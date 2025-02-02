<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel + Livewire + Tailwind</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div x-data="{ open: true }" class="flex h-screen">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-auto">
            <div class="grid">
                <!-- Content Here -->
                <div class="col-span-2">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>