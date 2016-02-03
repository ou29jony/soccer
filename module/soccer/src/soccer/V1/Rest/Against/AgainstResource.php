<?php
namespace soccer\V1\Rest\Against;
use soccer\V1\Rest\Against\AgainstResource\Table;
use Zend\Paginator\Adapter\DbTableGateway as TableGatewayPaginator;
use ZF\Apigility\DbConnectedResource;
use Zend\Debug\Debug;


class AgainstResource extends DbConnectedResource
{
        function fetchAll($params) {
        if ($params->search) $where = "(scteamsid <= '".filter_var($params->search,FILTER_SANITIZE_STRING)."' AND scteamsid >='".(filter_var($params->search,FILTER_SANITIZE_STRING)-25)."' )";
        $order = "BY DESC";
        var_dump();
        $adapter = new TableGatewayPaginator($this->table, $where);
        $rs = new $this->collectionClass($adapter);
        return $rs;
    
    }
   
}

?>