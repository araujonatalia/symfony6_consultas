<?php

namespace App\Controller;


use App\Entity\Product; //implicito
// use App\Entity\Tag;
// use App\Entity\Comment;

use App\Repository\CommentRepository;
use App\Repository\TagRepository;
use App\Repository\ProductRepository;


use Doctrine\ORM\EntityManagerInterface; //modificacion a la BD CRUD

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(Request $request, TagRepository $tagRepository, ProductRepository $productRepository): Response
    {
        $tag = null;
        if($request->get('tag')){
            $tag = $tagRepository->findOneBy(['name' => $request->get('tag')]);
        }

        return $this->render('page/home.html.twig', [
            'products' => $productRepository->findLatest($tag)
        ]);
    }

    // #[Route('/etiqueta/{id}', name: 'app_tag')]
    // public function tag(Tag $tag, EntityManagerInterface $entityManager): Response
    // {
    //     return $this->render('page/tag.html.twig', [
    //         'tag' => $tag,
    //         'products' => $entityManager->getRepository(Product::class)->findByTag($tag)
    //     ]);
    // }

    #[Route('/producto/{id}', name: 'app_product')]
    public function product(Product $product): Response
    {
        return $this->render('page/product.html.twig', [
            'product' => $product,
          //  'products' => $tag->getProducts()
        ]);
    }

    #[Route('/comentarios', name: 'app_comments')]
    public function comments(CommentRepository $commentRepository): Response
    {
        return $this->render('page/comments.html.twig', [
            'comments' => $commentRepository->findAllComments(),
          //  'products' => $tag->getProducts()
        ]);
    }

    

}
