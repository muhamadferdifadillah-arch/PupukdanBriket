<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Manfaatin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 flex items-center justify-center px-4">

    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">

        <!-- LOGO -->
        <div class="text-center mb-6">
            <img src="{{ asset('admin/assets/images/logos/logom.png') }}" alt="Logo" class="w-20 mx-auto mb-3">
            <h2 class="text-2xl font-bold text-gray-700">Login Admin</h2>
            <p class="text-sm text-gray-500">Manfaatin Dashboard</p>
        </div>

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border rounded-lg"
                    placeholder="admin@manfaatin.com" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border rounded-lg" />
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2" />
                    Ingat saya
                </label>
                <a href="#" class="text-sm text-blue-600">Lupa password?</a>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg font-medium">
                Login
            </button>
        </form>


        <p class="text-center text-gray-500 text-sm mt-6">
            © 2025 Manfaatin. All rights reserved.
        </p>

    </div>

</body>

</html>