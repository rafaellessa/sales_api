<?


namespace App\Repositories;

use App\Sale;

class SalesRepository{

    public function saveSales($params){

        $sale = new Sale();
        $sale->value = $params['valor'];
        $sale->seller_id = $params['id_vendedor'];
        $sale->sale_date = $params['data_venda'];
        $sale->commission = $params['comissao'];

        $sale->save();

        return $sale;
    }

    public function getSalesWithSeller($seller_id){

        return Sale::query()->where('seller_id', $seller_id)->get();
    }

}
