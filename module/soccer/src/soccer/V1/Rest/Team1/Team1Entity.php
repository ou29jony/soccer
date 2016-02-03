<?php
namespace soccer\V1\Rest\Team1;

use ArrayObject;

class Team1Entity extends ArrayObject
{
    
    public $t1id;
    public $name;
    public $pos;
    public $sp;
    public $g;
    public $u;
    public $v;
    public $goals;
    public $pm;
    public $points;
    public $un;
    public $ov;
    public $streak;
    public $oldpoints;
    public $oldptcount;
    public $date;
    
    public function getArrayCopy()
    {
        return array(
            't1id'                => $this->t1id,
            'name'                => $this->name,
            'pos'                 => $this->pos,
            'sp'                  => $this->sp,
            'g'                   => $this->g,
            'u'                   => $this->u,
            'v'                   => $this->v,
            'goals'               => $this->goals,
            'pm'                  => $this->pm,
            'points'              => $this->points,
            'un'                  => $this->un,
            'ov'                  => $this->ov,
            'streak'              => $this->streak,
            'oldpoints'           => $this->oldpoints,
            'oldcount'            => $this->oldcount,
            'date'                => $this->date,
        );
    }
    public function exchangeArray(array $array)
    {
        $this->t1id           = $array['t1id'];
        $this->name           = $array['name'];
        $this->pos            = $array['pos'];
        $this->sp             = $array['sp'];
        $this->g              = $array['g'];
        $this->u              = $array['u'];
        $this->v              = $array['v'];
        $this->goals          = $array['goals'];
        $this->pm             = $array['pm'];
        $this->points         = $array['points'];
        $this->un             = $array['un'];
        $this->ov             = $array['ov'];
        $this->streak         = $array['streak'];
        $this->oldpoints      = $array['oldpoints'];
        $this->oldcount       = $array['oldcount'];
        $this->date           = $array['date'];

         
    }
}
