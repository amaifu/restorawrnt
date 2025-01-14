<!-- Update -->

<?php
    session_start();
    if(!$_SESSION["login"]) {
        header("location: ../../login");
        exit();
    }

    if(!isset($_GET["id"])) {
        header("location: ../");
        exit();
    }
    $id = $_GET["id"];
        
    $ch = curl_init("http://localhost/restorawrnt/api/booking/getbookings.php?id=$id"); // such as http://example.com/example.xml
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
        $strTime = $booking->booking_time;
        $explodedTime = explode(":" ,$strTime);
        $hours = sprintf("%02s" ,(int)$explodedTime[0]);
        $minutes = sprintf("%02s" ,(int)$explodedTime[1]);
        $time = "$hours:$minutes";

        array_push($ids, $booking->id_booking);
        array_push($names, $booking->client_name);
        array_push($emails, $booking->client_email);
        array_push($telps, $booking->client_telp);
        array_push($dates, $booking->booking_date);
        array_push($times, $time);
        array_push($peoples, $booking->booking_people);
        array_push($messages, $booking->booking_message);
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.0/datatables.min.css" rel="stylesheet">
</head>
<body>
    <div class="container pt-5">

        <h1 class="text-center">Update data booking, AN. <?= $names[0]?></h1>

        <div class="p-5" data-aos="fade-up" data-aos-delay="100">

            <div class="d-flex align-items-center reservation-form-bg" data-aos="fade-up" data-aos-delay="200">
                <form action="../../api/booking/updatebooking.php" method="post" role="form" class="container">
                <div class="row gy-4">
                    <input type="text" name="id" class="form-control" id="name" placeholder="Your Name" required="" hidden value="<?=$ids[0] ?>">
                    <div class="col-lg-4 col-md-6">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="" value="<?=$names[0] ?>">
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="" value="<?=$emails[0] ?>">
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <input type="text" class="form-control" name="telp" id="phone" placeholder="Your Phone" required="" value="<?=$telps[0] ?>">
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <input type="date" name="date" class="form-control" id="date" placeholder="Date" required="" value="<?=$dates[0] ?>">
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <input type="time" class="form-control" name="time" id="time" placeholder="Time" required="" value="<?=$times[0] ?>">
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <input type="number" class="form-control" name="people" id="people" placeholder="# of people" required="" value="<?=$peoples[0] ?>">
                    </div>
                </div>

                <div class="form-group mt-3">
                    <textarea class="form-control" name="message" rows="5" placeholder="Message"><?=$messages[0] ?></textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" name="update" class="btn btn-success">Submit</button>
                    <button type="button" name="cancel" onClick="(()=> location.href = '../')()" class="btn btn-light">Cancel</button>
                </div>
                </form>
            </div><!-- End Reservation Form -->

        </div>

    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.0/datatables.min.js"></script>
</body>
</html>