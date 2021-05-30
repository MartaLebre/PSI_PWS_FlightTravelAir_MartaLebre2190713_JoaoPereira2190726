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

}