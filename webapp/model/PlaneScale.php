<?php


class PlaneScale extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('nrpassageiros'),
        array('idescala'),
        array('idaviao'),
    );

    static $validates_numericality_of = array(
        array('nrpassageiros', 'only_integer' => true)
    );
}