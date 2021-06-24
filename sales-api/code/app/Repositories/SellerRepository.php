<?php

namespace App\Repositories;

use App\Seller;

class SellerRepository{
    public function getSellers(){
        return Seller::all();
    }

    public function saveSeller($params){

        $seller = new Seller();

        $seller->name = $params['nome'];
        $seller->email = $params['email'];
        $seller->save();

        return $seller;

        // $seller = [
        //     'name' => $params['nome'],
        //     'email' => $params['email']
        // ];

        // Seller::create($seller);
    }

    public function getSeller($id){

        $seller =  Seller::query()->where('id',$id)->first();
        return $seller;
    }
}
