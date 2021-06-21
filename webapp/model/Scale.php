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

    static $belongs_to = array(
        array('aeroportoorigem', 'class_name' => 'Aeroport', 'foreign_key'=>'idaeroportoorigem'),
        array('aeroportodestino', 'class_name' => 'Aeroport', 'foreign_key'=>'idaeroportodestino'),
    );
}