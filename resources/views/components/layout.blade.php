<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Barangay Certificate System' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    @auth
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-bold">Barangay Certificate System</h1>
                    @if(auth()->user()->isAdmin())
                        <span class="bg-yellow-500 text-xs px-2 py-1 rounded">Admin</span>
                    @endif
                </div>
                <div class="flex items-center space-x-4">
                    @if(auth()->user()->isResident())
                        <a href="{{ route('certificates.index') }}" class="hover:text-blue-200">My Requests</a>
                        <a href="{{ route('certificates.create') }}" class="hover:text-blue-200">New Request</a>
                    @endif
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.certificates.index') }}" class="hover:text-blue-200">All Requests</a>
                    @endif
                    <span class="text-sm">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-6 text-center">
            <p>&copy; {{ date('Y') }} Barangay Certificate System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
