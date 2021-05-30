<?php


class Ticket extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('precoFinal'),
        array('dataHoraCompra'),
        array('checkin'),
        array('idVooIda'),
        array('idVooVolta'),
        array('idUtilizador'),

    );

}