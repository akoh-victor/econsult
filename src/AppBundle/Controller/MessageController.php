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
     * @Route("/admin/message", name="read messages")
     */
    public function indexAction(Request $request)
    {
        $message = new Message();

        return $this->render('admin/message.html.twig', array(

        ));
    }
}
