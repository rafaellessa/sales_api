<?php

namespace App\Http\Controllers;

use App\Services\SellerService;
use Exception;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    private $sellerService;

    public function __construct(SellerService $sellerService)
    {
        $this->sellerService = $sellerService;
    }

    public function index(Request $request){
        try{
            $result = $this->sellerService->getSellers();
            return response()->json($result, 200);
        }
        catch(Exception $e){
            return response()->json([
                'error' => true,
                'menssage' => $e->getMessage()], 400);
        }
    }

    public function store(Request $request){
        try {

            $result = $this->sellerService->saveSeller($request->all());

            return response()->json($result, 200);

        }catch(Exception $e){
            return response()->json([
                'error' => true,
                'menssage' => $e->getMessage()], 400);
        }

    }
}
