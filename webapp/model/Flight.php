<?php


class Flight extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('precovoo'),
        array('idaeroporto'),
    );

    static $has_many = array(
        array('ticket'),
        array('scale')
    );
}