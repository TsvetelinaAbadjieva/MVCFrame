<?php require_once 'common/header.php'; ?>
    <?php if (!isLoggedInAdmin()) {
        redirect('login.php');
    } ?>
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li class="">
                    <a href="administratorsListing.php">Administrators</a>
                </li>
                <li class="active">
                    Add administrator
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
<!-- Content Row -->
<div class="row">
    <!-- Sidebar Column -->
    <div class="col-md-3">
        <?php require_once 'common/nav.php'; ?>
    </div>
    <!-- Content Column -->
    <div class="col-md-9">
        <?php
            $data =[
                'username' => '',
                'password' => '',
                'email'    => '',
            ];

            $errors = [
                'username' => [],
                'password' => [],
                'email'    => [],
            ];


        if (isset($_POST['addAdmin'])) {
            $data =[
                'username' => isset($_POST['username'])? htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8'): '',
                'password' => isset($_POST['password'])? htmlspecialchars(trim($_POST['password']), ENT_QUOTES, 'UTF-8'): '',
                'email'    => isset($_POST['email'])? htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8'): '',
            ];

            $errors = isValidAddAdministrator($data);

            $flag = checkForErrors($errors);

            if ($flag === true) {
                //Записваме стойността от полетата в базата данни
                $data['password'] = sha1($data['password']);

                $db = DB::getInstance();
                $db->insert('users', $data);

                $_SESSION['flash'] = 'Записът беше записан в базата данни успешно.';

                header('Location: administratorsListing.php');
                exit;
            }

        }



        ?>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group  <?php echo (!empty($errors['username']))? 'has-error': ''; ?>">
                        <label for="username">Username</label>
                        <input type="text" value="<?php echo $data['username']; ?>" class="form-control" name="username" placeholder="Username" id="username" />
                        <?php
                        //Когато имаме foreach() не се прави проверка дали масива е празен
                        //if(!empty($errors['username'])) { ?>
                        <?php foreach($errors['username'] as $errorUsername) { ?>
                            <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error: </span>
                                <?php echo $errorUsername; ?>
                            </div>
                        <?php } ?>
                        <?php //} ?>
                    </div>
                    <div class="form-group  <?php echo (!empty($errors['password']))? 'has-error' : '' ?> ">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" />
                        <?php foreach ($errors['password'] as $errorPassword) { ?>
                            <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error: </span>
                                <?php echo $errorPassword; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group <?php echo (!empty($errors['email']))? 'has-error' : '' ?> ">
                        <label for="email">Email</label>
                        <input type="email" value="<?php echo $data['email']; ?>" class="form-control" name="email" placeholder="email" id="email" />
                        <?php foreach ($errors['email'] as $errorPassword) { ?>
                            <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error: </span>
                                <?php echo $errors['email']; ?>
                            </div>
                        <?php } ?>
                    </div>


                    <input type="submit" class="btn btn-primary" name="addAdmin" value="Add Administrator">
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>
</div>
<!-- /.row -->

<?php require_once 'common/footer.php'; ?>