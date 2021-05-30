<?php
use ActiveRecord\Model;


class User extends Model
{

    static $validates_presence_of = array(
        array('nomecompleto'),
        array('morada'),
        array('email'),
        array('nif'),
        array('telefone'),
        array('username'),
        array('password'),
        array('role'),
    );

    static $validates_size_of = array(
        array('nomecompleto', 'maximum' => 80),
        array('morada', 'maximum' => 120),
        array('email', 'maximum' => 60),
        array('nif', 'maximum' => 9),
        array('telefone', 'is' => 9),
        array('username', 'maximum' => 30),
        array('password', 'maximum' => 30),
        array('role', 'maximum' => 13)
    );


    static $validates_inclusion_of = array(
        array('role', 'in' => array ('administrador', 'passageiro', 'gestorvoo', 'operadorcheckin'))
    );

    static $validates_format_of = array(
        array('email', 'with' => '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/',
            'mensagem' => 'Email inválido')
    );

    static $validates_numericality_of = array(
        array('telefone', 'only_integer' => true),
        array('nif', 'only_integer' => true)
    );




}