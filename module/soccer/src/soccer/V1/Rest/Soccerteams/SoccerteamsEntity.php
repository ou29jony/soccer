<?php
namespace soccer\V1\Rest\Soccerteams;

use ArrayObject;

class SoccerteamsEntity extends ArrayObject
{
    
    public $id;
    public $date;
    public $team1id;
    public $team2id;
    public $one;
    public $x;
    public $two;
    
     
    
    public function getArrayCopy()
    {
        return array(
            'id'             => $this->id,
            'date'           => $this->date,
            'team1id'        => $this->team1id,
            'team2id'        => $this->team2id,
            'one'            => $this->one,
            'x'              => $this->x,
            'two'            => $this->two,
        );
    }
    public function exchangeArray(array $array)
    {
        $this->id            = $array['id'];
        $this->date          = $array['date'];
        $this->team1id       = $array['team1id'];
        $this->team2id       = $array['team2id'];
        $this->one           = $array['one'];
        $this->x             = $array['x'];
        $this->two           = $array['two'];
         
    }
}
