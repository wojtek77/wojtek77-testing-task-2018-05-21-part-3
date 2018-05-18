<?php
require __DIR__ . '/vendor/autoload.php';

$id = $_GET['id'];

$client = new \GuzzleHttp\Client(['base_uri' => ClientSettings::BASE_URI]);
$response = $client->get($id);
$body = $response->getBody();
$user = json_decode($body);

if (!empty($_POST)) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    
    $response = $client->put($id, ['form_params' => ['firstname' => $firstname, 'lastname' => $lastname]]);
    if ($response->getStatusCode() === 200) {
        header('Location: index.php');
        exit;
    }
}

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

            <form action="" method="post">
                <fieldset>
                    <legend>Change user</legend>
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-1 col-form-label text-right">Firstname</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $user->firstname ?>" placeholder="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastname" class="col-sm-1 col-form-label text-right">Lastname</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $user->lastname ?>" placeholder="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary">Change</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </body>
</html>
