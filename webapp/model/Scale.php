<?php


class Scale extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('datahoraorigem'),
        array('datahoradestino'),
        array('distancia'),
        array('idaeroportoorigem'),
        array('idaeroportodestino'),
        array('idvoo'),
    );

    static $has_many = array(
        array('planescales')
    );
}