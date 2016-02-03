<?php
namespace soccer\V1\Rest\Team1;

use soccer\V1\Rest\Team1\Team1Resource\Table;
use Zend\Paginator\Adapter\DbTableGateway as TableGatewayPaginator;
use ZF\Apigility\DbConnectedResource;
use Zend\Debug\Debug;

class Team1Resource extends DbConnectedResource
{

    
    function fetchAll($params)
    {
       
      $order = array("t1id" => "desc");
      
      
      if($params->searchfrom && $params->searchto){
        
         $where = "(t1id <= '". filter_var($params->searchfrom,FILTER_SANITIZE_STRING)."' AND t1id >= '".filter_var($params->searchto,FILTER_SANITIZE_STRING)."')";
      }
      
    
       $adapter = new TableGatewayPaginator($this->table,$where,$order);
        $rs = new $this->collectionClass($adapter);
        return $rs;
         
    }
     
}

?>