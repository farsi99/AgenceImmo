<?php 

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController{
    
    /**
     * @Route("/login", name="login")
     */
    public function log(AuthenticationUtils $auth){
        $lasUsername = $auth->getLastUsername();
        $error = $auth->getlastAuthenticationError();        
        return $this->render('security\login.html.twig',[
            'last_username' => $lasUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){}
}