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
                    Movie Images
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
        <?php

        $id = (isset($_GET['id']) && (int)$_GET['id']>0)?$_GET['id']: false;
        if (!$id) {
            redirect('moviesListing.php');
        }

        $db = DB::getInstance();

        $movie =  $db->getOne('movies', ['id' => $id]);
        if (empty($movie)) {
            redirect('moviesListing.php');
        }

        $images = $db->get('movies_images', ['movies_id' => $id]);


        $extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $ex = explode('.', $file['name']);
            $ext = strtolower(end($ex));
            if (!in_array($ext, $extensions)) {
                $errors['image'][] = 'Wrong file type';
            }

            if ($file['size'] > 2000000) {
                $errors['image'][] = 'File size is too big';
            }


            if (!is_dir(__DIR__.'/../uploads/movies')) {
                mkdir(__DIR__.'/../uploads/movies');
            }

            $newName = sha1(time()).'.'.$ext;

            $data = [
                'movies_id' => $id,
                'image'    => $newName,
            ];

            $db->insert('movies_images', $data);

            move_uploaded_file($file['tmp_name'], __DIR__.'/../uploads/movies/'.$newName);

            redirect('movieImages.php?id='.$id);
        } ?>



        <!-- Content Column -->
        <div class="col-md-9">
            <form action="" method="post" enctype="multipart/form-data">
                Upload Movie Image
                <input type="file" name="image"/>
                <input type="submit" value="Upload" name="submit"/>
            </form>

            <div class="row">
                <?php foreach ($images as $image) : ?>
                    <div class="col-xs-6 col-md-3">
                        <a href="#" class="thumbnail">
                            <img src="<?php echo  MOVIES_PICS_URL.'/'.$image['image']; ?>" alt="...">
                        </a>
                        <a href="movieImageDelete.php?id=<?php echo $image['id']; ?>">Delete</a>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
    <!-- /.row -->

<?php require_once 'common/footer.php'; ?>