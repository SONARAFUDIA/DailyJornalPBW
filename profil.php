<?php
include "koneksi.php";
include "upload_foto.php";


// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil username dari sesi
$username = $_SESSION['username'];

// Ambil data user berdasarkan username
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $password = !empty($_POST['password']) ? md5($_POST['password']) : $user['password'];
    $foto = $user['foto'];

    // Proses upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $cek_upload = upload_foto($_FILES['foto']);

        if ($cek_upload['status']) {
            $foto = $cek_upload['message'];

            // Hapus foto lama jika ada
            if (!empty($user['foto']) && file_exists('img/' . $user['foto'])) {
                unlink('img/' . $user['foto']);
            }
        } else {
            echo "<script>alert('" . $cek_upload['message'] . "');</script>";
        }
    }

    // Update data user
    $stmt = $conn->prepare("UPDATE user SET password = ?, foto = ? WHERE username = ?");
    $stmt->bind_param("sss", $password, $foto, $username);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='admin.php?page=profil';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}

$stmt->close();
$conn->close();
?>

<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="password" class="form-label">Password Baru</label>
        <input type="password" class="form-control" name="password" placeholder="Masukkan Password Baru">
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Ganti Foto Profil</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="mb-3">
        <label for="foto_lama" class="form-label">Foto Lama</label><br>
        <?php if (!empty($user['foto']) && file_exists('img/' . $user['foto'])) : ?>
            <img src="img/<?= $user['foto'] ?>" width="100">
        <?php else : ?>
            <p>Tidak ada foto</p>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
    </div>
</form>