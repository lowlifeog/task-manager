<?php require_once  ROOT . '/App/Views/common/header.php'; ?>
<h2 class="my-2">Add Task</h2>
<?php if ($data['errors']): ?>
    <div class="alert alert-danger" role="alert">
        <ul>
            <?php foreach ($data['errors'] as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if ($data['result']): ?>
    <div class="alert alert-success" role="alert">
        <p>Task added!</p>
    </div>
<?php endif; ?>  
<form action="#" method="post" class="row g-2" enctype="multipart/form-data">
    <div class="col-md-6">
        <label for="inputName" class="form-label fw-bold">Name</label>
        <input type="text" class="form-control" id="inputName"  name="name">
    </div>
    <div class="col-md-6">
        <label for="inputPassword" class="form-label fw-bold">E-Mail</label>
        <input type="email" class="form-control" id="inputPassword"  name="email">
    </div>
    <div class="col-12">
        <label for="inputText" class="form-label fw-bold">Task</label>
        <textarea class="form-control" id="inputText" placeholder="Task text"  name="text"></textarea>
    </div>
    <div class="col-12 float-end">
        <button type="submit" value="Save" class="btn btn-primary" name="submit">Add</button>
    </div>
</form>
<?php require_once  ROOT . '/App/Views/common/footer.php'; ?>