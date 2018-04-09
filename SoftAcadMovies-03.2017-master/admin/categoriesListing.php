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
                   Categories Listing
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
        <a href="addCategory.php"  class="btn btn-info pull-right">Create Category</a>
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
                <th>Actions</th>
            </tr>

            <?php $categories = getCategories($conn); 

            foreach ($categories as $category) { ?>
                <tr>
                    <td><?php echo $category['id'] ?></td>
                    <td><?php echo $category['title']; ?></td>
                    <td><?php echo $category['description'] ?></td>
                    <td>
                        <a href="editCategory.php?id=<?php echo  $category['id']?>"  class="btn btn-warning">Edit</a>
                        <a href="deleteCategory.php?id=<?php echo  $category['id']?>"  class="btn btn-danger">Delete</a>
                    </td>
                </tr>

            <?php } ?>



        </table>



    </div>
</div>
<!-- /.row -->

<?php require_once 'common/footer.php'; ?>