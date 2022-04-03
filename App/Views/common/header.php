<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="/">Home</a>
                <a class="navbar-brand" href="/task/add">Add Task</a>
                <?php if ($data["logged"]): ?>
                    <a class="navbar-brand" href="/task/logout">Logout</a>
                <?php else: ?>
                    <a class="navbar-brand" href="/task/login">Login</a>
                <?php endif; ?>
            </div>
        </nav>
        <div class="container">
            <h1 class="text-center my-2">Task Manager</h1>