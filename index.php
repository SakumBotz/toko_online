<?php
    require "koneksi.php";
    $queryProduk = mysqli_query($conn,"SELECT id, nama, harga, foto, detail FROM produk LIMIT 8");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Rina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Banner Styling */
        .baner {
            height: 80vh;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('foto/baner.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            animation: fadeIn 2s ease;
        }

        /* Fade-in animation for the banner */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Product Card Styling */
        .product-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
        .product-card img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        /* About Us Section Styling */
        .about-us {
            background-color: #f8f9fa;
            padding: 4rem 0;
        }
        .about-us h3 {
            font-weight: bold;
            color: #343a40;
        }
        .about-us p {
            color: #6c757d;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Social Icons */
        .social-icons {
            margin-top: 1.5rem;
        }
        .social-icons a {
            color: #343a40;
            margin: 0 10px;
            transition: color 0.3s;
        }
        .social-icons a:hover {
            color: #007bff;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
// Fungsi untuk membuat slug dari string
function buatSlug($string) {
    $string = strtolower(trim($string));
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/[\s-]+/', ' ', $string);
    $string = str_replace(' ', '-', $string);
    return $string;
}
?>

<!-- Navbar -->
<?php require "navbar.php"; ?>

<!-- Banner -->
<div class="baner container-fluid d-flex align-items-center">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Toko Rina</h1>
        <p class="lead">Mau Cari Apa?</p>
        <div class="col-md-8 offset-md-2">
            <form action="produk.php" method="get">
                <div class="input-group input-group-lg my-4">
                    <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Nama Barang" name="keyword" name="kategori">
                    <button class="btn btn-primary" type="submit">Telusuri</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Kategori Terlaris -->
<div class="container-fluid py-4">
    <div class="container text-center">
        <h3>Pilihan Kategori</h3>
        <section class="my-5">
            <div class="container">
                <div class="row">
                    <!-- Card 1: Jajanan -->
                    <div class="col-md-3 mb-4">
                        <div class="card product-card h-100">
                            <img src="foto/jajanan.jpg" class="card-img-top" alt="Jajanan">
                            <div class="card-body">
                                <h6 class="card-title">Jajanan</h6>
                                <p class="card-text">Tersedia biskuit, permen, kacang, dan snack ringan lainnya.</p>
                                <a href="produk.php?kategori=<?php echo buatSlug('Jajanan'); ?>" class="btn btn-primary mt-auto">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2: Minuman -->
                    <div class="col-md-3 mb-4">
                        <div class="card product-card h-100">
                            <img src="foto/minuman.jpg" class="card-img-top" alt="Minuman">
                            <div class="card-body">
                                <h6 class="card-title">Minuman</h6>
                                <p class="card-text">Minuman dalam kemasan botol, galon, dan minuman bersoda.</p>
                                <a href="produk.php?kategori=<?php echo buatSlug('Minuman'); ?>" class="btn btn-primary mt-auto">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3: Sembako -->
                    <div class="col-md-3 mb-4">
                        <div class="card product-card h-100">
                            <img src="foto/sembako.jpg" class="card-img-top" alt="Sembako">
                            <div class="card-body">
                                <h6 class="card-title">Sembako</h6>
                                <p class="card-text">Berbagai bahan sembako yang lengkap.</p>
                                <a href="produk.php?kategori=<?php echo buatSlug('Sembako'); ?>" class="btn btn-primary mt-auto">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4: Obat -->
                    <div class="col-md-3 mb-4">
                        <div class="card product-card h-100">
                            <img src="foto/obat.jpg" class="card-img-top" alt="Obat">
                            <div class="card-body">
                                <h6 class="card-title">Obat</h6>
                                <p class="card-text">Beragam obat-obatan untuk kebutuhan sehari-hari.</p>
                                <a href="produk.php?kategori=<?php echo buatSlug('Obat obatan'); ?>" class="btn btn-primary mt-auto">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Produk -->
<div class="container-fluid py-4">
    <div class="container text-center">
        <h3>Produk</h3>
        <section class="my-5">
            <div class="container">
                <div class="row">
                    <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
                    <div class="col-md-3 mb-4">
                        <div class="card product-card h-100">
                            <img src="<?php echo $data['foto']; ?>" class="card-img-top" alt="<?php echo $data['nama']; ?>">
                            <div class="card-body">
                                <h6 class="card-title"><?php echo $data['nama']; ?></h6>
                                <p class="card-text"><?php echo $data['detail']; ?></p>
                                <p class="card-text">Rp. <?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
                                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn btn-primary mt-auto">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>
</div>

<?php require "footer.php"; ?>

    <!-- JavaScript Bootstrap & FontAwesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</body>
</html>
