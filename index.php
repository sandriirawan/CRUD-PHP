<!DOCTYPE html>
<html>
<head>
    <title>CRUD Produk - PijarCamp</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th, table td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
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


    // Memeriksa apakah form tambah telah disubmit
    if (isset($_POST['tambah'])) {
        // Mendapatkan data dari form
        $nama_produk = $_POST['nama_produk'];
        $keterangan = $_POST['keterangan'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];

        // Menambahkan data ke database
        $sql = "INSERT INTO produk (nama_produk, keterangan, harga, jumlah) VALUES ('$nama_produk', '$keterangan', $harga, $jumlah)";
        if (mysqli_query($conn, $sql)) {
            echo "Produk berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    
    // Memeriksa apakah form edit telah disubmit
    if (isset($_POST['edit'])) {
        // Mendapatkan data dari form
        $id = $_POST['id'];
        $nama_produk = $_POST['nama_produk'];
        $keterangan = $_POST['keterangan'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];

        echo "<td>
        <a href='edit_produk.php?id=" . $row['id'] . "'>Edit</a> |
        <a href='?hapus=" . $row['id'] . "'>Hapus</a></td>";


        // Mengupdate data produk di database
        $sql = "UPDATE produk SET nama_produk='$nama_produk', keterangan='$keterangan', harga=$harga, jumlah=$jumlah WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Produk berhasil diupdate.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Memeriksa apakah parameter hapus telah diberikan
    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];

        // Menghapus data produk dari database
        $sql = "DELETE FROM produk WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Produk berhasil dihapus.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    ?>

    <!-- Form Tambah Produk -->
    <h3>Tambah Produk</h3>
    <form method="POST" action="">
        <input type="text" name="nama_produk" placeholder="Nama Produk" required>
        <input type="text" name="keterangan" placeholder="Keterangan" required>
        <input type="number" name="harga" placeholder="Harga" required>
        <input type="
        number" name="jumlah" placeholder="Jumlah" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <!-- Tabel Data Produk -->
    <h3>Data Produk</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Keterangan</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php
        
        // Mengambil data produk dari database
        $sql = "SELECT * FROM produk";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama_produk'] . "</td>";
                echo "<td>" . $row['keterangan'] . "</td>";
                echo "<td>" . $row['harga'] . "</td>";
                echo "<td>" . $row['jumlah'] . "</td>";
                echo "<td>
                        <a href='edit_produk.php?id=" . $row['id'] . "'>Edit</a> |
                        <a href='?hapus=" . $row['id'] . "'>Hapus</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data produk.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>

</body>
</html>
