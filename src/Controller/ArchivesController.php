<?php

namespace App\Controller;

use App\Entity\Books;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
use Exception;
use Symfony\Component\HttpFoundation\Request;
/**
 * This controller class is dedicated for all the functionalities 
 * relevant only for the books
 * 
 * Books could be searched by the book id , book isbn, book title and by the book category.
 * A service class should be introduced to hydrate the data aquired from the queries
 * otherwise codes are duplicating.
 */
class ArchivesController extends ApiController
{
    private $bookRepository;

    public function __construct(BookRepository $repo)
    {
        $this->bookRepository = $repo;
    }
    /**
     * @Route("/archives", name="archives_list", methods="GET")
     */
    public function index(Request $request)
    {
        //acquire http parameters from the url
        $id = $request->query->get('id') ? $request->query->get('id') : null;
        $isbn = $request->query->get('isbn') ? $request->query->get('isbn') : null;
        $title = $request->query->get('title') ? $request->query->get('title') : null;
        $categoryCode = $request->query->get('categoryCode') ? $request->query->get('categoryCode') : null;

        //retrieved db object is then formatted into a readable array to send to the frontend
        $temp = [];
        try {
            $books = $this->bookRepository->getBooks($id, $isbn, $title, $categoryCode);
            foreach ($books as $key => $value) {
                $temp[$key]['id'] = $value->getId();
                $temp[$key]['isbn'] = $value->getIsbn();
                $temp[$key]['title'] = $value->getTitle();
                $temp[$key]['price'] = $value->getPrice();
                // $temp[$key]['coverImage'] = $value->getCoverImage();
                $temp[$key]['category']['id'] = $value->getCategory()->getId();
                $temp[$key]['category']['name'] = $value->getCategory()->getName();
                $temp[$key]['category']['code'] = $value->getCategory()->getCode();
            }
            return $this->respond($temp);
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    /**
     * get book by id
     * @Route("/archives/{id}", name="view_archive_by_id", methods="GET")
     */
    public function view(Request $request, $id)
    {        
                //retrieved db object is then formatted into a readable array to send to the frontend
                $temp = [];
                try {
                    $books = $this->bookRepository->getBooks($id, null, null, null);
                    foreach ($books as $key => $value) {
                        $temp['id'] = $value->getId();
                        $temp['isbn'] = $value->getIsbn();
                        $temp['title'] = $value->getTitle();
                        $temp['price'] = $value->getPrice();
                        // $temp[$key]['coverImage'] = $value->getCoverImage();
                        $temp['category']['id'] = $value->getCategory()->getId();
                        $temp['category']['name'] = $value->getCategory()->getName();
                        $temp['category']['code'] = $value->getCategory()->getCode();
                    }
                    return $this->respond($temp);
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                }
    }

    public function create(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ArchivesController.php',
        ]);
    }

    public function edit(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ArchivesController.php',
        ]);
    }
}
