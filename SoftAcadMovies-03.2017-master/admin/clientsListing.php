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
                <li class="active">
                    Clients Listing
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
        <a href="addClient.php"  class="btn btn-info pull-right">Create Client</a>
        <?php
        if (isset($_SESSION['flash']) && $_SESSION['flash'] != '') {
            echo $_SESSION['flash'];
            unset($_SESSION['flash']);
        }
        ?>


        <table class="table">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>
                    <a href="editClient.php?id="  class="btn btn-warning">Edit</a>
                    <a href="deleteClient.php?id=>"  class="btn btn-danger">Delete</a>
                </td>
            </tr>


        </table>


    </div>
</div>
<!-- /.row -->

<?php require_once 'common/footer.php'; ?>