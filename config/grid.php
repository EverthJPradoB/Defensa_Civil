<?php

// Contraseña a cifrar
$password = "123";

// Bcrypt
$bcryptHash = password_hash($password, PASSWORD_BCRYPT);
echo "Bcrypt: " . $bcryptHash . "\n";

// SHA-256
$sha256Hash = hash("sha256", $password);
echo "SHA-256: " . $sha256Hash . "\n";
