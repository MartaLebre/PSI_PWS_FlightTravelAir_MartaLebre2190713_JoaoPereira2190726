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

    static $has_many = array(
        array('planescales', 'class_name'=> 'Scale' ,'foreign_key'=> 'idescala'),
        array('planes', 'class_name'=> 'Plane' ,'foreign_key'=> 'idaviao')
    );
}