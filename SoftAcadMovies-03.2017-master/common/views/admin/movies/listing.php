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
                    Movies Listing
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

            <form action="" method="get">
                <input type="hidden" name="c" value="movies">
                <div class="form-group">
                    <label for="search">Search by name</label>
                    <input type="text" id="search" name="search" value='<?php echo $search; ?>' class="form-control">
                </div>
                <div class="form-group">
                    <label for="results">Results per page</label>
                    <select name="results" id="results" class="form-control">
                        <option value="1" <?php echo  ($result == 1)? 'selected' : '' ?>> 5 </option>
                        <option value="2" <?php echo  ($result == 2)? 'selected' : '' ?>> 10 </option>
                        <option value="3" <?php echo  ($result == 3)? 'selected' : '' ?>> 20 </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="order">Order by</label>
                    <select name="order" id="order" class="form-control">
                        <option value="1" <?php echo  ($order == 1)? 'selected' : '' ?>> Order by name Ascending </option>
                        <option value="2" <?php echo  ($order == 2)? 'selected' : '' ?>> Order by name Descending </option>
                    </select>
                </div>

                <input type="submit" class="btn btn-default">

            </form>


            <a href="addMovie.php"  class="btn btn-info pull-right">Create Movie</a>
            <?php
            if (isset($_SESSION['flash']) && $_SESSION['flash'] != '') {
                echo $_SESSION['flash'];
                unset($_SESSION['flash']);
            }
            ?>

            <?php echo  $pagination->create(); ?>
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Year</th>
                    <th>Genres</th>
                    <th>Director</th>
                    <th>Writers</th>
                    <th>Cast</th>
                    <th>Rating</th>
                    <th>Cover Photo</th>
                    <th>Youtube Link</th>
                    <th>Language</th>
                    <th>Category</th>


                </tr>
                <?php foreach ($movies as $movie) : ?>
                    <tr>
                        <?php /* @var $movie MoviesEntity */ ?>
                        <td><?php echo $movie->getId(); ?></td>
                        <td><?php echo $movie->getTitle(); ?></td>
                        <td><?php echo $movie->getDescription(); ?></td>
                        <td><?php echo $movie->getDuration(); ?></td>
                        <td><?php echo $movie->getYear(); ?></td>
                        <td><?php echo $movie->getGenres(); ?></td>
                        <td><?php echo $movie->getDirector(); ?></td>
                        <td><?php echo $movie->getWriters(); ?></td>
                        <td><?php echo $movie->getCast(); ?></td>
                        <td><?php echo $movie->getRating(); ?></td>
                        <td>
                            <img style="width:50px; height:50px;" src="<?php echo MOVIES_PICS_URL.'/'.$movie->getCoverPhoto(); ?>" alt="">

                        </td>
                        <td><?php echo $movie->getYoutubeLink(); ?></td>
                        <td><?php echo $movie->getLanguage(); ?></td>
                        <td><?php echo $movie->getCategoryTitle(); ?></td>

                        <td>
                            <a href="movieImages.php?id=<?php echo $movie->getId(); ?>"  class="btn btn-warning">Movie Images</a>
                            <a href="editMovie.php?id="  class="btn btn-warning">Edit</a>
                            <a href="deleteMovie.php?id=>"  class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>

            <?php echo  $pagination->create(); ?>
        </div>
    </div>
    <!-- /.row -->

<?php require_once 'common/footer.php'; ?>