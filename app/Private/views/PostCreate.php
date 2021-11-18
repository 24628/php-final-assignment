<div style="width: 100%;
    height: 100%;
    align-items: center;
    display: flex;
    justify-content: center;"
>
    <form class="form-signin text-center" action="/post-save" method="post" style="min-width: 500px">
        <h1 class="h3 mb-3 font-weight-normal">Create Post</h1>
        <input type="text" id="inputName" class="form-control" placeholder="Title" name="title" required autofocus>
        <textarea class="form-control" placeholder="description" name="description"></textarea>

        <div style="width: 100%; display: flex; align-content: end; flex-direction: row-reverse;">
            <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">Submit</button>
        </div>
    </form>
</div>
