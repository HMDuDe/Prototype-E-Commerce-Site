<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Search Results</title>

        <script>
            function backToQuotes(){
                window.location.href="../views/quoteManagement.php";
            }

        </script>
    </head>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-3"></div>

                <div class="col-sm-6">
                    <button type="button" onclick="backToQuotes()" class="btn btn-success btn-block">Back to Quotes</button>
                </div>

                <div class="col-sm-3"></div>
            </div>
            <div class="row mt-5">
                <?php
                    require '../models/Quote.php';

                    $quote = new Quote();
                    $quote->display_quotes($_POST['searchQuote']);
                ?>
            </div>
        </div>
    </body>
</html>