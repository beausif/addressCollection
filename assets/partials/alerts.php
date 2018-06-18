<?php declare(strict_types=1); ?>

<?php if(isset($_SESSION['error'])): ?>
    <div class="container">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error: <?=$_SESSION['error']?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    </div>
<?php endif; unset($_SESSION['error']) ?>

<?php if(isset($_SESSION['success'])): ?>
    <div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success: <?=$_SESSION['success']?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    </div>
<?php endif; unset($_SESSION['success']) ?>