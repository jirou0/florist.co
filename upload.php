<?php
session_start();

// Folder penyimpanan gambar
$target_dir = "uploaded_images/";

if(isset($_POST['upload'])){
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    
    // Cek apakah jenis file yang diunggah adalah gambar
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if(in_array($file_extension, $allowed_types)){
        // Pindahkan gambar ke folder penyimpanan
        $target_file = $target_dir . basename($file_name);
        move_uploaded_file($file_tmp, $target_file);

        // Simpan path gambar ke dalam session
        $_SESSION['uploaded_image'] = $target_file;

        header("Location: upload_image.php"); // Redirect kembali ke halaman utama
    }else{
        echo "Jenis file yang diunggah tidak diizinkan.";
    }
}
?>