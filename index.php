<?php
$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];


$parking_filter = $_GET['parking'] ?? '';

$rating_filter = $_GET['rating'] ?? '';


$filtered_hotels = [];



if ($parking_filter && $rating_filter) {
    foreach ($hotels as $hotel) {
        if ($hotel['parking'] && $hotel['vote'] >= $rating_filter) {
            $filtered_hotels[] = $hotel;
        }
    }
} elseif ($parking_filter && !$rating_filter) {
    foreach ($hotels as $hotel) {
        if ($hotel['parking']) {
            $filtered_hotels[] = $hotel;
        }
    }
} elseif ($rating_filter && !$parking_filter) {
    foreach ($hotels as $hotel) {
        if ($hotel['vote'] >= $rating_filter) {
            $filtered_hotels[] = $hotel;
        }
    }
} else {
    $filtered_hotels = $hotels;
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTAWESOME -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.css' integrity='sha512-FA9cIbtlP61W0PRtX36P6CGRy0vZs0C2Uw26Q1cMmj3xwhftftymr0sj8/YeezDnRwL9wtWw8ZwtCiTDXlXGjQ==' crossorigin='anonymous' />
    <!-- BOOTSTRAP -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css' integrity='sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==' crossorigin='anonymous' />
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="styles/style.css">
    <!-- TITLE -->
    <title>Hotels</title>
</head>

<body>
    <div class="container py-5 text-center">
        <h1 class="mb-3">Hotel</h1>
        <form action="index.php" method="GET" class="d-flex align-items-center justify-content-center">
            <div class="d-flex aling-items-center me-3">
                <input type="checkbox" name="parking" id="parking" class="me-2" <?= ($parking_filter) ? 'checked' : '' ?>>
                <label for="checkbox">Con parcheggio</label>
            </div>
            <div class="d-flex aling-items-center me-3">
                <label for="rating" class="me-2">Voto:</label>
                <select name="rating" id="rating">
                    <option value="">---</option>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <option value="<?= $i ?>" <?= $i === intval($rating_filter) ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <button class="btn btn-success">Cerca!</button>
        </form>
        <hr class="mb-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Parcheggio</th>
                    <th scope="col">Voto</th>
                    <th scope="col">Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filtered_hotels as $hotel) : ?>
                    <tr>
                        <th><?= $hotel['name'] ?></th>
                        <th><?= $hotel['description'] ?></th>
                        <th><?= $hotel['parking'] ? '<i class="fa-solid fa-circle-check"></i>' : '<i class="fa-solid fa-circle-xmark"></i>' ?></th>
                        <th><?php for ($i = 0; $i < $hotel['vote']; $i++) : ?>
                                <i class="fa-solid fa-star"></i>
                            <?php endfor; ?>
                            <?php for ($i = 0; $i < 5 - $hotel['vote']; $i++) : ?>
                                <i class="fa-regular fa-star"></i>
                            <?php endfor; ?>
                        </th>
                        <th><?= $hotel['distance_to_center'] ?> Km</th>
                    </tr>
                <?php endforeach ?>
        </table>
    </div>
</body>

</html>