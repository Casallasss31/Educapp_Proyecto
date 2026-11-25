<?php

$administrativos = [

    'eps.view',
    'eps.create',
    'eps.update',
    'eps.delete',
    
    'usuario.view',
    'usuario.create',
    'usuario.update',
    'usuario.delete',

    'estudiante.view',
    'estudiante.create',
    'estudiante.update',
    'estudiante.delete',

    'matricula.view',
    'matricula.create',
    'matricula.update',
    'matricula.delete',

    'boletin.view',
    'boletin.create',
    'boletin.update',
    'boletin.delete',

    'certificado.view',
    'certificado.create',
    'certificado.update',
    'certificado.delete',

    'horario.view',
    'horario.create',
    'horario.update',
    'horario.delete',

    'calendario.view',
    'calendario.create',
    'calendario.update',
    'calendario.delete',
];

return [

    'RECTOR' => $administrativos,

    'ASISTENTE ADMINISTRATIVO' => $administrativos,

    'DOCENTE' => [
        'estudiante.view',
        'matricula.view',
        'horario.view',
        'calendario.view',
    ],

    'ESTUDIANTE' => [
        'boletin.view',
        'certificado.view',
        'horario.view',
        'calendario.view',
        'eps.view',
    ],

    'ACUDIENTE' => [
        'boletin.view',
    ],

];