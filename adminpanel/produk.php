<?php
require "session.php";
require "../koneksi.php";

// Query untuk mendapatkan data produk dan kategori
$queryProduk = "SELECT produk.*, kategori.nama AS nama_kategori FROM produk JOIN kategori ON produk.kategori_id = kategori.id";
$produkResult = mysqli_query($conn, $queryProduk);

// Error handling jika query gagal
if (!$produkResult) {
    die("Query Error: " . mysqli_error($conn));
}

$jumlahProduk = mysqli_num_rows($produkResult);
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
        .kotak {
            border: solid;
        }
        .summary-kategori {
            background-color: #00b4d8;
            border-radius: 10px;
        }
        .produk {
            background-color: #ffb703;
            border-radius: 10px;
        }
        .dekorasi {
            text-decoration: none;
        }
        form div {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php require "navbar.php" ?>
    
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="dekorasi text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>

        <div class="mt-3">
            <h2>Tambah Produk</h2>
            <div class="mt-1">
                <a href="tambah-produk.php" class="btn btn-primary">Selanjutnya</a>
            </div>
            <h2 class="mt-2">List Produk</h2>

            <?php if ($jumlahProduk == 0) { ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Tidak ada data produk.
                </div>
            <?php } else { ?>
                <div class="table-responsive mt-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Ketersediaan Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while ($dataProduk = mysqli_fetch_array($produkResult)) { ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo htmlspecialchars($dataProduk['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($dataProduk['nama_kategori']); ?></td>
                                    <td><?php echo htmlspecialchars($dataProduk['harga']); ?></td>
                                    <td><?php echo htmlspecialchars($dataProduk['ketersediaan_stok']); ?></td>
                                    <td>
                                        <a href="produk-detail.php?id=<?php echo $dataProduk['id'];?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
</body>
</html>
