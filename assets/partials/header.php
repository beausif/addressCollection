<!DOCTYPE html>
<html lang="en">
<head>
    <style id="antiClickjack">
        body {
            display: none !important;
        }
    </style>
    <script type="text/javascript">
        if (self === top) {
            var antiClickjack = document.getElementById("antiClickjack");
            antiClickjack.parentNode.removeChild(antiClickjack);
        } else {
            top.location = self.location;
        }
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Address Collection</title>

    <link rel="stylesheet" href="/assets/css/common.min.css">
</head>

<body>

<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
            aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0 mr-5">
            <li class="nav-item">
                <a class="nav-link text-white" href="/">Add</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="/view/">View</a>
            </li>
        </ul>
    </div>

</nav>