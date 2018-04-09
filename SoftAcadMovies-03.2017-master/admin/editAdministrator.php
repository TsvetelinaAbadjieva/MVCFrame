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
                <li>
                    <a href="administratorsListing.php">Administrators</a>
                </li>
                <li class="active">
                    Edit Administrator
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
           $id = (isset($_GET['id'])) ? $_GET['id'] : '';
            if ((int)$id <= 0) {
                redirect('administratorListing.php');
            }

            $user = getUserById($id, $conn);

            if (empty($user)) {
                redirect('administratorListing.php');
            }

            $data =[
                'id' => $user['id'],
                'username' => $user['username'],
                'email'    => $user['email'],
            ];

            $errors = [
                'username' => [],
                'email'    => [],
            ];


            if (isset($_POST['editAdmin'])) {

                $data =[
                    'id' => $user['id'],
                    'username' => isset($_POST['username'])? htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8'): '',
                    'email'    => isset($_POST['email'])? htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8'): '',
                ];

                $errors = isValidAddAdministrator($data);
                $flag = checkForErrors($errors);

                if ($flag === true) {


                    $db = DB::getInstance();
                    $db->update('users', $data, ['id' => $data['id']]);

                    $_SESSION['flash'] = 'Записът беше записан в базата данни успешно.';

                    header('Location: administratorsListing.php');
                    exit;
                }

            }?>
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


                        <input type="submit" class="btn btn-primary" name="editAdmin" value="Edit Administrator">
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>

        </div>
    </div>
    <!-- /.row -->

<?php require_once 'common/footer.php'; ?>