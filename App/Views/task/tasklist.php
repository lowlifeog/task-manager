<?php require_once  ROOT . '/app/views/common/header.php'; ?>
    <h2 class="my-2">Task List</h2>
    <div class="tasks">
        <?php if ($data['tasks']): ?>
            <form class="form-inline row my-3" action="/" method="post">
                <div class="form-group col-5">
                    <span class="fw-bold">Sort By: </span>
                    <select class="form-select d-inline-block w-auto" name="sort">
                        <option value="1" <?php if ($data['sort'] === 1) echo 'selected'; ?>>Name</option>
                        <option value="2" <?php if ($data['sort'] === 2) echo 'selected'; ?>>E-Mail</option>
                        <option value="3" <?php if ($data['sort'] === 3) echo 'selected'; ?>>Status</option>
                    </select>
                </div>
                <div class="form-group col-5">
                    <span class="fw-bold">Order: </span>
                    <select class="form-select d-inline-block w-auto" name="order">
                        <option value="1" <?php if ($data['order'] === 1) echo 'selected'; ?>>ASC</option>
                        <option value="2" <?php if ($data['order'] === 2) echo 'selected'; ?>>DESC</option>
                    </select>
                </div>
                <div class="form-group col-2">
                    <div class="float-end">
                        <button type="submit" class="btn btn-primary" value = "Sort" name="submit">Sort</button>
                    </div>
                </div>
            </form>
            <?php if ($data["logged"]): ?>
                <?php foreach ($data['tasks'] as $task) : ?>
                    <div class="list-group">
                        <?php if ($task['status']): ?>
                            <div id="task<?php echo $task['id'] ?>" class="list-group-item list-group-item-success flex-column align-items-start my-2">
                        <?php else: ?>
                            <div id="task<?php echo $task['id'] ?>" class="list-group-item list-group-item-warning flex-column align-items-start my-2">
                        <?php endif; ?>
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
                                        <label class="form-check-label fw-bold" for="status<?php echo $task['id'] ?>">Status: </label>
                                        <?php if ($task['status']): ?>
                                                <input class="status form-check-input" type="checkbox" id="status<?php echo $task['id'] ?>" checked disabled>
                                        <?php else: ?>
                                                <input class="status form-check-input" type="checkbox" id="status<?php echo $task['id'] ?>" disabled>
                                        <?php endif; ?>
                                    </div>
                                </small>
                            </div>
                                <textarea class="form-control mb-2" placeholder="Task" id="taskText<?php echo $task['id'] ?>"><?php echo $task['text'] ?></textarea>
                                <div class="float-end">
                                    <button type="submit" class="complete btn btn-primary" value="<?php echo $task['id'] ?>" name="complete">Complete</button>
                                </div>
                                <div class="float-end mx-2">
                                    <button type="submit" class="edit btn btn-primary" value="<?php echo $task['id'] ?>" name="edit">Edit</button>
                                </div>
                                <small id="taskEdit<?php echo $task['id'] ?>" class="text-muted <?php if (!$task['edit']): ?>d-none<?php endif; ?>">Changed by admin!</small>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($data['tasks'] as $task) : ?>
                    <div class="list-group">
                        <?php if ($task['status']): ?>
                            <div class="list-group-item list-group-item-success flex-column align-items-start my-2">
                        <?php else: ?>
                            <div class="list-group-item list-group-item-warning flex-column align-items-start my-2">
                        <?php endif; ?>
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
                                        <label class="form-check-label fw-bold" for="status<?php echo $task['id'] ?>">Status: </label>
                                        <?php if ($task['status']): ?>
                                                <input class="form-check-input" type="checkbox" id="status<?php echo $task['id'] ?>" checked disabled>
                                        <?php else: ?>
                                                <input class="form-check-input" type="checkbox" id="status<?php echo $task['id'] ?>" disabled>
                                        <?php endif; ?>
                                    </div>
                                </small>
                            </div>
                            <div class="mb-1"><?php echo $task['text'] ?></div>
                            <small id="taskEdit<?php echo $task['id'] ?>" class="text-muted <?php if (!$task['edit']) echo 'd-none' ?>">Changed by admin!</small>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <nav class="my-3">
                <?php echo $data['pagination']->render(); ?>
            </nav>
        <?php else: ?>
            <div>No available tasks! <a href="task/add">Add Task!</a></div>
        <?php endif; ?>
    </div>
<?php require_once  ROOT . '/app/views/common/footer.php'; ?>