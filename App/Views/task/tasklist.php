<?php require_once  ROOT . '/app/views/common/header.php'; ?>
    <h2 class="my-2">Task List</h2>
    <div class="tasks">
        <?php foreach ($data as $task) : ?>
            <div class="list-group">
                <div class="list-group-item list-group-item-warning flex-column align-items-start my-2">
                    <div class="d-flex w-100 justify-content-between">
                        <div>
                            <div>
                                <span class="fw-bold">Name: </span>
                                <?php echo $task['name'] ?>
                            </div>
                            <div class="mb-2">
                                <span class="fw-bold">E-Mail: </span>
                                <?php echo $task['email'] ?>
                            </div>
                        </div>
                        <small>
                            <div>
                                <label class="form-check-label fw-bold" for="flexCheckDisabled">Status: </label>
                                <?php if ($task['status']): ?>
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" checked>
                                <?php else: ?>
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled">
                                <?php endif; ?>
                                
                            </div>
                        </small>
                    </div>
                    <p class="mb-1"><?php echo $task['text'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php require_once  ROOT . '/app/views/common/footer.php'; ?>