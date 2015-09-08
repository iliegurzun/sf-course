<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\NewsletterCampaign;
use AppBundle\Form\NewsletterCampaignType;

/**
 * NewsletterCampaign controller.
 *
 * @Route("/newslettercampaign")
 */
class NewsletterCampaignController extends Controller
{

    /**
     * Lists all NewsletterCampaign entities.
     *
     * @Route("/", name="newslettercampaign")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:NewsletterCampaign')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new NewsletterCampaign entity.
     *
     * @Route("/", name="newslettercampaign_create")
     * @Method("POST")
     * @Template("AppBundle:NewsletterCampaign:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new NewsletterCampaign();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newslettercampaign_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a NewsletterCampaign entity.
     *
     * @param NewsletterCampaign $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(NewsletterCampaign $entity)
    {
        $form = $this->createForm(new NewsletterCampaignType(), $entity, array(
            'action' => $this->generateUrl('newslettercampaign_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new NewsletterCampaign entity.
     *
     * @Route("/new", name="newslettercampaign_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new NewsletterCampaign();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a NewsletterCampaign entity.
     *
     * @Route("/{id}", name="newslettercampaign_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:NewsletterCampaign')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsletterCampaign entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing NewsletterCampaign entity.
     *
     * @Route("/{id}/edit", name="newslettercampaign_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:NewsletterCampaign')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsletterCampaign entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a NewsletterCampaign entity.
    *
    * @param NewsletterCampaign $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(NewsletterCampaign $entity)
    {
        $form = $this->createForm(new NewsletterCampaignType(), $entity, array(
            'action' => $this->generateUrl('newslettercampaign_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing NewsletterCampaign entity.
     *
     * @Route("/{id}", name="newslettercampaign_update")
     * @Method("PUT")
     * @Template("AppBundle:NewsletterCampaign:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:NewsletterCampaign')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsletterCampaign entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('newslettercampaign_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a NewsletterCampaign entity.
     *
     * @Route("/{id}", name="newslettercampaign_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:NewsletterCampaign')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NewsletterCampaign entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('newslettercampaign'));
    }

    /**
     * Creates a form to delete a NewsletterCampaign entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('newslettercampaign_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
