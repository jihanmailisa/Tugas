<?php

    require 'function.php';

    $mahasiswa = query("SELECT * FROM mahasiswa");

?>

<tr>
    <th>#</th>
    <th>Opsi</th>
    <th>gambar</th>
    <th>Nim</th>
    <th>nama</th>
    <th>email</th>
    <th>jurusn</th>
    <th>fakultas</th>
</tr>

<?php $i = 1; ?>
<?php foreach( $mahasiswa as $mhs) : ?>
    <tr>
        <td><?= $i ?></td>
        <td>
            <a href="">Ubah</a>
            <a href="">Hapus</a>
        </td>
        <td><img src=",,/assets/img/<?= $mhs['gambar']; ?>"
        <td><?= $mhs['nim']; ?></td>
        <td><?= $mhs['nama']; ?></td>
        <td><?= $mhs['email']; ?></td>
        <td><?= $mhs['jurusan']; ?></td>
        <td><?= $mhs['fakultas']; ?></td>
    </tr>
<?php $i++; ?>
<?php endforeach ?>

<a href="tambah.php">Tambah Data Mahasiswa</a>
<form action="" method="post">
    <label for="nim">nim: </label><br>
    <input type="text" nim="nim" id="nim"><br><br>
    <label for="nama">nama: </label><br>
    <input type="text" nama="nama" id="nama"><br><br>
    <label for="email">email: </label><br>
    <input type="text" email="email" id="email"><br><br>
    <label for="jurusan">jurusan: </label><br>
    <input type="text" jurusan="jurusan" id="jurusan"><br><br>
    <label for="fakultas">fakultas: </label><br>
    <input type="text" fakultas="fakultas" id="fakultas"><br><br>

    <button> type="submit" name="tambah">Tambah</button>
    <a href="index.php"><button>Kembali</button></a>

    <?php

    require 'functions.php';

    if (isset($_POST['tambah'])) {
        if (tambah($_POST, $_FILES) > 0) {
            echo "<script>
                    alert('Data Berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
        } else{
            echo "<script>
            alert('Data Gagal ditambahkan!');
            document.location.href = 'index.php';
        </script>";
        }
    }

?>

<!DOCTYPE html>

function tambah($data) {
    $conn = koneksi();

    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $fakultas = htmlspecialchars($data["fakultas"]);
    $gambar = htmlspecialchars($data['gambar']);

    $querytambah = "INSERT INTO mahasiswa
                        VALUES ('', '$nim', '$nama', '$email', '$jurusan', '$fakultas', '$gambar')";

    mysqli_query($conn, $querytambah);

    return mysqli_affected_rows($conn);
}
