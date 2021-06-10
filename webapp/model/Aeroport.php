<?php
use ActiveRecord\Model;

class Aeroport extends Model
{
    static $validates_presence_of = array(
        array('nome'),
        array('morada'),
        array('nif'),
        array('telefone'),
        array('email'),
    );

    static $validates_size_of = array(
        array('nome', 'maximum' => 80),
        array('morada', 'maximum' => 100),
        array('nif', 'maximum' => 9),
        array('telefone', 'maximum' => 9),
        array('email', 'maximum' => 60),
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
        array('flight'),
        array('scale')
    );
}