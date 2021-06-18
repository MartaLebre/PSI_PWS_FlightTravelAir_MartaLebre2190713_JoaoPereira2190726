<?php


class Ticket extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('precofinal'),
        array('datahoracompra'),
        array('checkin'),
        array('idvooida'),
        array('idvoovolta'),
        array('idutilizador'),
    );

    static $belongs_to = array(
        array('utilizador', 'class_name' => 'User', 'foreign_key'=>'idutilizador'),
        array('vooida', 'class_name' => 'Flight', 'foreign_key'=>'idvooida'),
        array('voovolta', 'class_name' => 'Flight', 'foreign_key'=>'idvoovolta')
    );

}