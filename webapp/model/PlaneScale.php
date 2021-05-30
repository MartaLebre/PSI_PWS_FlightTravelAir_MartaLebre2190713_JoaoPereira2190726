<?php


class PlaneScale extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('nrPassageiros'),
        array('idEscala'),
        array('idAviao'),
    );

    static $validates_numericality_of = array(
        array('nrPassageiros', 'only_integer' => true)
    );
}