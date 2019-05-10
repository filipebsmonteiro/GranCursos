<?php

namespace ContatosBundle\Controller;

use ContatosBundle\Entity\Contato;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Contato controller.
 *
 * @Route("contato")
 */
class ContatoController extends Controller
{
    /**
     * Lists all contato entities.
     *
     * @Route("/", name="contato_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contatos = $em->getRepository('ContatosBundle:Contato')->findAll();

        return $this->render('contato/index.html.twig', array(
            'contatos' => $contatos,
        ));
    }

    /**
     * Creates a new contato entity.
     *
     * @Route("/new", name="contato_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $contato = new Contato();
        $form = $this->createForm('ContatosBundle\Form\ContatoType', $contato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contato);
            $em->flush();

            return $this->redirectToRoute('contato_show', array('id' => $contato->getId()));
        }
//        die((string) $form->getErrors(true));

        return $this->render('contato/new.html.twig', array(
            'contato' => $contato,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a contato entity.
     *
     * @Route("/{id}", name="contato_show")
     * @Method("GET")
     */
    public function showAction(Contato $contato)
    {
        $deleteForm = $this->createDeleteForm($contato);

        return $this->render('contato/show.html.twig', array(
            'contato' => $contato,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing contato entity.
     *
     * @Route("/{id}/edit", name="contato_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Contato $contato)
    {
        $deleteForm = $this->createDeleteForm($contato);
        $editForm = $this->createForm('ContatosBundle\Form\ContatoType', $contato);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contato_edit', array('id' => $contato->getId()));
        }

        return $this->render('contato/edit.html.twig', array(
            'contato' => $contato,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a contato entity.
     *
     * @Route("/{id}", name="contato_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Contato $contato)
    {
        $form = $this->createDeleteForm($contato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contato);
            $em->flush();
        }

        return $this->redirectToRoute('contato_index');
    }

    /**
     * Creates a form to delete a contato entity.
     *
     * @param Contato $contato The contato entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contato $contato)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contato_delete', array('id' => $contato->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
