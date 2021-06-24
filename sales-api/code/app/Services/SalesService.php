<?php

namespace App\Services;

use App\Repositories\SalesRepository;
use Carbon\Carbon;

class SalesService{

    private $salesRepository;
    private $sellerService;

    public function __construct(SalesRepository $salesRepository, SellerService $sellerService)
    {
        $this->salesRepository = $salesRepository;
        $this->sellerService = $sellerService;

    }

    public function saveSale($params){

        $sale = [
            'valor' => $params['valor'],
            'id_vendedor' => $params['id_vendedor'],
            'data_venda' => Carbon::now(),
            'comissao' =>($params['valor'] * 6.5) / 100
        ];

        $result = $this->salesRepository->saveSales($sale);

        return $result;

    }

    public function getSalesWithSeller($seller_id){
        $sales = $this->salesRepository->getSalesWithSeller($seller_id);
        $seller = $this->sellerService->getSeller($seller_id);
        $result = [];
        foreach($sales as $sale) {

            $temp = [
                'id' => $sale['id'],
                'nome' => $seller['name'],
                'email' => $seller['email'],
                'valor_venda' => $sale['value'],
                'comissao' => $sale['commission'],
                'data_venda' => $sale['sale_date']
            ];

            array_push($result, $temp);
        }

        return $result;

    }
}
