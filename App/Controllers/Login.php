<?php
    session_start();
    class Login extends Controller{
        public function print(){
            $this->view('Login');
        }

        public function main(){
            
            if($_POST){
                if(isset($_POST['Login'])){
  //                  echo "User tries to login ". $_POST['username'] . ' ' . $_POST['password'] . "<br>";
                }
                $loginUser = $this->model('user');
                $loginUser ->setUsername($_POST['username']);
                $loginUser ->setPassword($_POST['password']);
                $userMapper = $this->mapper('UserMapper');

                $loginResult=$userMapper ->isValidUser($loginUser);
                if($loginResult=='false')
                {
                    header('Location: '.' http://localhost/DulappMD/Public/Login');
                    
                }
                else
                {
                    $_SESSION["userID"] = $loginResult;
                    header('Location: '.' http://localhost/DulappMD/Public/DulappList');
                }
            }           
        }
    }
?>