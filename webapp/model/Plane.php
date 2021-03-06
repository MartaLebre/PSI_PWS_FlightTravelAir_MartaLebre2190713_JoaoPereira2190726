<?php


class Plane extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('referencia'),
        array('lotacao'),
        array('tipoaviao'),

    );
    static $validates_numericality_of = array(
        array('lotacao', 'only_integer' => true)
    );

    static $has_many = array(
        array('planescale'),
        array('scale')
    );
}