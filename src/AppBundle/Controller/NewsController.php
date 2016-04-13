<?php

namespace AppBundle\Controller;

use AppBundle\Entity\News;

use AppBundle\Form\Type\NewsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    /**
     * @Route("/admin/news", name="create news")
     */
    public function indexAction(Request $request)
    {
        $News = $this->getDoctrine()
            ->getRepository('AppBundle:News');
        $rescentNews = $News->findAllRescentPublish('20');

        if (!$News)
        { throw
        $this->createNotFoundException( 'No News found' );
        }

        $news = new News();
        $form = $this->createForm(new NewsType(), $news);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $news->setPublishDate(new \DateTime());
            $news->setExpire(0);
            $news->setView(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();
            return $this->redirect($this->generateUrl('create news'));
        }
        return $this->render('admin/news.html.twig', array(
            'form' => $form ->createView(),
            'rescentNews'=>$rescentNews,
            'news'=>$news,
        ));
    }




    /**
     * @Route("admin/news/edit/{id}", name="manage news")
     */

    public function editAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $News  = $em->getRepository('AppBundle:News')->find($id);
        $rescentNews = $em->getRepository('AppBundle:News')->findAllRescentPublish('20');

        $request = $this->get('request');

        if (is_null($id)) {
            $postData = $request->get('news');
            $id = $postData['id'];
        }
        $form = $this->createForm(new NewsType(), $News);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($News);
                $em->flush();

                return $this->redirect($this->generateUrl('create news'));
            }
        }

        return $this->render('admin/news.html.twig', array( 'form' => $form ->createView(), 'rescentNews'=>$rescentNews, ));
    }



}
