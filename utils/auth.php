<?php
// Selalu mulai session di awal
session_start();

include '../config/config.php';

// Cek apakah form sudah disubmit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil username dari form
    $submitted_username = $_POST['username'];
    
    // --- MENGGUNAKAN PREPARED STATEMENT UNTUK KEAMANAN ---
    // 1. Siapkan query SQL untuk mencari username
    $stmt = $conn->prepare("SELECT id_admin, username, password FROM akun_admin WHERE username = ?");
    
    // Periksa apakah prepare berhasil
    if ($stmt === false) {
        die("Gagal mempersiapkan statement: " . $conn->error);
    }
    
    // 2. Ikat parameter username ke query
    $stmt->bind_param("s", $submitted_username);
    
    // 3. Eksekusi query
    $stmt->execute();
    
    // 4. Simpan hasil query
    $result = $stmt->get_result();
    
    // Cek apakah username ditemukan (hasilnya harus 1 baris)
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        // 5. Verifikasi password yang disubmit dengan hash di database
        if (password_verify($_POST['password'], $admin['password'])) {
            // Jika password cocok, login berhasil
            
            // Hapus session error jika ada
            unset($_SESSION['error_message']);

            // Buat session baru untuk status login
            $_SESSION['loggedin'] = true;
            $_SESSION['id_admin'] = $admin['id_admin'];
            $_SESSION['username'] = $admin['username'];

            // Arahkan ke halaman dashboard
            header("Location: ../admin/dashboard.php");
            exit;
            
        } else {
            // Jika password tidak cocok
            $_SESSION['error_message'] = "Username atau password salah!";
            header("Location: ../admin/index.php");
            exit;
        }
        
    } else {
        // Jika username tidak ditemukan di database
        $_SESSION['error_message'] = "Username tidak ada di database!";
        header("Location: ../admin/index.php");
        exit;
    }
    
    // Tutup statement
    $stmt->close();

} else {
    // Jika file diakses langsung, arahkan ke login
    header("Location: ../admin/index.php");
    exit;
}

// Tutup koneksi database
$conn->close();
?>