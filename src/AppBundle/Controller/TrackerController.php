<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Dog;

class TrackerController extends Controller
{
    /**
     * @Route("/{name}-tracker", name="tracker")
     */
    public function trackerAction(Request $request, $name)
    {
        $name = strtolower($name);

        $em = $this->getDoctrine()->getManager();

        $dog = $em->getRepository('AppBundle:Dog')->findByName($name);
        $context = [
            'dog_name' => $name
        ];

        if ($dog) {
            return $this->render('tracker/tracker.html.twig', $context);
        } else {
            return $this->render('tracker/create.html.twig', $context);
        }
    }

    /**
     * @Route("/{name}-create", name="create")
     */
    public function createAction(Request $request, $name)
    {
        $em = $this->getDoctrine()->getManager();

        $dog = new Dog();
        $dog->setName($name);

        $em->persist($dog);
        $em->flush();

        return $this->redirectToRoute('tracker', [ 'name' => $name ]);
    }
}
