<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login', 'inscription']);
    }


    public function login()
    {
        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/';
            return $this->redirect($target);
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid username or password');
        }
    }

    public function inscription()
    {
        if($this->request->is('post')){
            $user =  $this->Users->newEmptyEntity();
            $user->id_user = 0;
            $user->name = $this->request->getData("Name");
            $user->email = $this->request->getData("Email");
            $user->passwd = $this->request->getData("Password");
    
            if ($this->Users->find()->all() == []) {
                $user->admin = 1;
            }else{
                $user->admin = 0;
            }
    
            $this->Users->save($user);
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}
