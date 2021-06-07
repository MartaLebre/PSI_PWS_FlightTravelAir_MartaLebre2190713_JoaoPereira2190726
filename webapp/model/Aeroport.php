<?php


class Aeroport extends \ActiveRecord\Model
{
    static $validates_presence_of = array(
        array('nome'),
        array('morada'),
        array('nif'),
        array('telefone'),
        array('email'),
    );

    static $validates_size_of = array(
        array('nif', 'maximum' => 9),
        array('telefone', 'is' => 9),
    );

    static $validates_format_of = array(
        array('email', 'with' => '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/',
            'mensagem' => 'Email inválido')
    );

    static $validates_numericality_of = array(
        array('telefone', 'only_integer' => true),
        array('nif', 'only_integer' => true)
    );

    static $has_many = array(
        array('flights'),
        array('scales')
    );
}