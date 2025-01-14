<?php
    session_start();
    require_once "../api/endpoints.php";

    if(!isset($_SESSION["login"])) {
        header("location: ../login");
        exit();
    }
    $username = $_SESSION["username"];

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["logout"])) {
            session_destroy();
            header("location: ../login");
            exit();
        };
    }

    $ch = curl_init("http://localhost/restorawrnt/api/booking/getbookings.php"); // such as http://example.com/example.xml
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    $ids = [];
    $names = [];
    $emails = [];
    $telps = [];
    $dates = [];
    $times = [];
    $peoples = [];
    $messages = [];

    $datas = json_decode($data);
    foreach($datas->bookings as $booking) {
        array_push($ids, $booking->id_booking);
        array_push($names, $booking->client_name);
        array_push($emails, $booking->client_email);
        array_push($telps, $booking->client_telp);
        array_push($dates, $booking->booking_date);
        array_push($times, $booking->booking_time);
        array_push($peoples, $booking->booking_people);
        array_push($messages, $booking->booking_message);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.0/datatables.min.css" rel="stylesheet">


</head>
<body class="container-fluid p-5">
    
    <div class="d-flex justify-content-between mb-5">
        <h1>Selamat Datang, <?=$username?> 😊</h1>
        <form action="" method="POST">
            <button type="submit" name="logout" class="btn btn-danger">Keluar</button>
        </form>
    </div>

    <div class="table-responsive">
        <h2>Data Pelanggan</h2>
        <table id="myTable" class="table table-striped mt-3" style="width:100%">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telp</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Jumlah Kursi</th>
                    <th>Pesan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php

                    foreach ($ids as $i => $id) {
                        # code...
                        echo "
                        <tr>
                            <td>$names[$i]</td>
                            <td>$emails[$i]</td>
                            <td>$telps[$i]</td>
                            <td>$dates[$i]</td>
                            <td>$times[$i]</td>
                            <td>$peoples[$i]</td>
                            <td>$messages[$i]</td>
                            <td>
                                <a href='update/index.php?id=$id' role='button' class='btn btn-primary'>Update</a>
                                <a href='../api/booking/deletebooking.php?id=$id' role='button' class='btn btn-danger'>Hapus</a>
                            </td>
                        </tr>
                            ";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telp</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Jumlah Kursi</th>
                    <th>Pesan</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>

<script type="text/javascript">
    new DataTable("#myTable");

    fetch("<?=$getUsers?>")
    .then((res) => {
        return res.text()
    }).catch((err) => {
        console.log(err);
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.0/datatables.min.js"></script>


</body> 
</html>