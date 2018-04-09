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
                    <a href="moviesListing.php">Movies</a>
                </li>
                <li class="active">
                    Edit Movie
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


        </div>
    </div>
    <!-- /.row -->

<?php require_once 'common/footer.php'; ?>