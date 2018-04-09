<?php require_once 'common/header.php'; ?>
<?php


echo '<pre>';
var_dump($error);
echo '</pre>';
?>



    <!-- Content Row -->
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>

                <input type="submit" name="submit" value="Login" class="btn btn-default"/>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>

    <!-- /.row -->

<?php require_once 'common/footer.php'; ?>