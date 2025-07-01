<?php
class SearchController extends Controller
{
    public function searchProduct($htmlKeywords, $start, $end)
    {
        $sql = "SELECT * FROM `products` WHERE `product_tags` LIKE '%". $htmlKeywords ."%' AND `product_type` = 'Active' AND `is_delete` = '0' ORDER BY id DESC LIMIT {$start}, {$end}";
        $query = $this->connection->prepare($sql);

        $query->execute();

        $dataList = $query->fetchAll(PDO::FETCH_ASSOC);
        return $dataList;
    }
}
