<header class="sticky top-0 flex justify-between items-center bg-white p-4 border-b border-gray-200">
    <a href="#" class="text-xl font-semibold">Dashboard</a>
    <div class="flex items-center space-x-4">
        <input type="text" class="border rounded-md px-3 py-2 text-sm" placeholder="Search...">
        <div class="relative">
            <button class="flex items-center">
                <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="w-8 h-8 rounded-full">
            </button>
            <div class="absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-48">
                <a href="#" class="block px-4 py-2 text-sm">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm">Settings</a>
                <a href="#" class="block px-4 py-2 text-sm">Logout</a>
            </div>
        </div>
    </div>
</header>
