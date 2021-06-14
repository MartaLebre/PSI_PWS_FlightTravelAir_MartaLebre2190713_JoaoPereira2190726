<?php


class Flight extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('precovoo')
    );

    static $has_many = array(
        array('ticket'),
        array('scale')
    );
}