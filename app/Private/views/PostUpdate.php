<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
    <title>Document</title>

    <style>

        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>

<?php if(isset($_SESSION["name"])) {
    echo
    '<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin">Admin</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/logout">Logout</a>
        </li>
    </ul>
</nav>';
} else {
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
        </li>
    </ul>
</nav>';
}?>

<div style="width: 100%;
                height: 100%;
                align-items: center;
                display: flex;
                justify-content: center;"
>
    <form class="form-signin text-center" action="/post-update-save" method="post" style="min-width: 500px">
        <h1 class="h3 mb-3 font-weight-normal">Update Post</h1>
        <input type="hidden" value="<?php echo $post["id"]?>" name="update-id">
        <input type="text" id="inputName" class="form-control" placeholder="Title" name="title" value="<?php echo $post["title"]?>" required autofocus>
        <textarea style="height: 300px" class="form-control" placeholder="description" name="description"><?php echo $post["description"]?></textarea>

        <div style="width: 100%; display: flex; align-content: end; flex-direction: row-reverse;">
            <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">Submit</button>
        </div>
    </form>
</div>

<footer class="bg-light text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright:
        <a class="text-dark" href="#">Merlijn Busch</a>
    </div>
    <!-- Copyright -->
</footer>
</body>
</html>
