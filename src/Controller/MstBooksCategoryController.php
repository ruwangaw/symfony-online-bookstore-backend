<?php
namespace App\Controller;

use App\Repository\MstBookCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MstBooksCategoryController extends ApiController
{
    private $mstBookCategoryRepository;

    public function __construct(MstBookCategoryRepository $repo)
    {
        $this->mstBookCategoryRepository = $repo;
    }

    /**
     * @Route("/mst-books-categories", name="books-categories", methods="GET")
     */
    public function index(Request $request)
    {
        $response = new Response();
        $temp = [];

        try {
            $books = $this->mstBookCategoryRepository->findAll();
            foreach ($books as $key => $value) {
                $temp[$key]['id'] = $value->getId();
                $temp[$key]['name'] = $value->getName();
                $temp[$key]['code'] = $value->getCode();
            }
            return $this->respond($temp);
        } catch (\Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
}