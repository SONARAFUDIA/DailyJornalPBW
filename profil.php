<?php
include "koneksi.php";
include "upload_foto.php";

// Ambil ID user yang sedang login
$user_id = 2; // Gantilah ini dengan mekanisme autentikasi yang sesuai

// Ambil data user yang sedang masuk
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Jika user tidak ditemukan
if (!$user) {
    echo "<script>alert('User tidak ditemukan!'); window.location='admin.php';</script>";
    exit;
}

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
    $stmt = $conn->prepare("UPDATE user SET password = ?, foto = ? WHERE id = ?");
    $stmt->bind_param("ssi", $password, $foto, $user_id);

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
