<?php

namespace EnderecoBundle\Controller;

use DoctrineTest\InstantiatorTestAsset\SerializableArrayObjectAsset;
use EnderecoBundle\Entity\Endereco;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Endereco controller.
 *
 * @Route("endereco")
 */
class EnderecoController extends Controller
{
    /**
     * Lists all endereco entities.
     *
     * @Route("/", name="endereco_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $enderecos = $em->getRepository('EnderecoBundle:Endereco')->findAll();

//        Monta o Serializer
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

//        Serializa para json os objetos
        $enderecosJson  = array();
        foreach($enderecos as $endereco){
            array_push($enderecosJson, $serializer->serialize($endereco, 'json'));
        }

        return $this->render('endereco/index.html.twig', array(
            'enderecosJson' => $serializer->serialize($enderecosJson, 'json'),
        ));
    }

    /**
     * Lists all endereco entities from contato.
     *
     * @Route("/contato/index", name="index_contato_endereco")
     * @Method("GET")
     */
    public function indexContatoAction(Request $request)
    {
        $id         = $request->get('id');

        $em = $this->getDoctrine()->getManager();

        $enderecos  = $em->getRepository('EnderecoBundle:Endereco')
                    ->findBy(array('contatoIdContato' => $id ));

//        Monta o Serializer
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

//        Serializa para json os objetos
        $enderecosJson  = array();
        foreach($enderecos as $endereco){
            array_push($enderecosJson, $serializer->serialize($endereco, 'json'));
        }


//        if($request->isXmlHttpRequest()){
        return $this->render('endereco/index.html.twig', array(
            'extends' => 'clean.html.twig',
            'enderecosJson' => $serializer->serialize($enderecosJson, 'json'),
        ));
    }

    /**
     * Creates a new endereco entity.
     *
     * @Route("/new", name="endereco_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $endereco   = new Endereco();
        $form       = $this->createForm('EnderecoBundle\Form\EnderecoType', $endereco);
        $form->handleRequest($request);

        // Instancia Doctrine
        $em         = $this->getDoctrine()->getManager();

        // Carrega os contatos para vinculação
        $contatos = $em->getRepository('ContatosBundle:Contato')->findAll();

        // Pega a requisição POST
//        $post = Request::createFromGlobals();

        // Valida se form foi enviado ou só está carregando a página
        if (
            $form->isSubmitted() && // $post->request->has('submit')
            $form->isValid()) {

            // Instancia objeto para inserir baseado no form
            $endereco->setQuadra( $request->get('quadra') );
            $endereco->setNumero( $request->get('numero') );
            $endereco->setObservacao( $request->get('observacao') );
            $endereco->setContatoIdContato( $request->get('contatoIdContato') );

            $em->persist($endereco);
            $em->flush();

            return $this->redirectToRoute('endereco_show', array(
                'id'        => $endereco->getId(),
                'contatos'  => $contatos
            ));
        }

        return $this->render('endereco/new.html.twig', array(
            'endereco'  => $endereco,
            'form'      => $form->createView(),
            'contatos'  => $contatos
        ));
    }

    /**
     * Creates a new endereco entity.
     *
     * @Route("/contato/new", name="new_contato_endereco")
     * @Method({"GET", "POST"})
     */
    public function newContatoAction(Request $request)
    {
        $endereco   = new Endereco();
        $form       = $this->createForm('EnderecoBundle\Form\EnderecoType', $endereco);
        $form->handleRequest($request);

        $id         = $request->get('id');

        // Instancia Doctrine
        $em         = $this->getDoctrine()->getManager();

        // Carrega os contatos para vinculação
        $contatos = $em->getRepository('ContatosBundle:Contato')->findAll();

        // Valida se form foi enviado ou só está carregando a página
        if (
            $form->isSubmitted() && // $post->request->has('submit')
            $form->isValid()) {

            // Instancia objeto para inserir baseado no form
            $endereco->setQuadra( $request->get('quadra') );
            $endereco->setNumero( $request->get('numero') );
            $endereco->setObservacao( $request->get('observacao') );
            $endereco->setContatoIdContato( $request->get('contatoIdContato') );

            $em->persist($endereco);
            $em->flush();

            return $this->redirectToRoute('endereco_show', array(
                'id'        => $endereco->getId(),
                'contatos'  => $contatos
            ));
        }

//        if($request->isXmlHttpRequest()){
        return $this->render('endereco/new.html.twig', array(
            'ContatoIdContato' => $id,
            'endereco'  => $endereco,
            'form'      => $form->createView(),
            'contatos'  => $contatos,
            'extends' => 'clean.html.twig',
        ));

    }

    /**
     * Finds and displays a endereco entity.
     *
     * @Route("/{id}", name="endereco_show")
     * @Method("GET")
     */
    public function showAction(Endereco $endereco)
    {
        // Cria form para deletar
        $deleteForm = $this->createDeleteForm($endereco);

        // Instancia Doctrine
        $em         = $this->getDoctrine()->getManager();

        // Carrega os contato para visualizaçã do nome ao invés do ID
        $contato    = $em->getRepository('ContatosBundle:Contato')->find($endereco->getContatoIdContato());

        return $this->render('endereco/show.html.twig', array(
            'endereco'      => $endereco,
            'delete_form'   => $deleteForm->createView(),
            'contato'       => $contato
        ));
    }

    /**
     * Displays a form to edit an existing endereco entity.
     *
     * @Route("/{id}/edit", name="endereco_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Endereco $endereco)
    {
        $deleteForm = $this->createDeleteForm($endereco);
        $editForm = $this->createForm('EnderecoBundle\Form\EnderecoType', $endereco);
        $editForm->handleRequest($request);

        // Instancia Doctrine
        $em         = $this->getDoctrine()->getManager();

        // Carrega os contatos para vinculação
        $contatos   = $em->getRepository('ContatosBundle:Contato')->findAll();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em     = $this->getDoctrine()->getManager();

            // Instancia objeto para inserir baseado no form
            $endereco->setQuadra( $request->get('quadra') );
            $endereco->setNumero( $request->get('numero') );
            $endereco->setObservacao( $request->get('observacao') );
            $endereco->setContatoIdContato( $request->get('contatoIdContato') );

            $em->persist($endereco);
            $em->flush();

            return $this->redirectToRoute('endereco_edit', array('id' => $endereco->getId()));
        }

        return $this->render('endereco/edit.html.twig', array(
            'endereco'      => $endereco,
            'edit_form'     => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
            'contatos'      => $contatos
        ));
    }

    /**
     * Deletes a endereco entity.
     *
     * @Route("/{id}", name="endereco_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Endereco $endereco)
    {
        $form = $this->createDeleteForm($endereco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($endereco);
            $em->flush();
        }

        return $this->redirectToRoute('endereco_index');
    }

    /**
     * Creates a form to delete a endereco entity.
     *
     * @param Endereco $endereco The endereco entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Endereco $endereco)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('endereco_delete', array('id' => $endereco->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
