<?php 

class AuthenticationController extends BaseController
{
    //load model
    private $model;
    function __construct()
    {
        $this->model = $this->load_model('Main');
    }

    //sign up
    public function register_user(){
            $this->validatePost();
            if($this->model->check_if_exists('tbl_users', '*', ['email_address'=>$_POST['email_address']])){
                echo json_encode('The User Exists');
            }else{
                $user_id = time().'_'.rand(1000,9999);
                $data = [
                    'user_id'=>$user_id,
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'email_address' => $_POST['email_address'],
                ];
                $this->model->insert_data('tbl_users', $data);
                $user = [
                    'user_id' => $user_id,
                    'email_address' => $_POST['email_address'],
                ];
                $user = (object)$user;
                $this->createSession($user);
                echo json_encode('registered');
            }
    }

    //login
    public function login_user(){
        $this->validatePost();
        if($this->model->check_if_exists('tbl_users', '*', ['email_address'=>$_POST['email_address']])){
            $user = $this->model->retrieve_row('tbl_users', '*', ['email_address'=>$_POST['email_address']]);

            if(password_verify($_POST['password'], $user->password)){
                $this->createSession($user);
                echo json_encode('logged in');
            }else{
                echo json_encode('Wrong Credentials');
            }
        }else{
            echo json_encode('User does not exist!');
        }

    }

    //update profile
    public function change_details($parameters){
        $this->validatePost();
        $type=$parameters[0];
        if($type=='email'){
            $data = [
                'email_address' => $_POST['email_address'],
            ];
            $where = [
                'user_id' => $_SESSION['user_id'],
            ];

            $this->model->update_row('tbl_users', $data, $where);
            $_SESSION['email_address'] = $_POST['email_address'];
            echo json_encode('updated');
        }

        if($type=='password'){
            $user = $this->model->retrieve_row('tbl_users', '*', ['user_id'=>$_SESSION['user_id']]);

            if(password_verify($_POST['old_password'], $user->password)){
                $data = [
                    'password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
                ];
                $where = [
                    'user_id' => $_SESSION['user_id'],
                ];

                $this->model->update_row('tbl_users', $data, $where);
                echo json_encode('changed');
            }else{
                echo json_encode('Wrong Password');
            }
        }
    }

    //session
    public function createSession($user){
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['email_address'] = $user->email_address;
    }

    //logout
    public function logout(){
        unset($_SESSION['loggedin'],$_SESSION['user_id'],$_SESSION['email_address']);
        $this->redirect('main');
    }
    
}
