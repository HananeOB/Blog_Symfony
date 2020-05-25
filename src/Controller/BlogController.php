<?php
// src/Controller/BlogController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticlesRepository;
use App\Repository\UsersRepository;
class BlogController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(ArticlesRepository $articlesRepository, UsersRepository $usersRepository)
    {
        //on récupère via une méthode du repository tous les articles en les triant par date descendante
        $articles = $articlesRepository->findBy(
            [],
            ['dateCreation' => 'DESC']
        );

        //on récupère via une méthode du repository tous les utilisateurs
        $users = $usersRepository->findAll();
 
        return $this->render('admin/index.html.twig', [
                'articles' => $articles,
                'users' => $users
        ]);
    }
}