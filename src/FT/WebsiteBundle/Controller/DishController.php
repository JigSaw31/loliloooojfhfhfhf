<?php
/**
 * Created by PhpStorm.
 * User: thoma
 * Date: 18/06/2018
 * Time: 15:03
 */

namespace FT\WebsiteBundle\Controller;


use FT\WebsiteBundle\Entity\Dish;
use FT\WebsiteBundle\Form\DishEditType;
use FT\WebsiteBundle\Form\DishType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class DishController extends Controller
{
    public function indexAction($page)
    {

        if ($page < 1){

            throw $this->createNotFoundException("La page".$page." n'existe pas.");
        }


        $listDish = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FTWebsiteBundle:Dish')
            ->getAllDish();
        ;

        // On donne toutes les informations nécessaires à la vue
        return $this->render('@FTWebsite/Dish/index.html.twig', array(
            'listdish'        => $listDish,
        ));

    }

    public function viewAction($id)
    {
        return $this->render('@FTWebsite/Dish/view.html.twig');
    }

    public function addAction(Request $request)
    {

        $dish = new Dish();

        $form = $this->get('form.factory')->create(DishType::class, $dish);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){


            $em = $this->getDoctrine()->getManager();
            $em->persist($dish);
            $em->flush();


            return $this->redirectToRoute('ft_website_dish_home', array('id' => $dish->getId()));

        }

        return $this->render('@FTWebsite/Dish/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $dish = $em->getRepository('FTWebsiteBundle:Dish')->find($id);

        if (null === $dish) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        $form = $this->get('form.factory')->create(DishEditType::class, $dish);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // Inutile de persister ici, Doctrine connait déjà notre annonce
            $em->flush();


            return $this->redirectToRoute('oc_platform_home');
        }

        return $this->render('@FTWebsite/Dish/edit.html.twig', array(
            'dish' => $dish,
            'form'   => $form->createView(),
        ));

    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $dish = $em->getRepository('FTWebsiteBundle:Dish')->find($id);

        if (null === $dish) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($dish);
            $em->flush();


            return $this->redirectToRoute('ft_website_admin_dish_index');
        }

        return $this->render('@FTWebsite/Dish/delete.html.twig', array(
            'dish' => $dish,
            'form'   => $form->createView(),
        ));
    }
}