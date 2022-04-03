<?php

use App\Controllers\TaskController;

 require_once  ROOT . '/app/views/common/header.php'; ?>
    <h2 class="my-2">Login</h2>
    <?php if ($data['errors']): ?>
    <div class="alert alert-danger" role="alert">
        <ul>
            <?php foreach ($data['errors'] as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <?php if (TaskController::isLogged()): ?>
        <form action="logout" method="post" enctype="multipart/form-data">
            <div class="form-group my-3">
                <button type="submit" class="btn btn-primary" value="Logout" name="submit">Logout</button>
            </div>
        </form>
    <?php else: ?>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputLogin" class="form-label fw-bold">Login</label>
                <input type="text" class="form-control" id="inputLogin"  name="login">
            </div>
            <div class="form-group">
                <label for="inputPass" class="form-label fw-bold">Pass</label>
                <input type="text" class="form-control" id="inputPass"  name="pass">
            </div>
            <div class="form-group my-3">
                <button type="submit" class="btn btn-primary" value="Login" name="submit">Login</button>
            </div>
        </form>
    <?php endif; ?>
<?php require_once  ROOT . '/app/views/common/footer.php'; ?>