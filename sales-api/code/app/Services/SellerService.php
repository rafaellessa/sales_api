<?php

namespace App\Services;

use App\Repositories\SalesRepository;
use App\Repositories\SellerRepository;

class SellerService{

    private $sellerRepository;
    private $salesRepository;

    public function __construct(SellerRepository $sellerRepository, SalesRepository $salesRepository){

        $this->sellerRepository = $sellerRepository;
        $this->salesRepository = $salesRepository;

    }

    public function getSellers(){

       $sellers = $this->sellerRepository->getSellers();
       $result = [];
       foreach($sellers as $seller){

            $sales = $this->salesRepository->getSalesWithSeller($seller->id);
            $commisionSeller = 0;
            $totalSales = 0;
            foreach($sales as $sale){
                $totalSales += $sale->value;
            }
                $commisionSeller = ($totalSales * 6.5) / 100;

            $sellerTemp = [
                'ID' => $seller->id,
                'nome' => $seller->name,
                'email' => $seller->email,
                'comissao' => $commisionSeller

            ];

            array_push($result, $sellerTemp);

       }

       return [
           'success' => true,
           'data' => $result
       ];

    }

    public function saveSeller($params){
        $result = $this->sellerRepository->saveSeller($params);

        $seller = [
            'ID' => $result['id'],
            'Nome' => $result['name'],
            'Email' => $result['email']
        ];

        return [
            'success' => true,
            'data' => $seller
        ];
    }

    public function getSeller($id){

        return $this->sellerRepository->getSeller($id);
    }


}
