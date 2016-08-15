<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Dog;
use AppBundle\Entity\PottyTime;
use Symfony\Component\HttpFoundation\Response;

class TrackerController extends Controller
{
    /**
     * @Route("/{name}-tracker", name="tracker")
     */
    public function trackerAction(Request $request, $name)
    {
        $name = strtolower($name);

        $em = $this->getDoctrine()->getManager();

        $dog = $em->getRepository('AppBundle:Dog')->findOneByName($name);
        $context = [
            'dog_name' => $name
        ];

        if ($dog) {
            $request->getSession()->set('dog_id', $dog->getId());

            return $this->render('tracker/tracker.html.twig', $context);
        } else {
            return $this->render('tracker/create.html.twig', $context);
        }
    }

    /**
     * @Route("/today", name="today")
     */
    public function todayAction(Request $request)
    {
        $dog_id = $request->getSession()->get('dog_id');

        $em = $this->getDoctrine()->getManager();
        $dog = $em->getRepository('AppBundle:Dog')->findById($dog_id);
        $context = [

        ];

        if ($dog) {
            return $this->render('tracker/today.html.twig', $context);
        } else {
            return new Response('dog not found');
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

    /**
     * @Route("/new_entry", name="new_entry")
     * @Method({"POST"})
     */
    public function entryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entry = new PottyTime();
        $entry->setIsPee($request->get('is_pee') === 'true');
        $entry->setIsPoop($request->get('is_poop') === 'true');

        $em->persist($entry);
        $em->flush();

        return new Response('done');
    }
}
