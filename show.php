<?php
require __DIR__ . '/vendor/autoload.php';

$id = $_GET['id'];

$client = new \GuzzleHttp\Client(['base_uri' => ClientSettings::BASE_URI]);

$response = $client->get($id);
$body = $response->getBody();
$user = json_decode($body);

?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <title>Test</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    </head>

    <body>
        <div class="container-fluid">

            <p>
                <a class="lead" href="index.php">back</a>
            </p>

            <div>ID: <span class="lead font-weight-bold"><?= $user->id ?></span></div>
            <div>Firstname: <span class="lead font-weight-bold"><?= $user->firstname ?></span></div>
            <div>Lastname: <span class="lead font-weight-bold"><?= $user->lastname ?></span></div>

        </div>
    </body>
</html>
