<?php


class Flight extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('precovoo'),
        array('origem'),
        array('destino'),
        array('dataorigem'),
        array('datadestino')
    );

    static $validates_numericality_of = array(
        array('precovoo', 'greater_than' => 0.01)

    );

    static $has_many = array(
        array('scales', 'class_name'=> 'Scale' ,'foreign_key'=> 'idvoo')
    );
}