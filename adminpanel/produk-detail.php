<?php
require "session.php";
require "../koneksi.php";

// Ambil ID produk dari GET
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Set ID dari GET atau 0 jika tidak ada
$queryProduk = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id WHERE a.id = '$id'");
$dataProduk = mysqli_fetch_array($queryProduk);
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

// Cek apakah produk ditemukan
if (!$dataProduk) {
    echo '<div class="alert alert-danger" role="alert">Produk tidak ditemukan!</div>';
    exit;
}

// Ambil daftar kategori untuk dropdown kecuali kategori saat ini
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id != '$dataProduk[kategori_id]'");

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detail Produk</title>
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-3">
        <h2>Detail Produk</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($dataProduk['nama']); ?>" class="form-control" autocomplete="off">
                </div>

                <label for="kategori">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-control mt-1" required>
                    <option value="<?php echo $dataProduk['kategori_id']; ?>">
                        <?php echo htmlspecialchars($dataProduk['nama_kategori']); ?>
                    </option>

                    <?php while ($kategoriData = mysqli_fetch_array($queryKategori)) { ?>
                        <option value="<?php echo $kategoriData['id']; ?>">
                            <?php echo htmlspecialchars($kategoriData['nama']); ?>
                        </option>
                    <?php } ?>
                </select>

                <div class="mt-1">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" value="<?php echo $dataProduk['harga']?>" name="harga" required>
                </div>

                <div>
                    <label for="currenFoto">Foto Produk Sekarang</label>
                    <img src="../foto/<?php echo $dataProduk['foto']?>" alt="" width="300px" class="mt-3">
                </div>

                <div class="mt-1">
                    <label for="foto">Pilih Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>

                <div class="mt-1">
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo $dataProduk['detail'];?></textarea>
                </div>

                <div class="mt-1">
                    <label for="ketersediaan_stok">Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="<?php echo $dataProduk['ketersediaan_stok']?>"><?php echo $dataProduk['ketersediaan_stok']?></option>
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>

                <div class="mt-2 mb-5 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                    <a href="produk.php" class="btn btn-primary">Kembali</a>
                </div>
            </form>

            <?php
            if(isset($_POST['simpan'])){
                $nama = htmlspecialchars($_POST['nama']);
                $kategori_id = htmlspecialchars($_POST['kategori_id']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);
                
                $target_dir = "../foto/";
                $nama_file = $_FILES['foto']['name'];
                $error = $_FILES['foto']['error'];
                $size = $_FILES['foto']['size'];
                $typeFoto = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
                $randomFileName = generateRandomString(20) . "." . $typeFoto;

                if ($nama == '' || $kategori_id == '' || $harga == '') {
                    echo '<div class="alert alert-warning mt-3" role="alert">Nama, Kategori, dan Harga wajib diisi!</div>';
                } else {
                    if ($nama_file) {
                        if (!in_array($typeFoto, ['jpg', 'png', 'jpeg']) || $size > 2000000) {
                            echo '<div class="alert alert-warning mt-3" role="alert">Format gambar hanya JPG, JPEG, atau PNG dan ukuran maksimal 2MB!</div>';
                        } else {
                            move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $randomFileName);
                            $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori_id', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok', foto='$randomFileName' WHERE id='$id'");
                        }
                    } else {
                        $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori_id', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'");
                    }

                    if ($queryUpdate) {
                        echo '<div class="alert alert-success mt-3" role="alert">Produk berhasil diperbarui!</div>';
                    } else {
                        echo '<div class="alert alert-danger mt-3" role="alert">Gagal memperbarui produk: ' . mysqli_error($conn) . '</div>';
                    }
                }
            }

            if(isset($_POST['hapus'])) {
                $queryHapus = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
                if($queryHapus){
                    echo '<div class="alert alert-primary mt-3" role="alert">Produk berhasil dihapus!</div>';
                    header("Location: kategori.php");
                    exit;
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">Gagal menghapus kategori: ' . mysqli_error($conn) . '</div>';
                }
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
