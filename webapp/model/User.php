<?php
use ActiveRecord\Model;


class User extends Model
{

    static $validates_presence_of = array(
        array('nomeCompleto'),
        array('morada'),
        array('email'),
        array('telefone'),
        array('username'),
        array('password'),
        array('perfil'),
    );

    static $validates_size_of = array(
        array('nomeCompleto', 'maximum' => 80),
        array('morada', 'maximum' => 120),
        array('email', 'maximum' => 60),
        array('telefone', 'is' => 9),
        array('username', 'maximum' => 30),
        array('password', 'maximum' => 30),
        array('perfil', 'maximum' => 13)
    );

    static $validates_format_of = array(
        array('email', 'with' => '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/',
            'mensagem' => 'Email inválido')
    );
    static $validates_numericality_of = array(
        array('telefone', 'only_integer' => true)
    );
    static $validates_inclusion_of = array(
        array('perfil', 'in' => array ('operadorcheckin', 'administrador', 'passageiro', 'gestor'))
    );


}