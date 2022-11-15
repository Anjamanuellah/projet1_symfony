<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;

use App\Repository\BlogRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/", name="app_blog_index", methods={"GET"})
     */
    public function index(Request $request, BlogRepository $blogRepository): Response
    {
        $description = $request->get('description');
        $title = $request->get('title');

        return $this->render('blog/index.html.twig', [
            //'blogs' => $blogRepository->findBy([ "title" => "dev","description" => "développement web"]),
            'blogs' =>$blogRepository->findOneById($title, $description)

        ]);
        

    // return $this->json(["name" => "bi"]);

    //return $this->redirectToRoute("app_blog_new" , ["id"=>2 ]);
    }

    /**
     * @Route("/new", name="app_blog_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BlogRepository $blogRepository): Response
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogRepository->add($blog, true);

            return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blog/new.html.twig', [
            'blog' => $blog,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_blog_show", methods={"GET"})
     */
    public function show(Blog $blog): Response
    {
        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
        ]);
    }
    
    /**
     * @Route("/edit/{id}", name="app_blog_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Blog $blog, BlogRepository $blogRepository, $id): Response
    {
        $blog = $blogRepository->find($id);
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogRepository->add($blog, true);

            return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blog/edit.html.twig', [
            'blog' => $blog,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_blog_delete", methods={"POST"})
     */
    public function delete(Request $request, Blog $blog, BlogRepository $blogRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blog->getId(), $request->request->get('_token'))) {
            $blogRepository->remove($blog, true);
        }

        return $this->redirectToRoute('app_blog_index', [], Response::HTTP_SEE_OTHER);
    }
}
