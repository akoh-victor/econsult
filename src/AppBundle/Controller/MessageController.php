<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;

use AppBundle\Form\Type\MessageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends Controller
{
    /**
     * @Route("/admin/message", name="message home")
     */
    public function messageIndexAction(Request $request)
    {
        $Message = $this->getDoctrine()->getRepository('AppBundle:Message');
        $recentMessages = $Message->findRecentMessages('20');
        $recentUnreadMessages = $Message->findRecentUnreadMessages('20');
        $unreadMessages = $Message->findRecentUnreadMessages('20');
        $recentReadMessages = $Message->findRecentReadMessages('20');


        return $this->render('admin/message.html.twig', array(
             'recentMessages' => $recentMessages,
             'unreadMessages' => $unreadMessages,
             'recentReadMessages' => $recentReadMessages,
             'recentUnreadMessages' => $recentUnreadMessages
        ));
    }

    /**
     * @Route("/admin/message/read/{id}", name="read news")
     */
    public function readMessageAction($id)
    {
        $Message = $this->getDoctrine()->getRepository('AppBundle:Message');
        $selMessage = $Message->find($id);
        $recentMessages = $Message->findRecentMessages('20');
        $recentUnreadMessages = $Message->findRecentUnreadMessages('20');
        $unreadMessages = $Message->findRecentUnreadMessages('20');
        $recentReadMessages = $Message->findRecentReadMessages('20');

       

       
        
        if ($selMessage) {

            $curView = $selMessage->getView();
           echo  $upView = $curView + 1;
            $selMessage->setView($upView);
            $em = $this->getDoctrine()->getManager();
            $em->persist($selMessage);
            $em->flush();


        }
        
        return $this->render('admin/brows.html.twig', array(
            'selMessage' => $selMessage,
            'recentMessages' => $recentMessages,
            'unreadMessages' => $unreadMessages,
            'recentReadMessages' => $recentReadMessages,
            'recentUnreadMessages' => $recentUnreadMessages
        ));
    }

}
