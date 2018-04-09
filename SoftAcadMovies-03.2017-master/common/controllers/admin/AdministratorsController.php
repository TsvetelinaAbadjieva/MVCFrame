<?php

class AdministratorsController extends Controller
{

    public function index()
    {
        if (!isLoggedInAdmin()) {
            redirect('index.php?c=login&m=login');
        }

        $page = (isset($_GET['page']) && (int)$_GET['page'] > 0)? $_GET['page'] : 1;
        $perPage = 5;
        $offset  = ($page-1)*$perPage;

        $collection = new UserCollection();
        $users = $collection->get([], $offset, $perPage);

        $totalRows = count($collection->get());


        $pagination = new Pagination();

        $pagination->setPerPage($perPage);
        $pagination->setTotalRows($totalRows);
        $pagination->setBaseUrl('index.php?c=administrators');

        $data = [
            'users'      => $users,
            'pagination' => $pagination,
        ];


        $this->loadView('administrators/listing', $data);
    }
}