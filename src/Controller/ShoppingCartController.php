<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ShoppingCartRepository;
use App\Repository\ShoppingCartBooksRepository;
use DateTime;
use Exception;
use Symfony\Component\VarDumper\Cloner\Data;

/**
 * This controller class is dedicated for all the functionalities 
 * relevant only for the shopping cart
 * 
 * shopping cart could be searched by the shoppin cart id , book isbn, book title and by the book category.
 * A service class should be introduced to hydrate the data aquired from the queries
 * otherwise codes are duplicating.
 */

class ShoppingCartController extends ApiController
{
    private $shoppingCartRepository;
    private $userRepo;
    private $booksRepo;
    private $shoppingCartBooksRepo;

    public function __construct(
        ShoppingCartRepository $repo,
        UserRepository $userRepo,
        BookRepository $booksRepo,
        ShoppingCartBooksRepository $shoppingCartBooksRepo
    ) {
        $this->shoppingCartRepository = $repo;
        $this->userRepo = $userRepo;
        $this->booksRepo = $booksRepo;
        $this->shoppingCartBooksRepo = $shoppingCartBooksRepo;
    }
    /**
     * @Route("/shopping-cart", name="shopping_cart")
     */
    public function index(): Response
    {
        return $this->render('shopping_cart/index.html.twig', [
            'controller_name' => 'ShoppingCartController',
        ]);
    }

    /**
     * @Route("/shopping-cart/save", name="save_shopping_cart", methods="POST")
     */
    public function save(Request $request)
    {
        $userObj = new User();
        $shoppingCartBooks = [];
        $tempShoppingCartBooks = [];
        $tempBooks = [];
        $tempDiscounts = [];
        $data = json_decode($request->getContent(), true);

        try {

            $user = $this->userRepo->getUserById($data["user"]["id"]);

            $totalAmount = $data["totalAmount"];
            $createdAt = date("Y-m-d H:i:s");
            $totalGrossAmount = $data["totalAmount"];
            $discountAmount = 0.00;
            $bookDiscount = null;

            /**
             * Though this is a Many to Many relation 
             * The pivot regarding the relation has other colums defined
             * so docttring cannot save the shipping cart books table on its own
             * should be done manually
             */

            //save the shopping cart first
            $shoppingCart = $this->shoppingCartRepository->save($totalAmount, $totalGrossAmount, $discountAmount, $user, $createdAt);
            //save shopping cart books 
            foreach ($data["shoppingCartBooks"] as $key => $value) {
                $bookObj = $this->booksRepo->getBookById($value["book"]["id"]);
                $shoppingCartBooks[] = $this->shoppingCartBooksRepo->save($shoppingCart,$bookObj,$value["item_count"],$value["calculated_price"]);
            }

            $tempShoppingCartBooks = $this->booksRepo->getBooksByShoppingCartId($shoppingCart->getId());
            
            foreach($tempShoppingCartBooks as $key => $value){

                $tempBooks[$key]['id'] = $value->getBook()->getId();
                $tempBooks[$key]['isbn'] = $value->getBook()->getIsbn();
                $tempBooks[$key]['title'] = $value->getBook()->getTitle();
                $tempBooks[$key]['price'] = $value->getBook()->getPrice();
                $tempBooks[$key]['shopping_cart_book_id'] = $value->getId();
                $tempBooks[$key]['calculatedPrice'] = $value->getCalculatedPrice();
                $tempBooks[$key]['itemCount'] = $value->getItemCount();
                $tempBooks[$key]['shopping_cart'] = $value->getShoppingCart()->getId();
                $tempBooks[$key]['category']['id'] = $value->getBook()->getCategory()->getId();
                $tempBooks[$key]['category']['name'] = $value->getBook()->getCategory()->getName();
                $tempBooks[$key]['category']['code'] = $value->getBook()->getCategory()->getCode();
            }

            $data = [
                "id" => $shoppingCart->getId(),
                "totalAmount"=>$shoppingCart->getTotalAmount(),
                "totalGrossAmount"=>$shoppingCart->getGrossAmount(),
                "discountAmount"=>$shoppingCart->getDiscountAmount(),
                "createdAt"=>$shoppingCart->getCreatedAt(),
                "user"=>[
                    "id" => $shoppingCart->getUser()->getId(),
                    "name" => $shoppingCart->getUser()->getName(),
                    "username" => $shoppingCart->getUser()->getUsername(),
                ],
                "shoppingCartBooks"=>$tempBooks,
                "shoppingCartDiscounts"=>$tempDiscounts,
            ];


            return $this->respond($data);
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
}
