<div style="width: 100%;
    height: 100%;
    align-items: center;
    display: flex;
    justify-content: center;"
>
    <form class="form-signin text-center" action="/login-post" method="post" style="max-width: 400px">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <input type="text" id="inputName" class="form-control" placeholder="Name" name="name" required autofocus>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

        <div style="width: 100%; display: flex; align-content: end; flex-direction: row-reverse;">
        <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">Sign in</button>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
</div>
