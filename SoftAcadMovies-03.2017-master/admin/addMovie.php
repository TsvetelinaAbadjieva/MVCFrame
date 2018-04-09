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
                    Create Movie
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
                'title' => '',
                'description' => '',
                'duration' => '',
                'year' => '',
                'genres' => '',
                'director' => '',
                'writers' => '',
                'cast' => '',
                'cover_photo' => '',
                'youtube_link' => '',
                'language' => '',
                'movies_categories_id' => '',
                'category_id' => '',

            ];

            $errors = [
                'title' => [],
                'description' => [],
                'duration' => [],
                'year' => [],
                'genres' => [],
                'director' => [],
                'writers' => [],
                'cast' => [],
                'cover_photo' => [],
                'youtube_link' => [],
                'language' => [],
                'movies_categories_id' => [],
            ];
            $categories = getCategories($conn);

            if (isset($_POST['submit'])) {

                $extensions = ['jpg', 'jpeg', 'png', 'gif'];

                $data =[
                    'title' => isset($_POST['title'])? htmlspecialchars(trim($_POST['title']), ENT_QUOTES, 'UTF-8'): '',
                    'description' => isset($_POST['description'])? htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8'): '',
                    'duration' => isset($_POST['duration'])? htmlspecialchars(trim($_POST['duration']), ENT_QUOTES, 'UTF-8'): '',
                    'year' => isset($_POST['year'])? htmlspecialchars(trim($_POST['year']), ENT_QUOTES, 'UTF-8'): '',
                    'genres' => isset($_POST['genres'])? htmlspecialchars(trim($_POST['genres']), ENT_QUOTES, 'UTF-8'): '',
                    'director' => isset($_POST['director'])? htmlspecialchars(trim($_POST['director']), ENT_QUOTES, 'UTF-8'): '',
                    'writers' => isset($_POST['writers'])? htmlspecialchars(trim($_POST['writers']), ENT_QUOTES, 'UTF-8'): '',
                    'cast' => isset($_POST['cast'])? htmlspecialchars(trim($_POST['cast']), ENT_QUOTES, 'UTF-8'): '',
                    'cover_photo' => isset($_POST['cover_photo'])? htmlspecialchars(trim($_POST['cover_photo']), ENT_QUOTES, 'UTF-8'): '',
                    'youtube_link' => isset($_POST['youtube_link'])? htmlspecialchars(trim($_POST['youtube_link']), ENT_QUOTES, 'UTF-8'): '',
                    'language' => isset($_POST['language'])? htmlspecialchars(trim($_POST['language']), ENT_QUOTES, 'UTF-8'): '',
                    'movies_categories_id' => isset($_POST['movies_categories_id'])? htmlspecialchars(trim($_POST['movies_categories_id']), ENT_QUOTES, 'UTF-8'): '',
                    ];


                if (isset($_FILES['cover_photo'])) {
                    $file = $_FILES['cover_photo'];
                    $ex = explode('.', $file['name']);
                    $ext = strtolower(end($ex));
                    if (!in_array($ext, $extensions)) {
                        $errors['cover_photo'][] = 'Wrong file type';
                    }

                    if ($file['size'] > 2000000) {
                        $errors['cover_photo'][] = 'File size is too big';
                    }


                    if (!is_dir(__DIR__.'/../uploads/movies')) {
                        mkdir(__DIR__.'/../uploads/movies');
                    }

                    $newName = sha1(time()).'.'.$ext;


                }

                $data['cover_photo'] = $newName;


                if (empty(array_filter($errors))) {
                    $db = DB::getInstance();
                    $db->insert('movies', $data);
                    //Записване в базата данни на името на снимката заедно с другата информация от POST
                    move_uploaded_file($file['tmp_name'], __DIR__.'/../uploads/movies/'.$newName);
                }
            }



            ?>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group  <?php echo (!empty($errors['movies_categories_id']))? 'has-error': ''; ?>">
                            <select name="movies_categories_id" id="">
                                <option value="">-- Select Movie Category --</option>
                                <?php foreach($categories as $category) : ?>
                                    <option <?php echo  ($data['movies_categories_id'] == $category['id'])? 'selected' : ''; ?> value="<?php echo $category['id'] ?>"><?php echo $category['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group  <?php echo (!empty($errors['title']))? 'has-error': ''; ?>">
                            <label for="title">title</label>
                            <input type="text" value="<?php echo $data['title']; ?>" class="form-control" name="title" placeholder="Title" id="title" />
                            <?php foreach($errors['title'] as $errorTitle) { ?>
                                <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error: </span>
                                    <?php echo $errorTitle; ?>
                                </div>
                            <?php } ?>
                            <?php //} ?>
                        </div>
                        <div class="form-group  <?php echo (!empty($errors['description']))? 'has-error': ''; ?>">
                            <label for="description">Description</label>
                            <input type="text" value="<?php echo $data['description']; ?>" class="form-control" name="description" placeholder="Description" id="name" />
                            <?php foreach($errors['description'] as $errorDescription) { ?>
                                <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error: </span>
                                    <?php echo $errorDescription; ?>
                                </div>
                            <?php } ?>
                            <?php //} ?>
                        </div>
                        <div class="form-group  <?php echo (!empty($errors['duration']))? 'has-error': ''; ?>">
                            <label for="Duration">Duration</label>
                            <input type="text" value="<?php echo $data['duration']; ?>" class="form-control" name="duration" placeholder="Duration" id="Duration" />
                            <?php foreach($errors['duration'] as $errorName) { ?>
                                <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error: </span>
                                    <?php echo $errorName; ?>
                                </div>
                            <?php } ?>
                            <?php //} ?>
                        </div>
                        <div class="form-group  <?php echo (!empty($errors['genres']))? 'has-error': ''; ?>">
                            <label for="Name">Genres</label>
                            <input type="text" value="<?php echo $data['genres']; ?>" class="form-control" name="year" placeholder="genres" id="genres" />
                            <?php foreach($errors['genres'] as $errorGenres) { ?>
                                <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error: </span>
                                    <?php echo $errorGenres; ?>
                                </div>
                            <?php } ?>
                            <?php //} ?>
                        </div>
                        <div class="form-group  <?php echo (!empty($errors['director']))? 'has-error': ''; ?>">
                            <label for="director">Director</label>
                            <input type="text" value="<?php echo $data['director']; ?>" class="form-control" name="director" placeholder="director" id="director" />
                            <?php foreach($errors['director'] as $errorDirector) { ?>
                                <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error: </span>
                                    <?php echo $errorDirector; ?>
                                </div>
                            <?php } ?>
                            <?php //} ?>
                        </div>
                        <div class="form-group  <?php echo (!empty($errors['writers']))? 'has-error': ''; ?>">
                            <label for="writers">Writers</label>
                            <input type="text" value="<?php echo $data['writers']; ?>" class="form-control" name="writers" placeholder="writers" id="name" />
                            <?php foreach($errors['writers'] as $errorWriters) { ?>
                                <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error: </span>
                                    <?php echo $errorWriters; ?>
                                </div>
                            <?php } ?>
                            <?php //} ?>
                        </div>
                        <div class="form-group  <?php echo (!empty($errors['cast']))? 'has-error': ''; ?>">
                            <label for="cast">Cast</label>
                            <input type="text" value="<?php echo $data['cast']; ?>" class="form-control" name="cast" placeholder="cast" id="cast" />
                            <?php foreach($errors['cast'] as $errorCast) { ?>
                                <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error: </span>
                                    <?php echo $errorCast; ?>
                                </div>
                            <?php } ?>
                            <?php //} ?>
                        </div>
                        <div class="form-group  <?php echo (!empty($errors['cover_photo']))? 'has-error': ''; ?>">
                            <label for="cover_photo">Cover Photo</label>
                            <input type="file"  class="form-control" name="cover_photo"  id="cover_photo" />
                            <?php foreach($errors['cover_photo'] as $errorCoverPhoto) { ?>
                                <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error: </span>
                                    <?php echo $errorCoverPhoto; ?>
                                </div>
                            <?php } ?>
                            <?php //} ?>
                        </div>
                        <div class="form-group  <?php echo (!empty($errors['youtube_link']))? 'has-error': ''; ?>">
                            <label for="youtube_link">Youtube Link</label>
                            <input type="text" value="<?php echo $data['youtube_link']; ?>" class="form-control" name="youtube_link" placeholder="youtube_link" id="youtube_link" />
                            <?php foreach($errors['youtube_link'] as $errorYoutubeLink) { ?>
                                <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error: </span>
                                    <?php echo $errorYoutubeLink; ?>
                                </div>
                            <?php } ?>
                            <?php //} ?>
                        </div>
                        <div class="form-group  <?php echo (!empty($errors['language']))? 'has-error': ''; ?>">
                            <label for="language">Language</label>
                            <input type="text" value="<?php echo $data['language']; ?>" class="form-control" name="language" placeholder="language" id="language" />
                            <?php foreach($errors['language'] as $errorLanguage) { ?>
                                <div class="alert alert-danger" role="alert" style="margin-top:10px;">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error: </span>
                                    <?php echo $errorLanguage; ?>
                                </div>
                            <?php } ?>
                            <?php //} ?>
                        </div>


                        <input type="submit" class="btn btn-primary" name="submit" value="Add movie">
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>

        </div>
    </div>
    <!-- /.row -->

<?php require_once 'common/footer.php'; ?>