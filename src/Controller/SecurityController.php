<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        // si il est connecter en tant qu'Admin je le redirige vers la route admin 
        if($this->getUser() !== null){
            return $this->redirectToRoute('app_home');
        }
        return $this->render('@EasyAdmin/page/login.html.twig', [
            // parameters usually defined in Symfony login forms
            'error' => $error,
            'last_username' => $lastUsername,
             // the URL users are redirected to after the login (default: '/admin')
              //quand il se connecte, si est connecté en tant qu'Admin je le redirige vers la route admin 
            //  si nn je le redirige vers l'accueil
             'target_path' => $this->redirectToRoute('app_home'),
            // OPTIONAL parameters to customize the login form:

            // the translation_domain to use (define this option only if you are
            // rendering the login template in a regular Symfony controller; when
            // rendering it from an EasyAdmin Dashboard this is automatically set to
            // the same domain as the rest of the Dashboard)
            'translation_domain' => 'admin',

            // the title visible above the login form (define this option only if you are
            // rendering the login template in a regular Symfony controller; when rendering
            // it from an EasyAdmin Dashboard this is automatically set as the Dashboard title)
            'page_title' => 'Connexion',

            // the string used to generate the CSRF token. If you don't define
            // this parameter, the login form won't include a CSRF token
            'csrf_token_intention' => 'authenticate',


            // the label displayed for the username form field (the |trans filter is applied to it)
            'username_label' => 'Votre email',

            // the label displayed for the password form field (the |trans filter is applied to it)
            'password_label' => 'Votre mot de passe',

            // the label displayed for the Sign In form button (the |trans filter is applied to it)
            'sign_in_label' => 'Se connecter',

            // the 'name' HTML attribute of the <input> used for the username field (default: '_username')
            'username_parameter' => '',

            // the 'name' HTML attribute of the <input> used for the password field (default: '_password')
            'password_parameter' => '',

            // whether to enable or not the "forgot password?" link (default: false)
            'forgot_password_enabled' => false,

            // the path (i.e. a relative or absolute URL) to visit when clicking the "forgot password?" link (default: '#')
           // 'forgot_password_path' => $this->generateUrl('app_forgot_password_request'),

            // the label displayed for the "forgot password?" link (the |trans filter is applied to it)
            // 'forgot_password_label' => 'Mot de passe oublié?',

            // whether to enable or not the "remember me" checkbox (default: false)
            'remember_me_enabled' => true,

            // remember me name form field (default: '_remember_me')
            'remember_me_parameter' => 'custom_remember_me_param',

            // whether to check by default the "remember me" checkbox (default: false)
            'remember_me_checked' => true,

            // the label displayed for the remember me checkbox (the |trans filter is applied to it)
            'remember_me_label' => 'Garder ma session',
        ]);
    }
     #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout()
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}