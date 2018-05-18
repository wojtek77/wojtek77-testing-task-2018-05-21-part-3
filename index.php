<?php

require __DIR__ . '/vendor/autoload.php';

$client = new \GuzzleHttp\Client(['base_uri' => ClientSettings::BASE_URI]);

//// POST
//$response = $client->post('', ['form_params' => ['firstname' => 'Dorota', 'lastname' => 'Bruggemann']]);
//dump($response->getStatusCode());
//
//// PUT
//$response = $client->put('3', ['form_params' => ['firstname' => 'Dorota3', 'lastname' => 'Bruggemann3']]);
//dump($response->getStatusCode());
//
//// DELETE
//$response = $client->delete('3');
//dump($response->getStatusCode());

// GET
$response = $client->get('');
$body = $response->getBody();
$list = json_decode($body);

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
                <a class="lead" href="add.php">Add new user</a>
            </p>

            <table class="table table-bordered table-sm">
            <caption>List of users</caption>
            <?php foreach ($list as $r): ?>
            <tr>
                <td><?= $r->id ?></td>
                <td><?= $r->firstname ?></td>
                <td><?= $r->lastname ?></td>
                <td class="text-center">
                    <a class="btn btn-success" href="show.php?id=<?= $r->id ?>">show</a>
                    <a class="btn btn-info" href="edit.php?id=<?= $r->id ?>">edit</a>
                    <button class="btn btn-danger js-delete-user" data-id="<?= $r->id ?>">delete</button>
                </td>
            </tr>
            <?php endforeach ?>
            </table>

        </div>
        <script type="text/javascript">
            $('.js-delete-user').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    method: "DELETE",
                    url: "<?= ClientSettings::BASE_URI ?>" + id,
                    dataType: "json"
                })
                .done(function( msg ) {
//                    alert( "Info: " + msg );
                    location.reload();
                });
            });
        </script>
    </body>
</html>
