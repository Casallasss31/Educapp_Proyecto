
<?php

$administrativos = [

    'rol.view',
    'rol.create',
    'rol.update',
    'rol.delete',

    'eps.view',
    'eps.create',
    'eps.update',
    'eps.delete',

    'grupo_sanguineo.view',
    'grupo_sanguineo.create',
    'grupo_sanguineo.update',
    'grupo_sanguineo.delete',

    'localidad.view',
    'localidad.create',
    'localidad.update',
    'localidad.delete',

    'profesion.view',
    'profesion.create',
    'profesion.update',
    'profesion.delete',

    'grado.view',
    'grado.create',
    'grado.update',
    'grado.delete',

    'area.view',
    'area.create',
    'area.update',
    'area.delete',

    'nota.view',
    'nota.create',
    'nota.update',
    'nota.delete',

    'tipo_certificado.view',
    'tipo_certificado.create',
    'tipo_certificado.update',
    'tipo_certificado.delete',

    'barrio.view',
    'barrio.create',
    'barrio.update',
    'barrio.delete',

    'usuario.view',
    'usuario.create',
    'usuario.update',
    'usuario.delete',

    'acudiente.view',
    'acudiente.create',
    'acudiente.update',
    'acudiente.delete',

    'docente.view',
    'docente.create',
    'docente.update',
    'docente.delete',

    'rector.view',
    'rector.create',
    'rector.update',
    'rector.delete',

    'asistente_administrativo.view',
    'asistente_administrativo.create',
    'asistente_administrativo.update',
    'asistente_administrativo.delete',

    'curso.view',
    'curso.create',
    'curso.update',
    'curso.delete',

    'estudiante.view',
    'estudiante.create',
    'estudiante.update',
    'estudiante.delete',

    'materia.view',
    'materia.create',
    'materia.update',
    'materia.delete',

    'certificado.view',
    'certificado.create',
    'certificado.update',
    'certificado.delete',

    'boletin.view',
    'boletin.create',
    'boletin.update',
    'boletin.delete',

    'matricula.view',
    'matricula.create',
    'matricula.update',
    'matricula.delete',

    'horario.view',
    'horario.create',
    'horario.update',
    'horario.delete',

    'detalle_boletin.view',
    'detalle_boletin.create',
    'detalle_boletin.update',
    'detalle_boletin.delete',

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
        'grado.view',
        'curso.view',
        'area.view',
        'materia.view',
        'nota.view',
        'horario.view',
        'calendario.view',

    ],

    
    'ESTUDIANTE' => [

        'curso.view',
        'materia.view',
        'boletin.view',
        'detalle_boletin.view',
        'certificado.view',
        'tipo_certificado.view',
        'horario.view',
        'calendario.view',

    ],

   
    'ACUDIENTE' => [

        'estudiante.view',
        'boletin.view',
        'detalle_boletin.view',

    ],

];
