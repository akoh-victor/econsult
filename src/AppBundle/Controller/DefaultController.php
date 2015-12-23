<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\MessageType;
use AppBundle\Form\Type\QuestionsType;
use AppBundle\Entity\Questions;
use AppBundle\Entity\Message;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name = "home")
     */
    public function indexAction(Request $request)
    {
        $News = $this->getDoctrine()
            ->getRepository('AppBundle:News');
        $rescentNews = $News->findAllRescentPublish('20');

        return $this->render('default/index.html.twig', array(
            'rescentNews'=>$rescentNews,
        ));
    }

    /**
     * @Route("/admin", name = "admin")
     */
    public function adminIndexAction(Request $request)
    {


        return $this->render('admin/index.html.twig', array(

        ));
    }

    /**
     * @Route("/faq", name = "faq")
     */
    public function AskAction(Request $request)
    {

        $Questions = $this->getDoctrine()
            ->getRepository('AppBundle:Questions');
        $allquestions = 'akoh';

        if (!$Questions)
        { throw
        $this->createNotFoundException( 'No News found for' );
        }

        $questions = new Questions();
        $form = $this->createForm(new QuestionsType(), $questions);


        $form->handleRequest($request);

        if ($form->isValid())
        {


            $questions->setAskDate(new \DateTime());
            $questions->setVisibility(0);
            $questions->setRelivance(1);
            $questions->setAnswer("");
            $em = $this->getDoctrine()->getManager();
            $em->persist($questions);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Your question was sent!!! We will get back to you soon.');
            return $this->redirect($this->generateUrl('faq'));
        }


        return $this->render('default/faq.html.twig', array( 'form' => $form ->createView(),'question' => $allquestions, ));



    }


    /**
     * @Route("/about", name = "about")
     */
    public function aboutAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/about.html.twig', array(
        ));
    }
    /**
     * @Route("/news", name ="news")
     */
    public function browsNewsAction()
    {
        $News = $this->getDoctrine()->getRepository('AppBundle:News');
        $mostRead = $News->findAllRescentPublish('12');
        $rescentNews = $News->findAllRescentPublish('12');


        return $this->render('default/news.html.twig', array(

            'rescentNews'=> $rescentNews,
            'mostRead'=>$mostRead
        ));

    }
    /**
     * @Route("/news/{id}", name="browsnews")
     */
    public function browsAction($id)
    {

        $News = $this->getDoctrine()->getRepository('AppBundle:News');
        $newsResorces = $News->find($id);
        $mostRead=$News->mostView(6);
        $rescentNews= $News->findAllRescentPublish('3');



        if ($newsResorces) {

            $curView = $newsResorces->getView();
            $upView = $curView + 1;
            $newsResorces->setView($upView);

            $em = $this->getDoctrine()->getManager();
            $em->persist($newsResorces);
            $em->flush();

        }



        return $this->render('default/brows.html.twig', array(

            'newsResorces' =>  $newsResorces,
            'rescentNews' => $rescentNews,
            'mostRead' => $mostRead,

        ));
    }


    /**
     * @Route("/service", name = "service")
     */
    public function serviceAction(Request $request)
    {

        return $this->render('default/service.html.twig', array(
        ));
    }
    /**
     * @Route("/contact", name = "contact")
     */
    public function contactAction(Request $request)
    {




        $message = new Message();
        $form = $this->createForm(new MessageType(), $message);
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $message->setPosted(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Your message was successfully sent!!! We will get back to you soon.');
            return $this->redirect($this->generateUrl('contact'));
        }


        return $this->render('default/contact.html.twig', array( 'form' => $form ->createView(),));

    }

    /**
     * @Route("/contact", name = "readnews")
     */
    public function readNewsAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/contact.html.twig', array(
        ));
    }
}