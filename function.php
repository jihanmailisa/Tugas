<?php
//Koneksi ke Database
$conn = mysqli_connect("localhost", "root", "", "pw_701210069");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $fakultas = htmlspecialchars($data["fakultas"]);

    //query insert data
    $query = "INSERT INTO mahasiswa
               VALUES
            ('', '$nama', '$email', '$jurusan', '$fakultas', '$gambar')
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapus($Nim) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE Nim = $Nim");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $fakultas = htmlspecialchars($data["fakultas"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    //query insert data
    $query = "UPDATE mahasiswa SET
    
            nama = '$nama',
            email = '$email',
            jurusan = '$jurusan',
            fakultas = '$fakultas',
            gambar = '$gambar',
            WHERE Nim = $nim
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

$keyword = uniqid();

function cari($keyword) {
    $query = "SELECT * FROM mahasiswa
                WHERE
            nama LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' OR
            fakultas LIKE '%$keyword%'
        ";
    return query($query);
}

?>