<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <h1>Upload Gambar</h1>
    
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" id="image">
        <input type="submit" name="upload" value="Upload Image">
    </form>
    
    <?php
    // Menampilkan gambar yang diunggah jika ada
    if (isset($_SESSION['uploaded_image'])) {
        echo '<h2>Gambar yang Diunggah:</h2>';
        echo '<img src="' . $_SESSION['uploaded_image'] . '" alt="Gambar yang diunggah">';
        unset($_SESSION['uploaded_image']); // Hapus session setelah menampilkan gambar
    }
    ?>
</body>
</html>