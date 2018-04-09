<?php


class LoginController extends Controller
{
    public function index()
    {
        parent::index(); // TODO: Change the autogenerated stub
    }

    public function login()
    {
        
        if (isLoggedInAdmin()) {
            //redirect('index.php');
        }


        $data = [
            'username' => '',
            'password' => '',
        ];
        
        $error = '';

        if (isset($_POST['submit'])) {
            $data = [
                'username' => isset($_POST['username']) ? trim(htmlspecialchars($_POST['username'])) : '',
                'password' => isset($_POST['password']) ? trim(htmlspecialchars($_POST['password'])) : '',
            ];


            if (strlen($data['username']) > 4 &&
                strlen($data['username']) <= 255 &&
                strlen($data['password']) > 4 &&
                strlen($data['password']) <= 255
            ) {
               
                $collection  = new UserCollection();
                $where = ['username' => $data['username']];
                $user  = $collection->getOne($where);

                if (!empty($user)) {
                    $pass = sha1($data['password']);
                    if ($pass == $user->getPassword()) {
                        $_SESSION['logged_in'] = 1;
                        $_SESSION['user']      = $user;
                        redirect('index.php');

                    } else {
                        $error = "Wrong credentials";
                    }

                } else {
                    $error = "Wrong credentials";
                }

            } else {
                $error = "Wrong credentials";
            }

        }
        
        
        
        $this->loadView('login/login', $data);
    }

    public function logout() {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user']);

        redirect('index.php?c=login&m=login');
    }


}