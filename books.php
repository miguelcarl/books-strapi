<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = '9d6f9856e77af328f8686512f20cf2014073e3227bc6186c4cfbb434667b49a8af329ba77bb54fa63b51aeee6000d8362bdd67da850a2032d8f4569982461d9180828f8d89540c6ed3cd52e13b9975ee9b15a69fd968d132367b83ceb61f0bf3a9b96d3a8478a02af1058eb6ff9c91c640c0685817d1376327c7435cc0b0293d';

    try {
        $client = new Client([
            'base_uri' => 'http://localhost:1337/api/'
        ]);
    
        $headers = [
            'Authorization' => 'Bearer ' . $token,        
            'Accept'        => 'application/json',
      ];
  
      $response = $client->request('GET', 'books?pagination[pageSize]=66', [
            'headers' => $headers
      ]);
    
        $body = $response->getBody();
        $decoded_response = json_decode($body);
        return $decoded_response;
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo '<pre>';
        var_dump($e);
    }
    return null; 
}

$books = getBooks();
?>

<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>BOOKS</title>
    </head>
    <body>
        <div class = "container">
            <h1 style = "padding-bottom: 20px;">SCRIPTURES BOOK LIST</h1>
            <div class = "row">
                <div class = "col-10">
                    <table class = "table">
                        <tr class = "table-info">
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                        </tr>
                        <?php
                            foreach ($books->data as $bookData) {
                            $book = $bookData->attributes;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $bookData->id; ?></td>
                            <td><?php echo $book->name; ?></td>
                            <td><?php echo $book->author; ?></td>
                            <td><?php echo $book->category; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>