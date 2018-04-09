<?php require_once 'common/header.php'; ?>
<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li class="active">
                Administrators Listing
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
        <a href="addAdministrator.php"  class="btn btn-info pull-right">Create new Admin</a>
        <?php
        if (isset($_SESSION['flash']) && $_SESSION['flash'] != '') {
            echo $_SESSION['flash'];
            unset($_SESSION['flash']);
        }
        ?>

        <table class="table">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th width="20%">Action</th>
            </tr>
            <?php foreach($users as $user) { ?>
                <tr>
                    <td><?php echo $user->getUsername(); ?></td>
                    <td><?php echo $user->getEmail(); ?></td>
                    <td >
                        <a href="editAdministrator.php?id=<?php echo $user->getId(); ?>"  class="btn btn-warning">Edit</a>
                        <a href="deleteAdministrator.php?id=<?php echo $user->getId(); ?>"  class="btn btn-danger">Delete</a>
                    </td>
                </tr>

            <?php } ?>
            <?php echo $pagination->create(); ?>

        </table>



    </div>
</div>
<!-- /.row -->

<?php require_once 'common/footer.php'; ?>




