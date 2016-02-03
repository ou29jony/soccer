<?php
namespace soccer\V1\Rest\Soccerteams;

use soccer\V1\Rest\Soccerteams\SoccerteamsResource\Table;
use Zend\Paginator\Adapter\DbTableGateway as TableGatewayPaginator;
use ZF\Apigility\DbConnectedResource;
use Zend\Debug\Debug;

class SoccerteamsResource extends DbConnectedResource
{

    function fetchAll($params)
    {
  
        
            $order = array(
                "id" => "desc");
            
      
        
        $adapter = new TableGatewayPaginator($this->table,null,$order);
        $rs = new $this->collectionClass($adapter);
        return $rs;
         
         }
     
}

?>