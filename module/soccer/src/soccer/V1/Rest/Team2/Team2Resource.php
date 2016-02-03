<?php
namespace soccer\V1\Rest\Team2;

use soccer\V1\Rest\Team2\Team2Resource\Table;
use Zend\Paginator\Adapter\DbTableGateway as TableGatewayPaginator;
use ZF\Apigility\DbConnectedResource;
use Zend\Debug\Debug;

class Team2Resource extends DbConnectedResource
{

    function fetchAll($params)
    {
       
      $order = array("t2id" => "desc");
      
      if($params->searchfrom && $params->searchto){
      
          $where = "(t2id <= '". filter_var($params->searchfrom,FILTER_SANITIZE_STRING)."' AND t2id >= '".filter_var($params->searchto,FILTER_SANITIZE_STRING)."')";
      }
      
      $adapter = new TableGatewayPaginator($this->table,$where,$order);
        $rs = new $this->collectionClass($adapter);
        return $rs;
    }
     
}

?>