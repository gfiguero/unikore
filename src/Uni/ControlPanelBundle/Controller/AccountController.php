<?php

namespace Uni\ControlPanelBundle\Controller;

use Uni\AdminBundle\Entity\Account;
use Uni\ControlPanelBundle\Form\AccountType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AccountController extends Controller
{
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        $editForm = $this->createForm(new AccountType(), $account);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'account.edit.flash' );
                return $this->redirect($this->generateUrl('controlpanel_account_edit'));
            }
        }

        return $this->render('UniControlPanelBundle:Account:edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    public function showAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        return $this->render('UniControlPanelBundle:Account:show.html.twig', array(
            'account' => $account,
        ));
    }

}
