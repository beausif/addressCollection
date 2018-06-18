<?php
declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/assets/assets.php';
require_once PARTIALS_DIR . '/header.php';
?>

  <link rel="stylesheet" href="/assets/css/dataTables.min.css">

    <div class="container mt-5">
        <table id="addressCollection" class="table table-bordered" width="100%">
            <thead>
            <tr>
                <th>Date Added</th>
                <th>Address1</th>
                <th>Address2</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
            </tr>
            </thead>
            <tbody id="addressCollectionBody">
            </tbody>
        </table>
    </div>

  <script src="/assets/js/common.min.js"></script>
  <script src="/assets/js/dataTables.min.js"></script>
  <script src="/assets/js/view/main.js"></script>

<?php require_once PARTIALS_DIR . '/footer.php'; ?>