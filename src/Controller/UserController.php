<?php

namespace App\Controller;

use App\Entity\Block;
use  App\Entity\User;
use App\Form\BlockType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{

    public static $logged=false;

    // listing users
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(Request $request,UserRepository $userRepository, PaginatorInterface $paginator): Response
    {


        $nom="";
        $nom=$request->query->get('nomuser');
        if($nom==""){
            $users = $userRepository->findAll();
            $users   = $paginator->paginate($users,
                $request->query->getInt('page', 1),
                2);

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
        }else{
            $users = $userRepository->findByNameUser($nom,"");
            $users   = $paginator->paginate($users,
                $request->query->getInt('page', 1),
                2);
            return $this->render('user/index.html.twig', [
                'users' => $users,

            ]);
        }
    }


    /**
     * @Route("/allcoaches", name="app_coaches", methods={"GET"})
     */
    public function allcoachs(Request $request,UserRepository $userRepository, PaginatorInterface $paginator): Response
    {


        $nom="";
        $nom=$request->query->get('nomuser');
        if($nom==""){
            $users = $userRepository->findallCoachs();
            $users   = $paginator->paginate($users,
                $request->query->getInt('page', 1),
                5);

            return $this->render('user/index.html.twig', [
                'users' => $users,
            ]);
        }else{
            $users = $userRepository->findByNameUser($nom,"");
            $users   = $paginator->paginate($users,
                $request->query->getInt('page', 1),
                5);
            return $this->render('user/index.html.twig', [
                'users' => $users,

            ]);
        }
    }

    /**
     * @Route("/allsportifs", name="app_sportifs", methods={"GET"})
     */
    public function allsportifs(Request $request,UserRepository $userRepository, PaginatorInterface $paginator): Response
    {


        $nom="";
        $nom=$request->query->get('nomuser');
        if($nom==""){
            $users = $userRepository->findallsportifs();
            $users   = $paginator->paginate($users,
                $request->query->getInt('page', 1),
                5);

            return $this->render('user/index.html.twig', [
                'users' => $users,
            ]);
        }else{
            $users = $userRepository->findByNameUser($nom,"");
            $users   = $paginator->paginate($users,
                $request->query->getInt('page', 1),
                5);
            return $this->render('user/index.html.twig', [
                'users' => $users,

            ]);
        }
    }


    /**
     * @Route("/alladmins", name="app_admins", methods={"GET"})
     */
    public function alladmins(Request $request,UserRepository $userRepository, PaginatorInterface $paginator): Response
    {


        $nom="";
        $nom=$request->query->get('nomuser');
        if($nom==""){
            $users = $userRepository->findalladmins();
            $users   = $paginator->paginate($users,
                $request->query->getInt('page', 1),
                5);

            return $this->render('user/index.html.twig', [
                'users' => $users,
            ]);
        }else{
            $users = $userRepository->findByNameUser($nom,"");
            $users   = $paginator->paginate($users,
                $request->query->getInt('page', 1),
                5);
            return $this->render('user/index.html.twig', [
                'users' => $users,

            ]);
        }
    }


    /**
     * @Route("/allgerants", name="app_gérants", methods={"GET"})
     */
    public function allgerants(Request $request,UserRepository $userRepository, PaginatorInterface $paginator): Response
    {


        $nom="";
        $nom=$request->query->get('nomuser');
        if($nom==""){
            $users = $userRepository->findallgerants();
            $users   = $paginator->paginate($users,
                $request->query->getInt('page', 1),
                5);

            return $this->render('user/index.html.twig', [
                'users' => $users,
            ]);
        }else{
            $users = $userRepository->findByNameUser($nom,"");
            $users   = $paginator->paginate($users,
                $request->query->getInt('page', 1),
                5);
            return $this->render('user/index.html.twig', [
                'users' => $users,

            ]);
        }
    }




    //adding users



    /**
     * @Route("/newadmin", name="app_user_new_admin", methods={"GET", "POST"})
     */
    public function newadmin(Request $request, UserRepository $userRepository): Response
    {
        $admin = new User();
        $form = $this->createForm(UserType::class, $admin);
        $form->handleRequest($request);
        $admin->setWhoami("Admin");
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($admin);
            return $this->redirectToRoute('app_user_new_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/New_Users_from_admin/newadmin.html.twig', [
            'user' => $admin,
            'form' => $form->createView(),
        ]);
    }




    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $user->setWhoami("Coach");
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/New_Users_from_admin/newcoach.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/newsportif", name="app_user_new_sporitf", methods={"GET", "POST"})
     */
    public function newsportif(Request $request, UserRepository $userRepository): Response
    {
        $sportif = new User();
        $form = $this->createForm(UserType::class, $sportif);
        $form->handleRequest($request);
        $sportif->setWhoami("Sportif");
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($sportif);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/New_Users_from_admin/newsportif.html.twig', [
            'user' => $sportif,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/newgerant", name="app_user_new_gerant", methods={"GET", "POST"})
     */
    public function newgerant(Request $request, UserRepository $userRepository): Response
    {
        $gerant = new User();
        $form = $this->createForm(UserType::class, $gerant);
        $form->handleRequest($request);
        $gerant->setWhoami("Gérant");
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($gerant);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/New_Users_from_admin/newgerant.html.twig', [
            'user' => $gerant,
            'form' => $form->createView(),
        ]);
    }




    /**
     * @Route("/{id}", name="app_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/block", name="app_user_block", methods={"GET", "POST"})
     */
    public function block($id, Request $request, UserRepository $userRepository): Response
    {
        $blocked = $userRepository->find($id);

        $block = new Block();
        $blockform = $this->createForm(BlockType::class, $block);
        $blockform->handleRequest($request);


        if ($blockform->isSubmitted() && $blockform->isValid()) {
            $blocked->setBlocRaison($block->getBlocRaison());
            $blocked->setUnbloc($block->getUnbloc());
            $userRepository->add($blocked);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/block.html.twig', [

            'blockform' => $blockform->createView(),
        ]);
    }




    /**
     * @Route("/{id}", name="app_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }


public static function loggingchange(){
    self::$logged=true;

}


}
