<?php namespace App\Models;

use CodeIgniter\Model;

class SlipModel extends Model {
    protected $table = 'slips';
    protected $primaryKey = 'id';
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    protected function beforeInsert(array $data){
        return $data;
    }

    protected function beforeUpdate(array $data){
        return $data;
    }


    public function getMonthlyPaginate($page=1, $pp=10, $keywords='', $condition=''){

        $queryStr = "SELECT COUNT(`id`) AS `total`, `year`, `month` 
            FROM `slips` 
            GROUP BY `year`, `month` 
            ORDER BY `year` DESC, `month` DESC";

        $data = $this->db->query($queryStr." LIMIT ?, ?", [ ($page-1)*$pp, $pp ])->getResultArray();
        $total = count($this->db->query($queryStr)->getResultArray());

        return [
            'data' => $data,
            'total' => $total,
            'page' => $page,
            'pp' => $pp,
            'keywords' => $keywords,
            'condition' => $condition,
        ];
    }

    public function getMonthlyReportPaginate($year, $month, $page=1, $pp=10, $keywords='', $condition=''){
        $queryStr = "SELECT `id`, `slip_id`, `prefix`, `firstname`, `lastname`, `psn_id`, `bank_id` 
            FROM `slips` 
            WHERE `year` = :year: AND `month` = :month: 
            ORDER BY `slip_id` ASC";


        $data = $this->db->query(
            $queryStr." LIMIT :start:, :pp:", 
            [ 'year' => $year, 'month' => $month, 'start' => ($page-1)*$pp, 'pp' => $pp ]
        )->getResultArray();
        $total = count($this->db->query(
            $queryStr, [ 'year' => $year, 'month' => $month ]
        )->getResultArray());

        return [
            'data' => $data,
            'total' => $total,
            'page' => $page,
            'pp' => $pp,
            'keywords' => $keywords,
            'condition' => $condition,
        ];
    }

}

?>
