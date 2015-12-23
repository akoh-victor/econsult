<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\AnswerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FaqController extends Controller
{
    /**
     * @Route("/admin/question", name="read questions")
     */
    public function readAction(Request $request)
    {

        $Questions = $this->getDoctrine()
                          ->getRepository('AppBundle:Questions');
        $allquestions = $Questions->findAll();

        if (!$Questions)
        { throw
        $this->createNotFoundException( 'No Record  found' );
        }
        return $this->render('admin/faq.html.twig', array('question' => $allquestions, ));


    }

    /**
     * @Route("admin/faq/answer/{id}", name="answer question")
     */
    public function AnswerAction($id){

        $em = $this->getDoctrine()->getEntityManager();
        $Questions  = $em->getRepository('AppBundle:Questions')->find($id);
       // $allnews =$em->getRepository('AppBundle:Questions')->findAllRescentPublish('15');


        $request = $this->get('request');

        if (is_null($id)) {
            $postData = $request->get('questions');
            $id = $postData['id'];
        }

        $form = $this->createForm(new AnswerType(), $Questions);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($Questions);
                $em->flush();

                return $this->redirect($this->generateUrl('read questions'));
            }
        }

        return $this->render('admin/faq.html.twig', array( 'form' => $form ->createView(),/*'news' => $allnews,*/ ));
    }







}
