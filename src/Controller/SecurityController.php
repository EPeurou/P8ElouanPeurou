<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/security")
 */
class SecurityController extends AbstractController
{
    

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // $authenticationUtils = $this->container->get('security.authentication_utils');
        $user = $this->getUser();
        if ($user != null){
            // dd("ok");
            return $this->redirectToRoute('task_list', [], Response::HTTP_SEE_OTHER);
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('securityfirst/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    // /**
    //  * @Route("/login_check", name="login_check", methods={"POST"})
    //  */
    // public function loginCheck(Request $request): PassportInterface
    // {
    //     // dd("test");
    //     $password = $request->request->get('password');
    //     // dd("test");
    //     $username = $request->request->get('username');
        
    //     $request->getSession()->set(Security::LAST_USERNAME, $username);

    //     return new Passport(
    //         new UserBadge($username),
    //         new PasswordCredentials($request->request->get('password')),
    //         [
    //             new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
    //         ]
    //     );
    // }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutCheck()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

}
