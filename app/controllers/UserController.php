<?php

namespace app\controllers;

use app\models\User;

class UserController extends AppController {

    public function signupAction(){
        if(!empty($_POST)){
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if (!$user->validate($data) || !$user->checkUnique()){
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            }else{
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                if($user->save('user')){
                    $_SESSION['success'] = 'Va-ți înregistrat cu succes';
                    redirect(PATH);
                }else{
                    $_SESSION['error'] = 'Eroare!';
                }

            }
            redirect();
        }
        $this->setMeta('Înregistrare');
    }

    public function loginAction(){
        if(!empty($_POST)){
            $user = new User();
            if($user->login()){
                $_SESSION['success'] = 'Sunteți autorizat cu succes!';
                redirect(PATH);

            }else{
                $_SESSION['error'] = 'Login sau password introduse greșit';
            }
            redirect();
        }
        $this->setMeta('Intră');
    }

    public function logoutAction(){
        if(isset($_SESSION['user'])) unset($_SESSION['user']);
        redirect(PATH);
    }

}