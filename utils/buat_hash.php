<?php
// Masukkan password yang Anda inginkan di sini
$passwordAsli = 'admin123';

$hash = password_hash($passwordAsli, PASSWORD_DEFAULT);

echo "Password asli: " . $passwordAsli . "<br>";
echo "Hasil Hash: " . $hash;
?>