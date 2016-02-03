<?php
namespace soccer\V1\Rest\Against;

use ArrayObject;

class AgainstEntity extends ArrayObject
{
    public $aid;
    public $scteamsid;
    public $date;
    public $team1;
    public $team2;
    public $result;
   
    
    public function getArrayCopy()
    {
        return array(
            'aid'                => $this->aid,
            'scteamsid'            => $this->scteamsid,
            'date'            => $this->date,
            'team1'            => $this->team1,
            'team2'            => $this->team2,
            'result'            => $this->result,
        );
    }
    public function exchangeArray(array $array)
    {
        $this->aid                 = $array['aid'];
        $this->scteamsid               = $array['scteamsid'];
        $this->date               = $array['date'];
        $this->team1               = $array['team1'];
        $this->team2               = $array['team2'];
        $this->result               = $array['result'];
         
    }
}
