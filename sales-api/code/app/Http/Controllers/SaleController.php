<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Services\SalesService;
use App\Services\SellerService;

class SaleController extends Controller
{

    private $salesService;
    private $sellerService;

    public function __construct(SalesService $salesService, SellerService $sellerService){

        $this->salesService = $salesService;
        $this->sellerService = $sellerService;
    }

    public function store(Request $request){

        try{
            $sale = $this->salesService->saveSale($request->all());
            $seller = $this->sellerService->getSeller($request->input('id_vendedor'));

            $result = [
                'id' => $sale['id'],
                'nome' => $seller['name'],
                'email' => $seller['email'],
                'valor_venda' => $sale['value'],
                'comissao' => $sale['commission'],
                'data_venda' => $sale['sale_date']
            ];

            return response()->json([
                'success' => true,
                'data' => $result
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'error' => true,
                'menssage' => $e->getMessage()], 400);
        }
    }

    public function get($id){
        try{

            $result = $this->salesService->getSalesWithSeller($id);

            return response()->json([
                'success'=> true,
                'data'=> $result
            ]);
        }catch(Exception $e){
            return response()->json([
                'error' => true,
                'menssage' => $e->getMessage()], 400);
        }
    }


}
