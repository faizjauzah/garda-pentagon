<?php
// Mulai session untuk menampilkan pesan error jika ada
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-sm p-8 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Selamat Datang</h1>

        <form action="../utils/auth.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-semibold mb-2">Username</label>
                <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-200" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-200" required>
            </div>
            
            <?php
            // Menampilkan pesan error jika login gagal
            if (isset($_SESSION['error_message'])) {
                echo '<p class="text-red-500 text-sm text-center mb-4">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']);
            }
            ?>

            <button type="submit" class="w-full bg-[#1d4c08] hover:bg-[#163805] text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                Login
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="../index.php" class="text-sm text-gray-600 hover:text-green-800 hover:underline">
                &larr; Kembali ke Halaman Utama
            </a>
        </div>
    </div>

</body>
</html>