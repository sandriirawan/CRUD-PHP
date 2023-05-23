<?php
// Menghubungkan ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "pijarcamp";

$conn = mysqli_connect($host, $username, $password, $database);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Memeriksa apakah form edit telah disubmit
if (isset($_POST['edit'])) {
    // Mendapatkan data dari form
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $keterangan = $_POST['keterangan'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    // Mengupdate data produk di database
    $sql = "UPDATE produk SET nama_produk='$nama_produk', keterangan='$keterangan', harga=$harga, jumlah=$jumlah WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Produk berhasil diupdate.";
        echo "<br><a href='index.php'>Kembali ke Halaman Utama</a>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Memeriksa apakah parameter id telah diberikan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data produk berdasarkan ID
    $sql = "SELECT * FROM produk WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>

        <h2>Edit Produk</h2>

        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="text" name="nama_produk" placeholder="Nama Produk" value="<?php echo $row['nama_produk']; ?>" required>
            <input type="text" name="keterangan" placeholder="Keterangan" value="<?php echo $row['keterangan']; ?>" required>
            <input type="number" name="harga" placeholder="Harga" value="<?php echo $row['harga']; ?>" required>
            <input type="number" name="jumlah" placeholder="Jumlah" value="<?php echo $row['jumlah']; ?>" required>
            <button type="submit" name="edit">Update</button>
        </form>

        <?php
    } else {
        echo "Produk tidak ditemukan.";
        echo "<br><a href='index.php'>Kembali ke Halaman Utama</a>";
    }
} else {
    echo "ID produk tidak tersedia.";
    echo "<br><a href='index.php'>Kembali ke Halaman Utama</a>";
}

mysqli_close($conn);
?>
