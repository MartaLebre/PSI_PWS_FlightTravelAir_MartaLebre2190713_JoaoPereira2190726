<?php


class Scale extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('dataHoraOrigem'),
        array('dataHoraDestino'),
        array('distancia'),
        array('idAeroportoOrigem'),
        array('idAeroportoDestino'),
        array('idVoo'),

    );
}