<?php
session_start();

include "../../../../config/koneksi.php";
include "Peminjaman.php";
include "Pesan.php";

if ($_GET['aksi'] == "edit") {
    $id_user = $_POST['IdUser'];
    $nim = $_POST['nim'];
    $fullname = $_POST['Fullname'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $prodi = $_POST['prodi'];
    $alamat = $_POST['Alamat'];

    // Check if a new profile picture is uploaded
    if ($_FILES['ProfilePicture']['name'] !== '') {
        $targetDir = "../../../../assets/dist/img"; // Specify the directory to store the uploaded images
        $profilePicture = basename($_FILES["ProfilePicture"]["name"]);
        $targetFilePath = $targetDir . $profilePicture;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if the uploaded file is an image
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array(strtolower($fileType), $allowedTypes)) {
            $_SESSION['gagal'] = "File yang diunggah harus berupa gambar (JPG, JPEG, PNG, GIF).";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($_FILES["ProfilePicture"]["tmp_name"], $targetFilePath)) {
            $_SESSION['gagal'] = "Terjadi kesalahan saat mengunggah gambar.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Update the profile picture in the database
        $query = "UPDATE user SET profile_picture = '$profilePicture' WHERE id_user = $id_user";
        mysqli_query($koneksi, $query);
    }

    // Update other profile information in the database
    $query = "UPDATE user SET nim = '$nim', fullname = '$fullname', username = '$username', password = '$password', prodi = '$prodi', alamat = '$alamat'";
    $query .= " WHERE id_user = $id_user";

    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        $_SESSION['berhasil'] = "Update profil berhasil !";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Update profil gagal !";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
?>