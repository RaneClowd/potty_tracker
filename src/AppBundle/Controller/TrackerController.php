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

    /**
     * @Route("/new_entry", name="new_entry")
     * @Method({"POST"})
     */
    public function entryAction(Request $request)
    {
        $entry = new PottyTime();
        $entry->setIsPee($request->get('is_pee') === 'true');
        $entry->setIsPoop($request->get('is_poop') === 'true');

        $em = $this->getDoctrine()->getManager();
        $em->persist($entry);
        $em->flush();

        return new Response('done');
    }
}
