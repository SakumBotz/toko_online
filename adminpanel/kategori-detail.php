<?php
require "session.php";
require "../koneksi.php";

// Mengamankan input $id dengan filter
$id = isset($_GET['d']) ? intval($_GET['d']) : 0;

// Mengambil data kategori berdasarkan ID
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($queryKategori);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Detail Kategori</title>
</head>
<body>
    <?php require "navbar.php"; ?>
    

    <div class="container mt-3">
        <h2>Detail Kategori</h2>

        <div class="col-12 col-md-6">
            <form action="" method="post">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>">

                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" name="btnEdit">Edit</button>
                    <button type="submit" class="btn btn-danger" name="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Delete</button>
                </div>
            </form>

            <?php
            // Fungsi Edit Kategori
            if (isset($_POST['btnEdit'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                // Cek apakah nama kategori sama
                if ($data['nama'] === $kategori) {
                    echo '<div class="alert alert-warning mt-3" role="alert">Kategori sudah tersedia!</div>';
                } else {
                    // Cek apakah kategori dengan nama yang sama sudah ada
                    $queryCheck = mysqli_query($conn, "SELECT * FROM kategori WHERE nama='$kategori'");
                    $jumlahData = mysqli_num_rows($queryCheck);

                    if ($jumlahData > 0) {
                        echo '<div class="alert alert-warning mt-3" role="alert">Kategori dengan nama ini sudah ada!</div>';
                    } else {
                        // Update nama kategori
                        $queryUpdate = mysqli_query($conn, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");

                        if ($queryUpdate) {
                            echo '<div class="alert alert-primary mt-3" role="alert">Kategori berhasil diupdate!</div>';
                            header("Location: kategori.php");
                            exit;
                        } else {
                            echo '<div class="alert alert-danger mt-3" role="alert">Gagal mengupdate kategori: ' . mysqli_error($conn) . '</div>';
                        }
                    }
                }
            }

            // Fungsi Delete Kategori
            if (isset($_POST["delete"])) {
                // Cek apakah ada produk terkait dengan kategori ini
                $queryCheckProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$id'");
                $jumlahProduk = mysqli_num_rows($queryCheckProduk);

                if ($jumlahProduk > 0) {
                    echo '<div class="alert alert-warning mt-3" role="alert">Kategori tidak dapat dihapus karena terkait dengan ' . $jumlahProduk . ' produk! <a href="kategori.php">kembali</a></div>';
                } else {
                    // Hapus kategori
                    $queryDeleteKategori = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");

                    if ($queryDeleteKategori) {
                        echo '<div class="alert alert-primary mt-3" role="alert">Kategori berhasil dihapus!</div>';
                        header("Location: kategori.php");
                        exit;
                    } else {
                        echo '<div class="alert alert-danger mt-3" role="alert">Gagal menghapus kategori: ' . mysqli_error($conn) . '</div>';
                    }
                }
            }
            ?>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
</body>
</html>
