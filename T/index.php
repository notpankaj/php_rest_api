<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="./app.js" defer></script>
</head>

<body>

    <div class="profile">

        <?php  session_start();
      if(isset($_SESSION['user'])) { ?>
        <i><?php echo $_SESSION['user']['name'] ?></i>
        <form class="logout">
            <input type="hidden" name="user_id" value='<?php echo $_SESSION['user']['id'] ?>'>
            <button type="submit">logout</button>
        </form>
        <?php } ?>

    </div>


    <div>
        <form class="login">
            <input type="email" name="email" placeholder="email" />
            <input type="text" name="password" placeholder="password" />
            <button type="submit">Login</button>
        </form>
        <form action="" class="signup">
            <input type="text" name="name" placeholder="name" />
            <input type="email" name="email" placeholder="email" />
            <input type="text" name="password" placeholder="password" />
            <button type="submit">singup</button>
        </form>
    </div>

    <form action="" class="addPostForm">
        add post<input type="text" name="body">
        <button type="submit">add Post</button>
    </form>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">post</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody class="tbody">
            <!-- <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td><button onClick="editRecord()">edit</button></td>
                <td><button onClick="deleteRecord()">delete</button></td>
            </tr> -->
        </tbody>
    </table>

    <div class="modal editModal">
        <h2>edit post</h2>
        <button class="modal-close" onClick="hideModal()">close</button>
        <form class="editForm">
            <input type="hidden" id="edit-id" value="" name="post_id">
            post: <input type="text" id="edit-body" name='body'>
            <button type="submit">update</button>
        </form>
    </div>


</body>

</html>

<style>
body {
    position: relative;
}

.modal {
    display: none;
    position: absolute;
    z-index: 100;
    top: 50%;
    left: 50%;
    transform: translate(-50%, 50%);
    background: #fff;
    border: 2px black dotted;
    width: 300px;
    min-height: 200px;
    padding: 50px;
}
</style>