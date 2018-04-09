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
                <a href="categoriesListing.php">Categories</a>
            </li>
            <li class="active">
                Create Category
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
            'name' => '',
            'description' => '',
        ];

        $errors = [
            'name' => [],
            'description' => [],
        ];

        if (isset($_POST['addCategory'])) {
            $data =[
                'name' => isset($_POST['name'])? trim(htmlspecialchars($_POST['name'])) : '' ,
                'description' => isset($_POST['description'])? trim(htmlspecialchars($_POST['description'])) : '' ,
            ];

            createCategory($data, $conn);
            redirect('categoriesListing.php');

        }


        ?>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group  <?php echo (!empty($errors['name']))? 'has-error': ''; ?>">
                        <label for="Name">Name</label>
                        <input type="text" value="<?php echo $data['name']; ?>" class="form-control" name="name" placeholder="Name" id="name" />
                        <?php foreach($errors['name'] as $errorName) { ?>
                            <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error: </span>
                                <?php echo $errorName; ?>
                            </div>
                        <?php } ?>
                        <?php //} ?>
                    </div>
                    <div class="form-group  <?php echo (!empty($errors['description']))? 'has-error': ''; ?>">
                        <label for="Description">Description</label>
                        <textarea type="text" value="<?php echo $data['description']; ?>" class="form-control" name="description" placeholder="Description" id="name" /></textarea>
                        <?php foreach($errors['description'] as $errorDescription) { ?>
                            <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error: </span>
                                <?php echo $errorDescription; ?>
                            </div>
                        <?php } ?>
                        <?php //} ?>
                    </div>

                    <input type="submit" class="btn btn-primary" name="addCategory" value="Add Category">
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>

    </div>
</div>
<!-- /.row -->

<?php require_once 'common/footer.php'; ?>