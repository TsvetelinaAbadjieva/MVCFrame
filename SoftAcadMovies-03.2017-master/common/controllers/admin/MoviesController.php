<?php

class MoviesController extends Controller
{

    public function index()
    {
        $search     = (isset($_GET['search']))? $_GET['search'] : '';
        $result    = (isset($_GET['results']) && (int)$_GET['results'] > 0)? $_GET['results'] : 1;
        $order      = (isset($_GET['order']) && (int)$_GET['order'] > 0)? $_GET['order'] : 1;

        switch ($result) {
            case "1":
                $perPage = 5;
                break;
            case "2":
                $perPage = 10;
                break;
            case "3":
                $perPage = 20;
                break;
        }

        switch ($order) {
            case 1:
                $orderBy = ' title ASC ';
                break;
            case 2:
                $orderBy = ' title DESC ';
                break;

        }

        $like = [];
        if ($search != '') {
            $like = ['title', $search];
        }



        $page = (isset($_GET['page']) && (int)$_GET['page'] > 0)? $_GET['page'] : 1;

        $offset  = ($page-1)*$perPage;

        $collection = new MoviesCollection();
        $movies = $collection->get([], $offset, $perPage, $like, $order);

        $totalRows = count($collection->get([], -1, 5, $like)) != 0 ? count($collection->get([], -1, 5, $like)) : 1;


        $pagination = new Pagination();

        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($totalRows);
        $pagination->setBaseUrl('index.php?c=movies&search='.$search.'&results='.$result.'&order='.$order);


        $data = [
            'pagination' => $pagination,
            'movies'     => $movies,
            'search'     => $search,
            'result'     => $result,
            'order'      => $order,

        ];

        $this->loadView('movies/listing', $data);
    }

}