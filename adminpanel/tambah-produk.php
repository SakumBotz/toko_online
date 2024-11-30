<?php
require "session.php";
require "../koneksi.php";

// Query untuk mendapatkan data produk dan kategori
$produk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($produk);
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

function generateRandomString($length = 10){
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Produk</title>
    <style>
        .kotak { border: solid; }
        .summary-kategori { background-color: #00b4d8; border-radius: 10px; }
        .produk { background-color: #ffb703; border-radius: 10px; }
        .dekorasi { text-decoration: none; }
        form div { margin-bottom: 10px; }
    </style>
</head>
<body>
    <?php require "navbar.php" ?>
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../adminpanel" class="dekorasi text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
            </ol>
        </nav>
        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Form Fields -->
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                <div class="mb-10 mt-2">
                    <label for="kategori">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control mt-1" required>
                        <option value="">Pilih Salah Satu</option>
                        <?php while ($data = mysqli_fetch_array($kategori)) { ?>
                            <option value="<?php echo $data['id'] ?>"><?php echo $data['nama']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mt-1">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" required>
                </div>
                <div class="mt-1">
                    <label for="foto">Pilih Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div class="mt-1">
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="mt-1">
                    <label for="ketersediaan_stok">Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <a href="produk.php" class="btn btn-primary">Kembali</a>
                </div>
            </form>
            
            <?php
            if (isset($_POST['simpan'])) {
                // Mengambil data dari form
                $nama = htmlspecialchars($_POST['nama']);
                $kategori_id = htmlspecialchars($_POST['kategori_id']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                // Validasi koneksi
                if (!$conn) {
                    die('<div class="alert alert-danger mt-3" role="alert">Koneksi database gagal: ' . mysqli_connect_error() . '</div>');
                }

                $target_dir = "../foto/";
                $nama_file = $_FILES['foto']['name'];
                $error = $_FILES['foto']['error'];
                $size = $_FILES['foto']['size'];
                $typeFoto = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
                $randomFileName = generateRandomString(20) . "." . $typeFoto;

                if ($nama == '' || $kategori_id == '' || $harga == '') {
                    echo '<div class="alert alert-warning mt-3" role="alert">Nama, Kategori, dan Harga wajib diisi!</div>';
                } else {
                    if ($nama_file != '') {
                        if ($error === UPLOAD_ERR_OK) {
                            if ($size > 10000000) {
                                echo '<div class="alert alert-warning mt-3" role="alert">Foto tidak boleh lebih dari 10MB!</div>';
                            } elseif (!in_array($typeFoto, ['jpg', 'png', 'jpeg', 'gif'])) {
                                echo '<div class="alert alert-warning mt-3" role="alert">Type foto tidak sesuai!</div>';
                            } else {
                                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $randomFileName)) {
                                    echo '<div class="alert alert-success mt-3" role="alert">File berhasil diunggah!</div>';
                                } else {
                                    echo '<div class="alert alert-danger mt-3" role="alert">Terjadi kesalahan saat mengunggah foto!</div>';
                                }
                            }
                        } else {
                            echo '<div class="alert alert-warning mt-3" role="alert">Foto wajib diunggah!</div>';
                        }
                    }

                    // Query untuk menambahkan data produk
                    $tambah = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) VALUES ('$kategori_id', '$nama', '$harga', '$randomFileName', '$detail', '$ketersediaan_stok')");
                    
                    if ($tambah) {
                        echo '<div class="alert alert-success mt-3" role="alert">Produk Berhasil Tersimpan!</div>';
                    } else {
                        // Menampilkan error query
                        echo '<div class="alert alert-danger mt-3" role="alert">Produk gagal disimpan: ' . mysqli_error($conn) . '</div>';
                    }
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
</body>
</html>
