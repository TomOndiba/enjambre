<?php

/**
 * Libreria donde se crean los métodos usados en el plugin reportes
 * @author DIEGOX_CORTEX
 */

/**
 * Funcion que consulta en los usuarios registrados las mujeres por departamento
 * @param type-> text $dpto-> Depártamento para la búsqueda
 * @return type -> array
 */
function elgg_get_usuarios_by_filtros($dpto, $subtype, $genero, $grupo_etnico) {


    $options = array(
        'type' => 'user',
        'subtype' => $subtype,
        'limit' => 0,
        'metadata_name_value_pair' => array(
            array('name' => 'sexo', 'value' => $genero),
            array('name' => 'departamento_nacimiento', 'value' => $dpto),
            array('name' => 'grupo_etnico', 'value' => $grupo_etnico)
        )
    );

    $entities = elgg_get_entities_from_metadata($options);
    return $entities;
}

/**
 * Funcion que consulta todas las instituciones y las agrupa por tipo 
 * @param type-> text $dpto-> Departamento para la búsqueda
 * @return type -> array
 */
function elgg_get_instituciones_por_departamento($dpto) {
    $bd = Db::getInstance();
    /* Creamos una query sencilla */
    if ($dpto == "TODOS") {
        $sql = "SELECT inst.name as nombre, inst.tipo_institucion as tipo, inst.municipio as municipio,"
                . "(SELECT COUNT(*) FROM usuarios u WHERE u.relacion='estudia_en' AND u.institucion_real=inst.guid ) as estudiantes,  "
                . "(SELECT COUNT(*) FROM usuarios u WHERE u.relacion='trabaja_en' AND u.institucion_real=inst.guid ) as maestros, "
                . "(SELECT COUNT(*) FROM elgg_groups_entity g "
                . "INNER JOIN elgg_entity_relationships er ON er.guid_one=g.guid and er.relationship='pertenece_a' "
                . "WHERE er.guid_two=inst.guid ) as grupos FROM instituciones inst";
    } else {
        $sql = "SELECT inst.name as nombre, inst.tipo_institucion as tipo, inst.municipio as municipio,"
                . "(SELECT COUNT(*) FROM usuarios u WHERE u.relacion='estudia_en' AND u.institucion_real=inst.guid ) as estudiantes,  "
                . "(SELECT COUNT(*) FROM usuarios u WHERE u.relacion='trabaja_en' AND u.institucion_real=inst.guid ) as maestros, "
                . "(SELECT COUNT(*) FROM elgg_groups_entity g "
                . "INNER JOIN elgg_entity_relationships er ON er.guid_one=g.guid and er.relationship='pertenece_a' "
                . "WHERE er.guid_two=inst.guid ) as grupos FROM instituciones inst WHERE inst.departamento='$dpto'";
    }

    $stmt = $bd->ejecutar($sql);

    /* Realizamos un bucle para ir obteniendo los resultados */
    $instituciones = array();
    $attr = array('nombre', 'tipo', 'maestros', 'estudiantes', 'grupos', 'municipio');
    while ($x = $bd->obtener_fila($stmt, 0)) {
        $institucion;
        foreach ($attr as $atributo) {
            $institucion[$atributo] = $x[$atributo];
        }
        array_push($instituciones, $institucion);
    }
    return $instituciones;
}

function elgg_get_grupos_por_departamento($dpto) {
    $bd = Db::getInstance();
    /* Creamos una query sencilla */
    if ($dpto == "TODOS") {
        $sql = "SELECT g.name as nombre, i.name as institucion, i.tipo_institucion as tipo_institucion, i.municipio as municipio, "
                . "(SELECT COUNT(*) FROM usuarios u INNER JOIN elgg_entity_relationships er ON er.guid_one=u.guid AND er.relationship='es_miembro_de' "
                . " WHERE g.guid=er.guid_two) as miembros, "
                . " (SELECT COUNT(*) FROM elgg_groups_entity i INNER JOIN elgg_entity_relationships er ON er.guid_two=i.guid AND er.relationship='tiene_la_investigacion'"
                . " WHERE er.guid_one=g.guid) as investigaciones "
                . " FROM elgg_groups_entity g INNER JOIN instituciones i "
                . " INNER JOIN elgg_entity_relationships er ON er.guid_one=g.guid AND er.relationship='pertenece_a' AND er.guid_two=i.guid "
                . " ";
    } else {
        $sql = "SELECT g.name as nombre, i.name as institucion, i.tipo_institucion as tipo_institucion, i.municipio as municipio, "
                . "(SELECT COUNT(*) FROM usuarios u INNER JOIN elgg_entity_relationships er ON er.guid_one=u.guid AND er.relationship='es_miembro_de' "
                . " WHERE g.guid=er.guid_two) as miembros, "
                . " (SELECT COUNT(*) FROM elgg_groups_entity i INNER JOIN elgg_entity_relationships er ON er.guid_two=i.guid AND er.relationship='tiene_la_investigacion'"
                . " WHERE er.guid_one=g.guid) as investigaciones "
                . " FROM elgg_groups_entity g INNER JOIN instituciones i "
                . " INNER JOIN elgg_entity_relationships er ON er.guid_one=g.guid AND er.relationship='pertenece_a' AND er.guid_two=i.guid "
                . " WHERE i.departamento='$dpto'";
    }

    $stmt = $bd->ejecutar($sql);
    /* Realizamos un bucle para ir obteniendo los resultados */
    $grupos = array();
    $attr = array('nombre', 'institucion', 'miembros', 'investigaciones', 'tipo_institucion', 'municipio');
    while ($x = $bd->obtener_fila($stmt, 0)) {
        $grupo;
        foreach ($attr as $atributo) {
            $grupo[$atributo] = $x[$atributo];
        }
        array_push($grupos, $grupo);
    }
    return $grupos;
}

/**
 * Función que busca los grupos de investigacion que estan en un municipio
 * @param text $munic -> nombre del municipio
 * @return array
 */
function elgg_get_grupos_por_municipio($munic) {
    $municipio = strtoupper($munic);
    $options = array(
        'type' => 'group',
        'subtype' => 'institucion',
        'limit' => 0,
        'metadata_name_value_pair' => array(
            array('name' => 'municipio', 'value' => $municipio),)
    );
    $entities = elgg_get_entities_from_metadata($options);
    $retorno = array();
    foreach ($entities as $institucion) {

        $options = array(
            'relationship' => "pertenece_a",
            'relationship_guid' => $institucion->guid,
            'inverse_relationship' => true
        );
        $grupos = elgg_get_entities_from_relationship($options);
        if ($grupos) {
            foreach ($grupos as $grupo) {
                $x = array();
                $x['name'] = $grupo->name;
                $x['institucion'] = $institucion->name;
                $x['tipo_institucion'] = $institucion->tipo_institucion;
                $x['investigaciones'] = sizeof(elgg_get_investigaciones_por_grupo($grupo->guid));
                $x['miembros'] = sizeof(elgg_get_entities_grupo_investigacion($grupo));
                $retorno[] = $x;
            }
        }
    }
    return $retorno;
}

/**
 * Funcion que consulta todas las instituciones de un municipio
 * @param type-> text $munic-> Municipio para la búsqueda
 * @return type -> array
 */
function elgg_get_instituciones_por_municipio($munic) {
    $municipio = strtoupper($munic);
    $municipio = strtoupper($munic);
    $options = array(
        'type' => 'group',
        'subtype' => 'institucion',
        'limit' => 0,
        'metadata_name_value_pair' => array(
            array('name' => 'municipio', 'value' => $municipio),)
    );
    $entities = elgg_get_entities_from_metadata($options);
    $retorno = array();
    foreach ($entities as $institucion) {
        $x = array();
        $cantidad_estudiantes = elgg_get_cantidad_de_estudiantes_institucion($institucion);
        $cantidad_grupos = elgg_get_cantidad_de_grupos_institucion($institucion);
        $x['estudiantes'] = $cantidad_estudiantes;
        $x['grupos'] = $cantidad_grupos;
        $x['name'] = $institucion->name;
        $x['tipo_institucion'] = $institucion->tipo_institucion;
        array_push($retorno, $x);
    }
    return $retorno;
}

function elgg_get_cantidad_de_estudiantes_institucion($institucion) {
    $options = array(
        'relationship' => "estudia_en",
        'relationship_guid' => $institucion->guid,
        'inverse_relationship' => true
    );
    return sizeof(elgg_get_entities_from_relationship($options));
}

function elgg_get_cantidad_de_grupos_institucion($institucion) {
    $options = array(
        'relationship' => "pertenece_a",
        'relationship_guid' => $institucion->guid,
        'inverse_relationship' => true
    );
    return sizeof(elgg_get_entities_from_relationship($options));
}

/**
 * Funcion que consulta todos los estudiantes y los agrupa por grado
 * @param type-> text $dpto-> Departamento para la búsqueda
 * @return type -> array
 */
function elgg_get_usuarios_por_departamento_grado($dpto) {


    $options = array(
        'type' => 'user',
        'limit' => 0,
    );
    $entities = elgg_get_entities($options);
    $usuarios = array();
    $contadores = array();
    foreach ($entities as $entity) {
        $institucion = elgg_get_institucion_de_usuario($entity);

        $curso = $entity->curso;
        if ($curso == "") {
            $curso = "No han seleccionado el Grado en el que estudian";
        }
        if ($institucion->departamento == $dpto) {
            if (!array_key_exists($curso, $contadores)) {
                $contadores[$curso] = 0;
                $usuarios[$curso] = array();
            }
            $contadores[$curso] ++;
            array_push($usuarios[$curso], $entity);
        }
    }
    $retorno = array('lista' => $usuarios, 'tabla' => $contadores);


    return $retorno;
}

/**
 * Funcion que consulta todos los usuarios y los agrupa por genero
 * @param type-> text $dpto-> Depártamento para la búsqueda
 * @return type -> array
 */
function elgg_get_usuarios_por_departamento_genero($dpto) {
    $options = array(
        'type' => 'user',
        'limit' => 0,
    );
    $entities = elgg_get_entities($options);
    $usuarios = array();
    $contadores = array();
    foreach ($entities as $entity) {
        $institucion = elgg_get_institucion_de_usuario($entity);
        if ($institucion->departamento == $dpto) {
            if (!array_key_exists($entity->sexo, $contadores)) {
                $contadores[$entity->sexo] = 0;
                $usuarios[$entity->sexo] = array();
            }
            $contadores[$entity->sexo] ++;
            array_push($usuarios[$entity->sexo], $entity);
        }
    }
    $retorno = array('lista' => $usuarios, 'tabla' => $contadores);
    return $retorno;
}

/**
 * Funcion que consulta en los usuarios registrados por departamento
 * @param type-> text $dpto-> Depártamento para la búsqueda
 * @return type -> array
 */
function elgg_get_estaditicas_departamento($departamento) {

    $bd = Db::getInstance();
    if ($departamento == 'TODOS') {
        $sql = "SELECT DISTINCT CONCAT(user.name,' ', user.apellidos) as nombre, IF(relacion='trabaja_en', 'Maestro', 'Estudiante') as tipo, "
                . "user.grupo_etnico as etnia, user.sexo as genero, user.curso as curso, inst.name as institucion, "
                . "inst.tipo_institucion as tipo_institucion, inst.municipio as municipio, user.email as email, user.fecha_nacimiento as fecha_nacimiento FROM usuarios user "
                . "INNER JOIN instituciones inst ON inst.guid=user.institucion_real";
    } else {
        /* Creamos una query sencilla */
        $sql = "SELECT DISTINCT CONCAT(user.name,' ', user.apellidos) as nombre, IF(relacion='trabaja_en', 'Maestro', 'Estudiante') as tipo, "
                . "user.grupo_etnico as etnia, user.sexo as genero, user.curso as curso, inst.name as institucion, "
                . "inst.tipo_institucion as tipo_institucion, inst.municipio as municipio, user.email as email, user.fecha_nacimiento as fecha_nacimiento FROM usuarios user INNER JOIN instituciones inst ON inst.guid=user.institucion_real "
                . "WHERE inst.departamento =  '$departamento'";
    }
    $stmt = $bd->ejecutar($sql);

    /* Realizamos un bucle para ir obteniendo los resultados */
    $usuarios = array();
    $contadores_etnia = array();
    $contadores_tipo = array();
    $contadores_gnero = array();
    $contadores_curso = array();
    $contadores_tipoInst = array();
    $attr = array('nombre', 'tipo', 'etnia', 'genero', 'curso', 'institucion', 'tipo_institucion', 'municipio', 'email', 'fecha_nacimiento');
    while ($x = $bd->obtener_fila($stmt, 0)) {
        $usuario;
        foreach ($attr as $atributo) {
            if ($atributo == "etnia") {
                if (!array_key_exists($x[$atributo], $contadores_etnia)) {
                    $contadores_etnia[$x[$atributo]] = 0;
                }
                $contadores_etnia[$x[$atributo]] ++;
            }
            if ($atributo == "tipo") {
                if (!array_key_exists($x[$atributo], $contadores_tipo)) {
                    $contadores_tipo[$x[$atributo]] = 0;
                }
                $contadores_tipo[$x[$atributo]] ++;
            }
            if ($atributo == "genero") {
                if (!array_key_exists($x[$atributo], $contadores_gnero)) {
                    $contadores_gnero[$x[$atributo]] = 0;
                }
                $contadores_gnero[$x[$atributo]] ++;
            }
            if ($atributo == "curso") {
                if (!array_key_exists($x[$atributo], $contadores_curso)) {
                    $contadores_curso[$x[$atributo]] = 0;
                }
                $contadores_curso[$x[$atributo]] ++;
            }
            if ($atributo == "tipo_institucion") {
                if (!array_key_exists($x[$atributo], $contadores_tipoInst)) {
                    $contadores_tipoInst[$x[$atributo]] = 0;
                }
                $contadores_tipoInst[$x[$atributo]] ++;
            }
            if ($atributo == "fecha_nacimiento") {
                $x[$atributo] = elgg_get_edad_ByfechaNac($x[$atributo]);
            }
            $usuario[$atributo] = $x[$atributo];
        }
        array_push($usuarios, $usuario);
    }
    $retorno = array('lista' => $usuarios,
        'tablas' => array('Etnias' => $contadores_etnia, 'Tipo de Usuario' => $contadores_tipo,
            'Género' => $contadores_gnero, 'Grado' => $contadores_curso, 'Tipo Institución' => $contadores_tipoInst)
    );
    return $retorno;
}

/**
 * Funcion que consulta en los usuarios registrados por municipio
 * @param type-> text $munic-> Municipio para la búsqueda
 * @return type -> array
 */
function elgg_get_estaditicas_municipio($munic) {
    $bd = Db::getInstance();
    /* Creamos una query sencilla */
    $sql = "SELECT CONCAT (user.name,' ',user.apellidos) as nombre, IF(relacion='trabaja_en', 'Maestro', 'Estudiante') as tipo, user.fecha_nacimiento as fecha_nacimiento, "
            . "user.grupo_etnico as etnia, user.sexo as genero, user.curso as curso, inst.name as institucion, "
            . "inst.tipo_institucion as tipo_institucion, inst.municipio as municipio, user.email as email FROM usuarios user INNER JOIN instituciones inst ON inst.guid=user.institucion_real "
            . "WHERE inst.municipio =  '$munic'";
    $stmt = $bd->ejecutar($sql);

    /* Realizamos un bucle para ir obteniendo los resultados */
    $usuarios = array();
    $contadores_etnia = array();
    $contadores_tipo = array();
    $contadores_gnero = array();
    $contadores_curso = array();
    $contadores_tipoInst = array();
    $attr = array('nombre', 'tipo', 'etnia', 'genero', 'curso', 'institucion', 'tipo_institucion', 'municipio', 'email', "fecha_nacimiento");
    while ($x = $bd->obtener_fila($stmt, 0)) {
        $usuario;
        foreach ($attr as $atributo) {
            if ($atributo == "etnia") {
                if (!array_key_exists($x[$atributo], $contadores_etnia)) {
                    $contadores_etnia[$x[$atributo]] = 0;
                }
                $contadores_etnia[$x[$atributo]] ++;
            }
            if ($atributo == "tipo") {
                if (!array_key_exists($x[$atributo], $contadores_tipo)) {
                    $contadores_tipo[$x[$atributo]] = 0;
                }
                $contadores_tipo[$x[$atributo]] ++;
            }
            if ($atributo == "genero") {
                if (!array_key_exists($x[$atributo], $contadores_gnero)) {
                    $contadores_gnero[$x[$atributo]] = 0;
                }
                $contadores_gnero[$x[$atributo]] ++;
            }
            if ($atributo == "curso") {
                if (!array_key_exists($x[$atributo], $contadores_curso)) {
                    $contadores_curso[$x[$atributo]] = 0;
                }
                $contadores_curso[$x[$atributo]] ++;
            }
            if ($atributo == "tipo_institucion") {
                if (!array_key_exists($x[$atributo], $contadores_tipoInst)) {
                    $contadores_tipoInst[$x[$atributo]] = 0;
                }
                $contadores_tipoInst[$x[$atributo]] ++;
            }
            if ($atributo == "fecha_nacimiento") {
                $x[$atributo] = elgg_get_edad_ByfechaNac($x[$atributo]);
            }
            $usuario[$atributo] = $x[$atributo];
        }
        array_push($usuarios, $usuario);
    }
    $retorno = array('lista' => $usuarios,
        'tablas' => array('Etnias' => $contadores_etnia, 'Tipo de Usuario' => $contadores_tipo,
            'Género' => $contadores_gnero, 'Grado' => $contadores_curso, 'Tipo Institución' => $contadores_tipoInst)
    );
    return $retorno;
}

/**
 * Función que realiza la consulta de los usuarios para reporte por municipio preparando los datos 
 * para las graficas
 * @param type $dpto
 * @return int
 */
function elgg_get_estaditicas_municicpio($municipio) {
    $options = array(
        'type' => 'user',
        'limit' => 0,
    );
    $entities = elgg_get_entities($options);
    $usuarios = array();
    $contadores_etnia = array();
    $contadores_tipo = array();
    $contadores_gnero = array();
    $contadores_curso = array();
    $contadores_tipoInst = array();
    foreach ($entities as $entity) {
        $subtype = $entity->getSubtype();
        $institucion = elgg_get_institucion_de_usuario($entity);
        if ($institucion->municipio == $municipio) {
            if (!array_key_exists($entity->grupo_etnico, $contadores_etnia)) {
                $contadores_etnia[$entity->grupo_etnico] = 0;
            }

            if (!empty($subtype) && !array_key_exists($subtype, $contadores_tipo)) {
                $contadores_tipo[$subtype] = 0;
            }
            if (!array_key_exists($entity->sexo, $contadores_gnero)) {
                $contadores_gnero[$entity->sexo] = 0;
            }
            $curso = $entity->curso;
            if ($curso == "") {
                $curso = "No han seleccionado el Grado en el que estudian";
            }
            if (!array_key_exists($curso, $contadores_curso)) {
                $contadores_curso[$curso] = 0;
            }
            $tipo_inst = $institucion->tipo_institucion;
            if (empty($tipo_inst)) {
                $tipo_inst = "Institucion sin Tipo";
            }
            if (!array_key_exists($tipo_inst, $contadores_tipoInst)) {
                $contadores_tipoInst[$tipo_inst] = 0;
            }
            $entity->institucion = $institucion->name;
            $entity->municipio = $institucion->municipio;
            $contadores_etnia[$entity->grupo_etnico] ++;
            $contadores_tipo[$subtype] ++;
            $contadores_gnero[$entity->sexo] ++;
            $contadores_curso[$curso] ++;
            $contadores_tipoInst[$tipo_inst] ++;
            array_push($usuarios, $entity);
        }
    }
    $retorno = array('lista' => $usuarios, 'tablas' => array('Etnias' => $contadores_etnia, 'Tipo de Usuario' => $contadores_tipo, 'Género' => $contadores_gnero, 'Grado' => $contadores_curso, 'Tipo de Institución' => $contadores_tipoInst));
    return $retorno;
}

/**
 * Funcion que consulta en los usuarios registrados por municipio
 * @param type-> text $munic-> Municipio para la búsqueda
 * @return type -> array
 */
function elgg_get_estaditicas_institucion($institucion) {
    $bd = Db::getInstance();
    /* Creamos una query sencilla */
    $sql = "SELECT DISTINCT CONCAT(u.name,' ', u.apellidos) as nombre,IF(u.relacion='estudia_en','estudiante','maestro') as tipo ,"
            . "u.sexo as genero,u.grupo_etnico as etnia,u.curso as curso, i.tipo_institucion as tipo_institucion, u.email as email "
            . "FROM usuarios u INNER JOIN instituciones i ON i.guid=u.institucion_real WHERE institucion_real = $institucion->guid";
    $stmt = $bd->ejecutar($sql);

    /* Realizamos un bucle para ir obteniendo los resultados */
    $usuarios = array();
    $contadores_etnia = array();
    $contadores_tipo = array();
    $contadores_gnero = array();
    $contadores_curso = array();
    $contadores_tipoInst = array();
    $attr = array('nombre', 'tipo', 'genero', 'etnia', 'curso', 'tipo_institucion', 'email');
    while ($x = $bd->obtener_fila($stmt, 0)) {
        $usuario;
        foreach ($attr as $atributo) {
            if ($atributo == "etnia") {
                if (!array_key_exists($x[$atributo], $contadores_etnia)) {
                    $contadores_etnia[$x[$atributo]] = 0;
                }
                $contadores_etnia[$x[$atributo]] ++;
            }
            if ($atributo == "tipo") {
                if (!array_key_exists($x[$atributo], $contadores_tipo)) {
                    $contadores_tipo[$x[$atributo]] = 0;
                }
                $contadores_tipo[$x[$atributo]] ++;
            }
            if ($atributo == "genero") {
                if (!array_key_exists($x[$atributo], $contadores_gnero)) {
                    $contadores_gnero[$x[$atributo]] = 0;
                }
                $contadores_gnero[$x[$atributo]] ++;
            }
            if ($atributo == "curso") {
                if (!array_key_exists($x[$atributo], $contadores_curso)) {
                    $contadores_curso[$x[$atributo]] = 0;
                }
                $contadores_curso[$x[$atributo]] ++;
            }
            $usuario[$atributo] = $x[$atributo];
        }
        array_push($usuarios, $usuario);
    }
    $retorno = array('lista' => $usuarios,
        'tablas' => array('Etnias' => $contadores_etnia, 'Tipo de Usuario' => $contadores_tipo,
            'Género' => $contadores_gnero, 'Grado' => $contadores_curso)
    );
    return $retorno;
}

/**
 * Funcion que consulta en los usuarios miembros de un grupo
 * @param type-> text $grupo-> Grupo para la búsqueda
 * @return type -> array
 */
function elgg_get_estaditicas_grupo($grupo) {



    $entities = elgg_get_entities_grupo_investigacion($grupo);
    $usuarios = array();
    $contadores_etnia = array();
    $contadores_tipo = array();
    $contadores_gnero = array();
    $contadores_curso = array();
    $contadores_tipoInst = array();
    foreach ($entities as $ent) {

        $entity = $ent['usuario'];
        $subtype = $entity->getSubtype();

        $institucion = elgg_get_institucion_de_usuario($entity);

        if (!array_key_exists($entity->grupo_etnico, $contadores_etnia)) {
            $contadores_etnia[$entity->grupo_etnico] = 0;
        }
        if (!empty($subtype) && !array_key_exists($subtype, $contadores_tipo)) {
            $contadores_tipo[$subtype] = 0;
        }
        if (!array_key_exists($entity->sexo, $contadores_gnero)) {
            $contadores_gnero[$entity->sexo] = 0;
        }
        $curso = $entity->curso;
        if ($curso == "") {
            $curso = "No han seleccionado el Grado en el que estudian";
        }
        if (!array_key_exists($curso, $contadores_curso)) {
            $contadores_curso[$curso] = 0;
        }
        $tipo_inst = $institucion->tipo_institucion;
        if (empty($tipo_inst)) {
            $tipo_inst = "Institucion sin Tipo";
        }
        if (!array_key_exists($tipo_inst, $contadores_tipoInst)) {
            $contadores_tipoInst[$tipo_inst] = 0;
        }

        $contadores_etnia[$entity->grupo_etnico] ++;
        $contadores_tipo[$subtype] ++;
        $contadores_gnero[$entity->sexo] ++;
        $contadores_curso[$curso] ++;
        $contadores_tipoInst[$tipo_inst] ++;
        array_push($usuarios, $entity);
    }
    $retorno = array('lista' => $usuarios, 'tablas' => array('Etnias' => $contadores_etnia, 'Tipo de Usuario' => $contadores_tipo, 'Género' => $contadores_gnero, 'Grado' => $contadores_curso, 'Tipo de Institución' => $contadores_tipoInst));
    return $retorno;
}

/**
 * 
 */
function elgg_get_estadisticas_investigacione_grupoEM($inves) {
    $inv = array();
    $contadores_etnia = array();
    $contadores_tipo = array();
    $contadores_gnero = array();
    $contadores_curso = array();
    $contadores_tipoInst = array();
    $investigacion = get_entity($inves);
    $invest = array();

    $estudiantes = elgg_get_entities_from_relationship(array('relationship_guid' => $inves, 'relationship' => "hace_parte_de", 'inverse_relationship' => true));
    $maestros = elgg_get_entities_from_relationship(array('relationship_guid' => $inves, 'relationship' => "es_colaborador_de", 'inverse_relationship' => true));
    $entitys = array_merge($estudiantes, $maestros);
    error_log('MAESTROS - ' . sizeof($maestros) . ' Estudiantes - ' . sizeof($estudiantes));

    foreach ($entitys as $entity) {

        $subtype = $entity->getSubtype();
        if (!array_key_exists($entity->grupo_etnico, $contadores_etnia)) {
            $contadores_etnia[$entity->grupo_etnico] = 0;
        }
        if (!empty($subtype) && !array_key_exists($subtype, $contadores_tipo)) {
            $contadores_tipo[$subtype] = 0;
        }
        if (!array_key_exists($entity->sexo, $contadores_gnero)) {
            $contadores_gnero[$entity->sexo] = 0;
        }
        if ($subtype == 'Estudiante') {
            $curso = $entity->curso;
            if ($curso == "") {
                $curso = "No han seleccionado el Grado en el que estudian";
            }
            if (!array_key_exists($curso, $contadores_curso)) {
                $contadores_curso[$curso] = 0;
            }
        }
        if (!array_key_exists($tipo_inst, $contadores_tipoInst)) {
            $contadores_tipoInst[$tipo_inst] = 0;
        }
        $contadores_etnia[$entity->grupo_etnico] ++;
        $contadores_tipo[$subtype] ++;
        $contadores_gnero[$entity->sexo] ++;
        $contadores_curso[$curso] ++;
        $contadores_tipoInst[$tipo_inst] ++;

        $invest['nombre'] = $entity->name . ' ' . $entity->apellidos;
        $invest['email'] = $entity->email;
        $invest['edad'] = elgg_get_edad_ByfechaNac($entity->fecha_nacimiento);
        $invest['tipo_user'] = $subtype;
        $invest['curso'] = $curso;
        $invest['etnia'] = $entity->grupo_etnico;
        $invest['sexo'] = $entity->sexo;

        array_push($inv, $invest);
    }



    $retorno = array('lista' => $inv, 'tablas' => array('Etnias' => $contadores_etnia, 'Tipo de Usuario' => $contadores_tipo, 'Género' => $contadores_gnero, 'Grado' => $contadores_curso, 'Tipo de Institución' => $contadores_tipoInst));
    return $retorno;
}

/**
 * Funcion que consulta las investigaciones que tiene un grupo
 * @param type->int guid del grupo 
 * @return type -> array
 */
function elgg_get_estadistica_investigaciones_grupo($grupo) {


    $investigaciones = elgg_get_investigaciones_por_grupo($grupo);

    $inv = array();
    foreach ($investigaciones as $investigacion) {

        $invest = array();
        $invest['name'] = $investigacion->name;
        $invest['estudiantes'] = sizeof(elgg_get_relationship_inversa($investigacion, "hace_parte_de"));
        $invest['maestros'] = sizeof(elgg_get_relationship_inversa($investigacion, "es_colaborador_de"));

        $nombre_linea = "";
        $nombre_conv = "";
        $estado = "";
        $guid = elgg_get_relationship($investigacion, "preinscrita_a_convocatoria");
        $guid1 = elgg_get_relationship($investigacion, "inscrita_a_convocatoria");
        $guid2 = elgg_get_relationship($investigacion, "evaluada_en_convocatoria");
        $guid3 = elgg_get_relationship($investigacion, "seleccionada_en_convocatoria");

        if ($guid != NULL) {

            $convocatoria = get_entity($guid[0]->guid);
            $lineas = elgg_get_relationship($investigacion, "preinscrita_a_{$convocatoria->guid}_con_linea_tematica");
            $linea = get_entity($lineas[0]->guid);
            $nombre_conv = $convocatoria->name;
            $nombre_linea = $linea->name;
            $estado = "Preinscrita";
        } else if ($guid1 != NULL) {

            $convocatoria = get_entity($guid1[0]->guid);
            $lineas = elgg_get_relationship($investigacion, "inscrita_a_{$convocatoria->guid}_con_linea_tematica");
            $linea = get_entity($lineas[0]->guid);
            $nombre_conv = $convocatoria->name;
            $nombre_linea = $linea->name;
            $estado = "Inscrita";
        } else if ($guid2 != NULL) {

            $convocatoria = get_entity($guid2[0]->guid);
            $lineas = elgg_get_relationship($investigacion, "evaluada_en_{$convocatoria->guid}_con_linea_tematica");
            $linea = get_entity($lineas[0]->guid);
            $nombre_conv = $convocatoria->name;
            $nombre_linea = $linea->name;
            $estado = "Evaluada";
        } else if ($guid3 != NULL) {

            $convocatoria = get_entity($guid3[0]->guid);
            $lineas = elgg_get_relationship($investigacion, "seleccionada_en_{$convocatoria->guid}_con_linea_tematica");
            $linea = get_entity($lineas[0]->guid);
            $nombre_conv = $convocatoria->name;
            $nombre_linea = $linea->name;
            $estado = "Seleccionada";
        } else {
            $nombre_conv = "No está participando en ninguna convocatoria";
            $nombre_linea = "No se ha Inscrito a una linea tematica";
        }



        $invest['convocatoria'] = $nombre_conv;
        $invest['linea'] = $nombre_linea;
        $invest['estado'] = $estado;

//if (!array_key_exists($entity->name, $contadores_gnero)) {
//$contadores_grupo[$entity->name] = 0;
//}
//
//$contadores_grupo[$entity->name] ++;


        array_push($inv, $invest);
    }

//    $retorno=array('lista'=>$inv, 'tabla'=>$contadores_grupo);
    return $inv;
}

/**
 * Funcion que consulta los grupos de Investigación que tiene una institución
 * @param type->int guid de la institución 
 * @return type -> array
 */
function elgg_get_estadistica_grupos_institucion($institucion) {


    $entities = elgg_get_grupos_por_institucion($institucion);
    $arreglo = array();
    foreach ($entities as $entity) {

        $ent = array();
        $ent['name'] = $entity->name;
        $ent['investigaciones'] = sizeof(elgg_get_investigaciones_por_grupo($entity->guid));
        $ent['miembros'] = sizeof(elgg_get_entities_grupo_investigacion($entity));
        array_push($arreglo, $ent);
    }
    return $arreglo;
}

/**
 * Funcion que consulta las investigaciones que tiene una institución
 * @param type->int guid de la institución 
 * @return type -> array
 */
function elgg_get_estadistica_investigaciones_institucion($institucion) {


    $entities = elgg_get_grupos_por_institucion($institucion);
    $inv = array();
    $contadores_grupo = array();
    foreach ($entities as $entity) {

        $investigaciones = elgg_get_investigaciones_por_grupo($entity->guid);


        foreach ($investigaciones as $investigacion) {
            $invest = array();
            $invest['name'] = $investigacion->name;
            $invest['estudiantes'] = sizeof(elgg_get_relationship_inversa($investigacion, "hace_parte_de"));
            $invest['maestros'] = sizeof(elgg_get_relationship_inversa($investigacion, "es_colaborador_de"));
            $invest['grupo'] = $entity->name;


            if (!array_key_exists($entity->name, $contadores_grupo)) {
                $contadores_grupo[$entity->name] = 0;
            }

            $contadores_grupo[$entity->name] ++;
            array_push($inv, $invest);
        }
    }
//    $retorno=array('lista'=>$inv, 'tabla'=>$contadores_grupo);
    return $inv;
}

function elgg_get_usuarios_por_departamento($dpto) {
    $options = array(
        'type' => 'user',
        'limit' => 0,
    );
    $entities = elgg_get_entities($options);
    $usuarios = array();
    $contadores = array();
    foreach ($entities as $entity) {
        $institucion = elgg_get_institucion_de_usuario($entity);
        if ($institucion->departamento == $dpto) {
            if (!array_key_exists($entity->grupo_etnico, $contadores)) {
                $contadores[$entity->grupo_etnico] = 0;
                $usuarios[$entity->grupo_etnico] = array();
            }
            $entity->institucion = $institucion->name;
            $entity->municipio = $institucion->municipio;
            $contadores[$entity->grupo_etnico] ++;
            array_push($usuarios[$entity->grupo_etnico], $entity);
        }
    }
    $retorno = array('lista' => $usuarios, 'tabla' => $contadores);
    return $retorno;
}

//***********************************Por Municipio*******************************************************************
/**
 * Funcion que consulta en los usuarios registrados  por municipio
 * @param type-> text $municipio-> Municipio para la búsqueda
 * @return type -> array
 */
function elgg_get_usuarios_por_municipio($munic) {
    $municipio = strtoupper($munic);

    $options = array(
        'type' => 'user',
        'limit' => 0,
    );
    $entities = elgg_get_entities($options);
    $usuarios = array();
    $contadores = array();
    $i = 0;
    foreach ($entities as $entity) {
        $institucion = elgg_get_institucion_de_usuario($entity);
        if ($institucion->municipio == $municipio) {

            $i++;
            if (!array_key_exists($entity->grupo_etnico, $contadores)) {
                $contadores[$entity->grupo_etnico] = 0;
                $usuarios[$entity->grupo_etnico] = array();
            }
            $contadores[$entity->grupo_etnico] ++;
            array_push($usuarios[$entity->grupo_etnico], $entity);
        }
    }
    $retorno = array('lista' => $usuarios, 'tabla' => $contadores);
    return $retorno;
}

/**
 * Funcion que consulta todos los estudiantes de un municipio y los agrupa por genero
 * @param type-> text $munic-> Municipio para la búsqueda
 * @return type -> array
 */
function elgg_get_usuarios_por_municipio_genero($munic) {

    $municipio = strtoupper($munic);
    $options = array(
        'type' => 'user',
        'limit' => 0,
    );
    $entities = elgg_get_entities($options);
    $usuarios = array();
    $contadores = array();
    foreach ($entities as $entity) {
        $institucion = elgg_get_institucion_de_usuario($entity);
        if ($institucion->municipio == $municipio) {
            if (!array_key_exists($entity->sexo, $contadores)) {
                $contadores[$entity->sexo] = 0;
                $usuarios[$entity->sexo] = array();
            }
            $contadores[$entity->sexo] ++;
            array_push($usuarios[$entity->sexo], $entity);
        }
    }
    $retorno = array('lista' => $usuarios, 'tabla' => $contadores);
    return $retorno;
}

/**
 * Funcion que consulta todos los estudiantes de un municipio y los agrupa por grado
 * @param type-> text $munic-> Municipio para la búsqueda
 * @return type -> array
 */
function elgg_get_usuarios_por_municipio_grado($munic) {

    $municipio = strtoupper($munic);


    $options = array(
        'type' => 'user',
        'limit' => 0,
    );

    $entities = elgg_get_entities($options);
    $usuarios = array();
    $contadores = array();
    foreach ($entities as $entity) {
        $institucion = elgg_get_institucion_de_usuario($entity);

        $curso = $entity->curso;
        if ($curso == "") {
            $curso = "No han seleccionado el Grado en el que estudian";
        }
        if ($institucion->municipio == $municipio) {
            if (!array_key_exists($curso, $contadores)) {
                $contadores[$curso] = 0;
                $usuarios[$curso] = array();
            }
            $contadores[$curso] ++;
            array_push($usuarios[$curso], $entity);
        }
    }
    $retorno = array('lista' => $usuarios, 'tabla' => $contadores);


    return $retorno;
}

/**
 * Funcion que consulta todos las Instituciones de un municipio  y las agrupa por tipo
 * @param type-> text $munic-> Municipio para la búsqueda
 * @return type -> array
 */
function elgg_get_instituciones_por_municipio_tipo_institucion($munic) {

    $municipio = strtoupper($munic);
    $options = array(
        'type' => 'group',
        'limit' => 0,
        'metadata_name_value_pair' => array(
            array('name' => 'municipio', 'value' => $municipio),)
    );



    $entities = elgg_get_entities_from_metadata($options);

    $usuarios = array();
    $contadores = array();
    foreach ($entities as $entity) {

        $tipo = $entity->tipo_institucion;
        if ($tipo == "") {
            $tipo = "Sin tipo";
        }

        if (!array_key_exists($tipo, $contadores)) {
            $contadores[$tipo] = 0;
            $usuarios[$tipo] = array();
        }
        $contadores[$tipo] ++;
        array_push($usuarios[$tipo], $entity);
    }
    $retorno = array('lista' => $usuarios, 'tabla' => $contadores);


    return $retorno;
}

function elgg_get_institucion_de_usuario($user) {
    $institucion = elgg_get_relationship($user, "estudia_en");

    if (!$institucion) {
        return elgg_get_institucion_de_maestro($user);
    }
    return $institucion[0];
}

function elgg_get_institucion_de_maestro($user) {
    $institucion = elgg_get_relationship($user, "trabaja_en");
    return $institucion[0];
}

function elgg_get_estudiantes_dpto($dpto) {
    $options = array(
        'type' => 'user',
        'subtype' => 'estudiante',
        'limit' => 0
    );
    $entities = elgg_get_entities($options);
    return $entities;
}

/**
 * Funcion que deveulve las mujeres pertenicientes a un grpo de investigación
 * @param type $grupo -> Grupo de investigacion (Entity)
 * @return array 
 */
function mujeres_by_grupo($grupo) {
    $mujeres = array();
    $integrantes = elgg_get_relationship_inversa($grupo, 'es_miembro_de');

    if (sizeof($integrantes) > 0) {
        foreach ($integrantes as $i) {

            if ($i->sexo == 'Femenino') {
                $mX = array('name' => $i->name . ' ' . $i->apellidos, 'tipo_documento' => $i->tipo_documento, 'numero_documento' => $i->numero_documento, 'email' => $i->email);
                array_push($mujeres, $mX);
            }
        }
    }

    return $mujeres;
}

/**
 * Funcion que deveulve los hombres pertenicientes a un grpo de investigación
 * @param type $grupo -> Grupo de investigacion (Entity)
 * @return array 
 */
function hombres_by_grupo($grupo) {
    $hombres = array();
    $integrantes = elgg_get_relationship_inversa($grupo, 'es_miembro_de');

    if (sizeof($integrantes) > 0) {
        foreach ($integrantes as $i) {
            if ($i->sexo == 'Masculino') {
                $mX = array('name' => $i->name . ' ' . $i->apellidos, 'tipo_documento' => $i->tipo_documento, 'numero_documento' => $i->numero_documento, 'email' => $i->email);
                array_push($hombres, $mX);
            }
        }
    }

    return $hombres;
}

/**
 * Funcion que retorna las instituciones según los parametros de búsqueda
 * @param type $dpto -> departamento
 * @param type $tipo -> Tipo de Institución
 * @return array 
 */
function elgg_get_instituciones_por_dpto_tipo($dpto, $tipo) {
    $options = array(
        'type' => 'group',
        'subtype' => 'institucion',
        'limit' => 0,
        'metadata_name_value_pair' => array(
            array('name' => 'departamento', 'value' => $dpto),
            array('name' => 'tipo_institucion', 'value' => $tipo),
        )
    );

    $entities = elgg_get_entities_from_metadata($options);

    return $entities;
}

function elgg_get_grupos_por_institucion($institucion) {
    $grupos = elgg_get_entities_from_relationship(
            array("relationship" => "pertenece_a",
                'relationship_guid' => $institucion,
                'inverse_relationship' => TRUE)
    );
    return $grupos;
}

function elgg_get_investigaciones_por_grupo($grupo) {
    $investigaciones = elgg_get_entities_from_relationship(
            array("relationship" => "tiene_la_investigacion",
                'relationship_guid' => $grupo,
                'inverse_relationship' => FALSE)
    );
    return $investigaciones;
}

/**
 * Funcion que devuelve los estudiantes registrados dentro de un dpartamento
 * @param type $dpto -> departamento a buscar
 * @return array 
 */
function elgg_get_usuarios_by_tipo($dpto) {

    $options = array(
        'type' => 'user',
        'limit' => 0,
    );
    $entities = elgg_get_entities($options);
    $usuarios = array();
    $contadores = array();
    foreach ($entities as $entity) {
        $subtype = $entity->getSubtype();
        if ($subtype == 'estudiante') {
            $institucion = elgg_get_institucion_de_usuario($entity);
        } else {
            $institucion = elgg_get_institucion_de_maestro($entity);
        }
        if ($institucion->departamento == $dpto) {
            if (!array_key_exists($subtype, $contadores)) {
                $contadores[$subtype] = 0;
                $usuarios[$subtype] = array();
            }
            $entity->institucion = $institucion->name;
            $entity->municipio = $institucion->municipio;
            $contadores[$subtype] ++;
            array_push($usuarios[$subtype], $entity);
        }
    }
    $retorno = array('lista' => $usuarios, 'tabla' => $contadores);
    return $retorno;
}

/**
 * Funcion que devuelve los estudiantes registrados dentro de un municipio
 * @param type $dpto -> municipio a buscar
 * @return array 
 */
function elgg_get_usuarios_by_tipoMunic($munic) {
    $municipio = strtoupper($munic);
    $options = array(
        'type' => 'user',
        'limit' => 0,
    );
    $entities = elgg_get_entities($options);
    $usuarios = array();
    $contadores = array();
    foreach ($entities as $entity) {
        $subtype = $entity->getSubtype();
        if ($subtype == 'estudiante') {
            $institucion = elgg_get_institucion_de_usuario($entity);
        } else {
            $institucion = elgg_get_institucion_de_maestro($entity);
        }

        if ($institucion->municipio == $municipio) {
            if (!array_key_exists($subtype, $contadores)) {
                $contadores[$subtype] = 0;
                $usuarios[$subtype] = array();
            }
            $entity->institucion = $institucion->name;
            $entity->municipio = $institucion->municipio;
            $contadores[$subtype] ++;
            array_push($usuarios[$subtype], $entity);
        }
    }
    $retorno = array('lista' => $usuarios, 'tabla' => $contadores);
    return $retorno;
}

/* * ******************************************
 * ************* CONVOCATORIAS **************
 * ******************************************
 */

/**
 * Función que retorna las convocatorias que se encuentran en el rango de fechas solicitado
 * @param text $fecha_desde -> fecha de inicio de la busqueda
 * @param text $fecha_hasta -> feche de fin de la busqueda
 * @return type->NULL|array
 */
function elgg_get_listado_convocatoriasFechas($fecha_desde, $fecha_hasta) {
    $fecha_d = date($fecha_desde);
    $fecha_h = date($fecha_hasta);
    $options = array(
        'type' => 'group',
        'subtype' => 'convocatoria',
        'wheres' => array(
            'name' => "(mts.string='fecha_apertura' and mts.id=mt.name_id and mt.value_id=mts2.id AND mt.entity_guid=s.guid AND mts2.string<='$fecha_h')
AND (mts3.string='fecha_apertura' and mts3.id=mt2.name_id and mt2.value_id=mts4.id AND mt2.entity_guid=s.guid AND mts4.string>='$fecha_d')"
            . " AND e.guid=s.guid",
        ),
        'joins' => array(
            'name' => ', elgg_groups_entity s, elgg_metadata mt, elgg_metadata mt2, elgg_metastrings mts, elgg_metastrings mts2, elgg_metastrings mts3, elgg_metastrings mts4'
        ),
    );

    $entities = elgg_get_entities($options);
    $tipo = array();
    $linea_temaica = array();
    $convocatorias = array();
    foreach ($entities as $entity) {
        $convX = array();
        if (!array_key_exists($entity->tipo_convocatoria, $tipo)) {
            $tipo[$entity->tipo_convocatoria] = 0;
        }
        $lineas = elgg_get_relationship($entity, 'tiene_la_línea_temática');
        $lineasX = "";
        foreach ($lineas as $l) {
            if (!array_key_exists($l->name, $linea_temaica)) {
                $linea_temaica[$l->name] = 0;
            }
            $lineasX .= $l->name . "-";
            $linea_temaica[$l->name] ++;
        }
        $convX['lineas'] = $lineasX;
        $convX['tipo_convocatoria'] = $entity->tipo_convocatoria;
        $convX['name'] = $entity->name;
        $convX['departamento'] = $entity->departamento;
        $convX['fecha_apertura'] = $entity->fecha_apertura;
        $convX['fecha_cierre'] = $entity->fecha_cierre;

        $tipo[$entity->tipo_convocatoria] ++;
        array_push($convocatorias, $convX);
    }
    $retorno = array('lista' => $convocatorias, 'tablas' => array('Tipo' => $tipo, 'Linea Temàtica' => $linea_temaica));
    return $retorno;
}

/**
 * Función que retorna las convocatorias que se encuentran en el dpto seleccionado
 * @param text $dpto -> departamento par al busqueda
 * @return type->NULL|array
 */
function elgg_get_convocatias_departamento($dpto) {
    $options = array(
        'type' => 'group',
        'subtype' => 'convocatoria',
        'metadata_names' => 'departamento',
        'metadata_values' => $dpto
    );

    $entities = elgg_get_entities_from_metadata($options);
    $tipo = array();
    $linea_temaica = array();
    $convocatorias = array();
    foreach ($entities as $entity) {
        $convX = array();
        if (!array_key_exists($entity->tipo_convocatoria, $tipo)) {
            $tipo[$entity->tipo_convocatoria] = 0;
        }
        $lineas = elgg_get_relationship($entity, 'tiene_la_línea_temática');
        $lineasX = "";
        foreach ($lineas as $l) {
            if (!array_key_exists($l->name, $linea_temaica)) {
                $linea_temaica[$l->name] = 0;
            }
            $lineasX .= $l->name . "-";
            $linea_temaica[$l->name] ++;
        }
        $convX['lineas'] = $lineasX;
        $convX['name'] = $entity->name;
        $convX['departamento'] = $entity->departamento;
        $convX['fecha_apertura'] = $entity->fecha_apertura;
        $convX['fecha_cierre'] = $entity->fecha_cierre;
        $convX['tipo_convocatoria'] = $entity->tipo_convocatoria;
        $tipo[$entity->tipo_convocatoria] ++;
        array_push($convocatorias, $convX);
    }
    $retorno = array('lista' => $convocatorias, 'tablas' => array('Tipo' => $tipo, 'Linea Temàtica' => $linea_temaica));
    return $retorno;
}

/**
 * Función que retorna las convocatorias(entity´s) que se encuentran en el dpto seleccionado
 * @param text $dpto -> departamento par al busqueda
 * @return type->NULL|array
 */
function elgg_get_convocatias_BY_departamento($dpto) {

    $option = array(
        'type' => 'group',
        'subtype' => 'convocatoria',
        'metadata_names' => 'departamento',
        'metadata_values' => $dpto
    );
    $entities = elgg_get_entities_from_metadata($option);

    $options = array('Seleccione' => 'Seleccione una Convocatoria');
    if (sizeof($entities) > 0) {
        foreach ($entities as $conv) {
            $options[$conv->guid] = $conv->name;
        }
    } else {
        $options['x'] = "No hay convocatorias en ese departamento...";
    }
    $select_conv = elgg_view('input/dropdown', array(
        'name' => 'conv',
        'class' => 'select',
        'options_values' => $options,
        'onchange' => 'verReporteConvBYDpto(this)',
        'class' => 'select-reportes'
    ));


    return $select_conv;
}

/**
 * Función que devuelve la información para el reporte de ferias en convocatorias
 * @param entity $conv -> obj con la informacion de la convocatoria
 */
function elgg_get_ferias_in_convocatoria($conv) {
    $eventos = elgg_get_relationship($conv, 'tiene_el_evento');
    $eventosRet = array();

    foreach ($eventos as $even) {
        $eventoX = array();
        if ($even->tipo_evento == "Feria") {
            $eventoX['nombre'] = $even->nombre_evento;
            $eventoX['fecha_inicio'] = $even->fecha_inicio;
            $eventoX['fecha_terminacion'] = $even->fecha_terminacion;
            $eventoX['lugar'] = $even->lugar;
            array_push($eventosRet, $eventoX);
        }
    }

    return $eventosRet;
}

/**
 * Función que concatena todos los usuarios de las investigaciones que participan en una convocatoria
 * @param int $conv -> guid de la convocatoria que se desea consultar
 * @return array|VACIO 
 */
function elgg_get_estudiantes_convByDpto($conv) {
    $convocatoria = get_entity($conv);
    $tipo = array();
    $etnia = array();
    $usuarios = array();
    //Verifico Investigaciones Inscritas
    $investigacionesInscritas = elgg_get_relationship_inversa($convocatoria, 'inscrita_a_convocatoria');
    $entities = elgg_get_estudiantes_investigaciones($investigacionesInscritas);
    foreach ($entities as $entity) {
        $userX = array();
        $user = get_entity($entity['guid']);
        if (!array_key_exists($user->sexo, $tipo)) {
            $tipo[$user->sexo] = 0;
        }
        if (!array_key_exists($user->grupo_etnico, $etnia)) {
            $etnia[$user->grupo_etnico] = 0;
        }
        //Aparto los datos del usuario para imprimir en la tabla
        $userX['guid'] = "$user->guid";
        $userX['investigacion'] = $entity['investigacion'];
        $userX['estado_inv'] = $entity['estado'];
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['sexo'] = $user->sexo;
        $userX['curso'] = $user->curso;
        $userX['etnia'] = $user->grupo_etnico;
        $userX['email'] = $user->email;
        //Sumo la cantida del tipo de usuario para la gráfica

        $encontrado = false;

        foreach ($usuarios as $r) {

            if ($r['guid'] == $userX['guid']) {
                $encontrado = true;
                $r['investigacion'].=", " . $userX['investigacion'];
            }
        }

        if (!$encontrado) {
            $tipo[$user->sexo] ++;
            $etnia[$user->grupo_etnico] ++;
            array_push($usuarios, $userX);
        }
    }
    //Verifico Investigaciones Evaluadas
    $investigacionesEvaluadas = elgg_get_relationship_inversa($convocatoria, "evaluada_en_convocatoria");
    $entitiesEv = elgg_get_estudiantes_investigaciones($investigacionesEvaluadas);
    foreach ($entitiesEv as $entity) {
        $userX = array();
        $user = get_entity($entity['guid']);
        if (!array_key_exists($user->sexo, $tipo)) {
            $tipo[$user->sexo] = 0;
        }
        if (!array_key_exists($user->grupo_etnico, $etnia)) {
            $etnia[$user->grupo_etnico] = 0;
        }
        //Aparto los datos del usuario para imprimir en la tabla
        $userX['guid'] = "$user->guid";
        $userX['investigacion'] = $entity['investigacion'];
        $userX['estado_inv'] = $entity['estado'];
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['sexo'] = $user->sexo;
        $userX['curso'] = $user->curso;
        $userX['etnia'] = $user->grupo_etnico;
        $userX['email'] = $user->email;
        //Sumo la cantida del tipo de usuario para la gráfica
        $encontrado = false;

        foreach ($usuarios as $r) {

            if ($r['guid'] == $userX['guid']) {
                $encontrado = true;
                $r['investigacion'].=", " . $userX['investigacion'];
            }
        }

        if (!$encontrado) {
            $tipo[$user->sexo] ++;
            $etnia[$user->grupo_etnico] ++;
            array_push($usuarios, $userX);
        }
    }
    //Verifico Investigaciones Seleccionadas
    $investigacionesSeleccionadas = elgg_get_relationship_inversa($convocatoria, "seleccionada_en_convocatoria");
    $entitiesSel = elgg_get_estudiantes_investigaciones($investigacionesSeleccionadas);
    foreach ($entitiesSel as $entity) {
        $userX = array();
        $user = get_entity($entity['guid']);
        if (!array_key_exists($user->sexo, $tipo)) {
            $tipo[$user->sexo] = 0;
        }
        if (!array_key_exists($user->grupo_etnico, $etnia)) {
            $etnia[$user->grupo_etnico] = 0;
        }
        //Aparto los datos del usuario para imprimir en la tabla
        $userX['guid'] = "$user->guid";
        $userX['investigacion'] = $entity['investigacion'];
        $userX['estado_inv'] = $entity['estado'];
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['sexo'] = $user->sexo;
        $userX['curso'] = $user->curso;
        $userX['etnia'] = $user->grupo_etnico;
        $userX['email'] = $user->email;

        $encontrado = false;

        foreach ($usuarios as $r) {

            if ($r['guid'] == $userX['guid']) {
                $encontrado = true;
                $r['investigacion'].=", " . $userX['investigacion'];
            }
        }

        if (!$encontrado) {
            $tipo[$user->sexo] ++;
            $etnia[$user->grupo_etnico] ++;
            array_push($usuarios, $userX);
        }
    }

    $retorno = array('lista' => $usuarios, 'tablas' => array('Género' => $tipo, 'Etnias' => $etnia));
    return $retorno;
}

/**
 * Función que devuelve las investigaciones de una convocatoria para generar el reporte y las graficas
 * por categoria de la investigacion y líneas temáticas de la investigacion
 * @param int $conv -> guid de la convocatoria
 * @return array
 */
function elgg_get_investigaciones_convByDpto($conv) {
    $convocatoria = get_entity($conv);
    $tipo = array();
    $lineas = array();
    $estados = array();
    $investigaciones = array();
    //Verifico Investigaciones Inscritas
    $investigacionesInscritas = elgg_get_relationship_inversa($convocatoria, 'inscrita_a_convocatoria');
    foreach ($investigacionesInscritas as $entity) {
        $investX = array();
        $nameLinea = get_entity($entity->linea_tematica)->name;
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');
        if (!array_key_exists($entity->categoria_inv, $tipo)) {
            $tipo[$entity->categoria_inv] = 0;
        }
        if (!array_key_exists($nameLinea, $lineas)) {
            $lineas[$nameLinea] = 0;
        }
        //Aparto los datos de la investigacion para imprimir en la tabla
        $investX['name'] = $entity->name;
        $investX['categoria_inv'] = $entity->categoria_inv;
        $investX['linea_tematica'] = $nameLinea;
        $investX['grupo'] = $grupo[0]->name;
        $investX['estado'] = 'Inscrita';
        //Sumo la cantida del tipo de invetsigacion para la gráficas
        $tipo[$entity->categoria_inv] ++;
        $lineas[$nameLinea] ++;
        $estados['Inscrita'] ++;
        array_push($investigaciones, $investX);
    }
    //Verifico Investigaciones Evaluadas
    $investigacionesEvaluadas = elgg_get_relationship_inversa($convocatoria, "evaluada_en_convocatoria");
    foreach ($investigacionesEvaluadas as $entity) {
        $investX = array();
        $nameLinea = get_entity($entity->linea_tematica)->name;
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');
        if (!array_key_exists($entity->categoria_inv, $tipo)) {
            $tipo[$entity->categoria_inv] = 0;
        }
        if (!array_key_exists($nameLinea, $lineas)) {
            $lineas[$nameLinea] = 0;
        }
        //Aparto los datos de la investigacion para imprimir en la tabla
        $investX['name'] = $entity->name;
        $investX['categoria_inv'] = $entity->categoria_inv;
        $investX['linea_tematica'] = $nameLinea;
        $investX['grupo'] = $grupo[0]->name;
        $investX['estado'] = 'Evaluada';
        //Sumo la cantida del tipo de invetsigacion para la gráficas
        $tipo[$entity->categoria_inv] ++;
        $lineas[$nameLinea] ++;
        $estados['Evaluada'] ++;
        array_push($investigaciones, $investX);
    }
    //Verifico Investigaciones Seleccionadas
    $investigacionesSeleccionadas = elgg_get_relationship_inversa($convocatoria, "seleccionada_en_convocatoria");
    foreach ($investigacionesSeleccionadas as $entity) {
        $investX = array();
        $nameLinea = get_entity($entity->linea_tematica)->name;
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');
        if (!array_key_exists($entity->categoria_inv, $tipo)) {
            $tipo[$entity->categoria_inv] = 0;
        }
        if (!array_key_exists($nameLinea, $lineas)) {
            $lineas[$nameLinea] = 0;
        }
        //Aparto los datos de la investigacion para imprimir en la tabla
        $investX['name'] = $entity->name;
        $investX['categoria_inv'] = $entity->categoria_inv;
        $investX['linea_tematica'] = $nameLinea;
        $investX['grupo'] = $grupo[0]->name;
        $investX['estado'] = 'Seleccionada';
        //Sumo la cantida del tipo de invetsigacion para la gráficas
        $tipo[$entity->categoria_inv] ++;
        $lineas[$nameLinea] ++;
        $estados['Seleccionada'] ++;
        array_push($investigaciones, $investX);
    }

    $retorno = array('lista' => $investigaciones, 'tablas' => array('Categoria' => $tipo, 'Línea Temática' => $lineas, 'Estado de la Investigación' => $estados));
    return $retorno;
}

/**
 * Función que concatena todos los Maestros de las investigaciones que participan en una convocatoria
 * @param int $conv -> guid de la convocatoria que se desea consultar
 * @return array|VACIO 
 */
function elgg_get_maestros_convByDpto($conv) {
    $convocatoria = get_entity($conv);
    $tipo = array();
    $etnia = array();

    $usuarios = array();
    //Verifico Investigaciones Inscritas
    $investigacionesInscritas = elgg_get_relationship_inversa($convocatoria, 'inscrita_a_convocatoria');
    $entities = elgg_get_maestros_investigaciones($investigacionesInscritas);
    foreach ($entities as $entity) {
        $userX = array();
        $user = get_entity($entity['guid']);
        if (!array_key_exists($user->sexo, $tipo)) {
            $tipo[$user->sexo] = 0;
        }
        if (!array_key_exists($user->grupo_etnico, $etnia)) {
            $etnia[$user->grupo_etnico] = 0;
        }
        //Aparto los datos del usuario para imprimir en la tabla
        $userX['guid'] = "$user->guid";
        $userX['investigacion'] = $entity['investigacion'];
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['sexo'] = $user->sexo;
        $userX['etnia'] = $user->grupo_etnico;
        $userX['email'] = $user->email;
        $userX['intitucion'] = $entity['intitucion'];
        $userX['municipio'] = $entity['municipio'];
        //Sumo las cantidades para las gráficas
        $encontrado = false;

        foreach ($usuarios as $r) {

            if ($r['guid'] == $userX['guid']) {
                $encontrado = true;
                $r['investigacion'].=", " . $userX['investigacion'];
            }
        }

        if (!$encontrado) {
            $tipo[$user->sexo] ++;
            $etnia[$user->grupo_etnico] ++;
            array_push($usuarios, $userX);
        }
    }
    //Verifico Investigaciones Evaluadas
    $investigacionesEvaluadas = elgg_get_relationship_inversa($convocatoria, "evaluada_en_convocatoria");
    $entitiesEv = elgg_get_maestros_investigaciones($investigacionesEvaluadas);
    foreach ($entitiesEv as $entity) {
        $userX = array();
        $user = get_entity($entity['guid']);
        if (!array_key_exists($user->sexo, $tipo)) {
            $tipo[$user->sexo] = 0;
        }

        if (!array_key_exists($user->grupo_etnico, $etnia)) {
            $etnia[$user->grupo_etnico] = 0;
        }
        //Aparto los datos del usuario para imprimir en la tabla
        $userX['guid'] = "$user->guid";
        $userX['investigacion'] = $entity['investigacion'];
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['sexo'] = $user->sexo;
        $userX['etnia'] = $user->grupo_etnico;
        $userX['email'] = $user->email;
        $userX['intitucion'] = $entity['intitucion'];
        //Sumo las cantidades para las gráficas
        $encontrado = false;

        foreach ($usuarios as $r) {

            if ($r['guid'] == $userX['guid']) {
                $encontrado = true;
                $r['investigacion'].=", " . $userX['investigacion'];
            }
        }

        if (!$encontrado) {
            $tipo[$user->sexo] ++;
            $etnia[$user->grupo_etnico] ++;
            array_push($usuarios, $userX);
        }
    }
    //Verifico Investigaciones Seleccionadas
    $investigacionesSeleccionadas = elgg_get_relationship_inversa($convocatoria, "seleccionada_en_convocatoria");
    $entitiesSel = elgg_get_maestros_investigaciones($investigacionesSeleccionadas);
    foreach ($entitiesSel as $entity) {
        $userX = array();
        $user = get_entity($entity['guid']);
        if (!array_key_exists($user->sexo, $tipo)) {
            $tipo[$user->sexo] = 0;
        }

        if (!array_key_exists($user->grupo_etnico, $etnia)) {
            $etnia[$user->grupo_etnico] = 0;
        }
        //Aparto los datos del usuario para imprimir en la tabla
        $userX['guid'] = "$user->guid";
        $userX['investigacion'] = $entity['investigacion'];
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['sexo'] = $user->sexo;
        $userX['etnia'] = $user->grupo_etnico;
        $userX['email'] = $user->email;
        $userX['intitucion'] = $entity['intitucion'];
        //Sumo las cantidades para las gráficas
        $encontrado = false;

        foreach ($usuarios as $r) {

            if ($r['guid'] == $userX['guid']) {
                $encontrado = true;
                $r['investigacion'].=", " . $userX['investigacion'];
            }
        }

        if (!$encontrado) {
            $tipo[$user->sexo] ++;
            $etnia[$user->grupo_etnico] ++;
            array_push($usuarios, $userX);
        }
    }

    $retorno = array('lista' => $usuarios, 'tablas' => array('Género' => $tipo, 'Etnias' => $etnia));
    return $retorno;
}

/**
 * Función que devuelve los grupos de investigacion de una convocatoria para generar el reporte y las graficas
 * por categoria de la investigacion y líneas temáticas de la investigacion
 * @param int $conv -> guid de la convocatoria
 * @return array
 */
function elgg_get_grupos_convByDpto($conv) {
    $convocatoria = get_entity($conv);
    $grupsMas = array();
    $grupos = array();
    //Verifico Investigaciones Inscritas
    $investigacionesInscritas = elgg_get_relationship_inversa($convocatoria, 'inscrita_a_convocatoria');

    foreach ($investigacionesInscritas as $entity) {
        $gruX = array();
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');
        if (!array_key_exists($grupo[0]->name, $grupsMas)) {
            $grupsMas[$grupo[0]->name] = 0;
        }
        //Aparto los datos del Grupo para imprimir en la tabla
        $gruX['guid'] = "{$grupo[0]->guid}";
        $gruX['name'] = $grupo[0]->name;
        $gruX['usuarios'] = sizeof(elgg_get_entities_grupo_investigacion(new ElggGrupoInvestigacion($grupo[0]->guid)));
        $gruX['investigaciones'] = sizeof(elgg_get_investigaciones_por_grupo($grupo[0]->guid));
        //Sumo la cantidades para las gráficas
        $encontrado = false;

        foreach ($grupos as $r) {

            if ($r['guid'] == $gruX['guid']) {
                $encontrado = true;
            }
        }

        if (!$encontrado) {
            $grupsMas[$grupo[0]->name] ++;
            array_push($grupos, $gruX);
        }
    }
    //Verifico Investigaciones Evaluadas
    $investigacionesEvaluadas = elgg_get_relationship_inversa($convocatoria, "evaluada_en_convocatoria");

    foreach ($investigacionesEvaluadas as $entity) {
        $gruX = array();
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');
        if (!array_key_exists($grupo[0]->name, $grupsMas)) {
            $grupsMas[$grupo[0]->name] = 0;
        }
        //Aparto los datos del Grupo para imprimir en la tabla
        $gruX['guid'] = "{$grupo[0]->guid}";
        $gruX['name'] = $grupo[0]->name;
        $gruX['usuarios'] = sizeof(elgg_get_entities_grupo_investigacion(new ElggGrupoInvestigacion($grupo[0]->guid)));
        $gruX['investigaciones'] = sizeof(elgg_get_investigaciones_por_grupo($grupo[0]->guid));
        //Sumo la cantidades para las gráficas
        $encontrado = false;

        foreach ($grupos as $r) {

            if ($r['guid'] == $gruX['guid']) {
                $encontrado = true;
            }
        }

        if (!$encontrado) {
            $grupsMas[$grupo[0]->name] ++;
            array_push($grupos, $gruX);
        }
    }
    //Verifico Investigaciones Seleccionadas
    $investigacionesSeleccionadas = elgg_get_relationship_inversa($convocatoria, "seleccionada_en_convocatoria");

    foreach ($investigacionesSeleccionadas as $entity) {
        $gruX = array();
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');
        if (!array_key_exists($grupo[0]->name, $grupsMas)) {
            $grupsMas[$grupo[0]->name] = 0;
        }
        //Aparto los datos del Grupo para imprimir en la tabla
        $gruX['guid'] = "{$grupo[0]->guid}";
        $gruX['name'] = $grupo[0]->name;
        $gruX['usuarios'] = sizeof(elgg_get_entities_grupo_investigacion(new ElggGrupoInvestigacion($grupo[0]->guid)));
        $gruX['investigaciones'] = sizeof(elgg_get_investigaciones_por_grupo($grupo[0]->guid));
        //Sumo la cantidades para las gráficas

        $encontrado = false;

        foreach ($grupos as $r) {

            if ($r['guid'] == $gruX['guid']) {
                $encontrado = true;
            }
        }

        if (!$encontrado) {
            $grupsMas[$grupo[0]->name] ++;
            array_push($grupos, $gruX);
        }
    }

    $retorno = array('lista' => $grupos, 'tablas' => array('Nombre de Grupo' => $grupsMas));
    return $retorno;
}

/**
 * Función que consulta todos los asesores de una Convocatoria
 * @param Entity $int  Convocatoria que se desea consultar
 * @return array|VACIO 
 */
function elgg_get_estadisticas_asesores_conv($guid) {


    $usuarios = array();
    $tipo = array();
    $entities = elgg_get_asesores_asignados_convocatoria($guid);

    foreach ($entities as $ent) {
        $userX = array();
        $user = get_entity($ent['guid']);
        if (!array_key_exists($user->sexo, $tipo)) {
            $tipo[$user->sexo] = 0;
        }

        //Aparto los datos del usuario para imprimir en la tabla
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['sexo'] = $user->sexo;
        $userX['email'] = $user->email;

        //Sumo la cantida del tipo de usuario para la gráfica
        $tipo[$user->sexo] ++;
        array_push($usuarios, $userX);
    }



    $retorno = array('lista' => $usuarios, 'tablas' => array('Género' => $tipo));
    return $retorno;
}

/* * ************FERIAS***************************************************************** */

function elgg_get_ferias_by_dpto($dpto) {

    $options = array(
        'type' => 'group',
        'subtype' => 'feria',
        'metadata_names' => 'departamento',
        'metadata_values' => $dpto
    );

    $entities = elgg_get_entities_from_metadata($options);
    return $entities;
}

/**
 * Función que retorna las ferias que se encuentran en el dpto seleccionado
 * @param text $dpto -> departamento para la busqueda
 * @return type->NULL|array
 */
function elgg_get_ferias_departamento($dpto) {


    $entities = elgg_get_ferias_by_dpto($dpto);

    $tipo = array();
    $area_feria = array();
    $niveles = array();
    $ferias = array();

    foreach ($entities as $entity) {
        $fer = array();
        if (!array_key_exists($entity->tipo_feria, $tipo)) {
            $tipo[$entity->tipo_feria] = 0;
        }

        $areas = elgg_get_relationship($entity, 'tiene_el_area');
        $lista_areas = "";
        foreach ($areas as $l) {
            if (!array_key_exists($l->title, $area_feria)) {
                $area_feria[$l->title] = 0;
            }
            $lista_areas.= $l->title . " ";
            $area_feria[$l->title] ++;
        }

        $entities = elgg_get_relationship($entity, 'tiene_el_nivel');
        $lista_niveles = "";
        foreach ($entities as $n) {
            if (!array_key_exists($n->title, $niveles)) {
                $niveles[$n->title] = 0;
            }
            $lista_niveles.= $n->title . " ";
            $niveles[$n->title] ++;
        }


        $fer['areas'] = $lista_areas;
        $fer['niveles'] = $lista_niveles;
        $fer['name'] = $entity->name;
        $fer['departamento'] = $entity->departamento;
        $fer['fecha_inicio_feria'] = $entity->fecha_inicio_feria;
        $fer['fecha_fin_feria'] = $entity->fecha_fin_feria;
        $fer['tipo_feria'] = $entity->tipo_feria;
        $tipo[$entity->tipo_feria] ++;
        array_push($ferias, $fer);
    }
    $retorno = array('lista' => $ferias, 'tablas' => array('Tipo' => $tipo, 'Área' => $area_feria, 'Niveles' => $niveles));
    return $retorno;
}

/**
 * Función que retorna las ferias que se encuentran en el municipio seleccionado
 * @param text $municipio -> municipio para la busqueda
 * @return type->NULL|array
 */
function elgg_get_ferias_municipio($municipio) {





    $options = array(
        'type' => 'group',
        'subtype' => 'feria',
        'metadata_name_value_pairs' => array('name' => 'municipios', 'value' => '%' . $municipio . '%', 'operand' => 'LIKE')
    );

    $entities = elgg_get_entities_from_metadata($options);
    $tipo = array();
    $area_feria = array();
    $niveles = array();
    $ferias = array();

    foreach ($entities as $entity) {
        $fer = array();
        if (!array_key_exists($entity->tipo_feria, $tipo)) {
            $tipo[$entity->tipo_feria] = 0;
        }

        $areas = elgg_get_relationship($entity, 'tiene_el_area');
        $lista_areas = "";
        foreach ($areas as $l) {
            if (!array_key_exists($l->title, $area_feria)) {
                $area_feria[$l->title] = 0;
            }
            $lista_areas.= $l->title . " ";
            $area_feria[$l->title] ++;
        }

        $entities = elgg_get_relationship($entity, 'tiene_el_nivel');
        $lista_niveles = "";
        foreach ($entities as $n) {
            if (!array_key_exists($n->title, $niveles)) {
                $niveles[$n->title] = 0;
            }
            $lista_niveles.= $n->title . " ";
            $niveles[$n->title] ++;
        }


        $fer['areas'] = $lista_areas;
        $fer['niveles'] = $lista_niveles;
        $fer['name'] = $entity->name;
        $fer['departamento'] = $entity->departamento;
        $fer['municipio'] = $entity->municipios;
        $fer['fecha_inicio_feria'] = $entity->fecha_inicio_feria;
        $fer['fecha_fin_feria'] = $entity->fecha_fin_feria;
        $fer['tipo_feria'] = $entity->tipo_feria;
        $tipo[$entity->tipo_feria] ++;
        array_push($ferias, $fer);
    }
    $retorno = array('lista' => $ferias, 'tablas' => array('Tipo' => $tipo, 'Area' => $area_feria, 'Niveles' => $niveles));
    return $retorno;
}

/**
 * Funcion que consulta las investigaciones que tiene un grupo
 * @param type->int guid del grupo 
 * @return type -> array
 */
function elgg_get_estadistica_investigaciones_feria($feria) {


    $investigaciones = array();
    $estados = array();

    $investigacionesInscritas = elgg_get_relationship_inversa($feria, 'inscrita_en');
    foreach ($investigacionesInscritas as $entity) {
        $investX = array();
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');
        //Aparto los datos de la investigacion para imprimir en la tabla
        $investX['name'] = $entity->name;
        $investX['grupo'] = $grupo[0]->name;
        $investX['estado'] = 'Inscrita';
        //Sumo la cantidad del tipo de invetsigacion para la gráficas

        $estados['Inscrita'] ++;
        array_push($investigaciones, $investX);
    }


    $inv_acred = elgg_get_relationship_inversa($feria, "acreditada en");
    foreach ($inv_acred as $entity) {
        $investX = array();
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');
        //Aparto los datos de la investigacion para imprimir en la tabla
        $investX['name'] = $entity->name;
        $investX['grupo'] = $grupo[0]->name;
        $investX['estado'] = 'Acreditada como participante';
        //Sumo la cantidad del tipo de invetsigacion para la gráficas

        $estados['Acreditadas como participantes'] ++;
        array_push($investigaciones, $investX);
    }

    $inv_eva_inic = elgg_get_relationship_inversa($feria, "evaluada_inicialmente_en");
    foreach ($inv_eva_inic as $entity) {
        $investX = array();
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');
        //Aparto los datos de la investigacion para imprimir en la tabla
        $investX['name'] = $entity->name;
        $investX['grupo'] = $grupo[0]->name;
        $investX['estado'] = 'Inicialmente evaluada';
        //Sumo la cantidad del tipo de invetsigacion para la gráficas

        $estados['Inicialmente evaluadas'] ++;
        array_push($investigaciones, $investX);
    }

    $inv_eva_sitio = elgg_get_relationship_inversa($feria, "evaluada_en_sitio_en");
    foreach ($inv_eva_sitio as $entity) {
        $investX = array();
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');
        //Aparto los datos de la investigacion para imprimir en la tabla
        $investX['name'] = $entity->name;
        $investX['grupo'] = $grupo[0]->name;
        $investX['estado'] = 'Evaluada en sitio';
        //Sumo la cantidad del tipo de invetsigacion para la gráficas

        $estados['Evaluadas en Sitio'] ++;
        array_push($investigaciones, $investX);
    }

    $inv_fin = elgg_get_relationship_inversa($feria, "finalista_en");
    foreach ($inv_fin as $entity) {
        $investX = array();

        //Aparto los datos de la investigacion para imprimir en la tabla
        $investX['name'] = $entity->name;
        $investX['grupo'] = $grupo[0]->name;
        $investX['estado'] = 'Finalista';
        //Sumo la cantidad del tipo de invetsigacion para la gráficas

        $estados['Finalistas'] ++;
        array_push($investigaciones, $investX);
    }





    $retorno = array('lista' => $investigaciones, 'tablas' => array('Estado de la Investigación' => $estados));
    return $retorno;
}

/**
 * Función que consulta los usuarios de las investigaciones que participan en una Feria
 * @param Entity $feria feria que se desea consultar
 * @return array|VACIO 
 */
function elgg_get_estadisticas_maestros_feria($feria) {

    $tipo = array();
    $etnia = array();
    $usuarios = array();


    $investigaciones = array();
    $investigacionesInscritas = elgg_get_relationship_inversa($feria, 'inscrita_en');
    $investigaciones = array_merge($investigaciones, $investigacionesInscritas);

    $inv_acred = elgg_get_relationship_inversa($feria, "acreditada en");
    $investigaciones = array_merge($investigaciones, $inv_acred);

    $inv_eva_inic = elgg_get_relationship_inversa($feria, "evaluada_inicialmente_en");
    $investigaciones = array_merge($investigaciones, $inv_eva_inic);

    $inv_eva_sitio = elgg_get_relationship_inversa($feria, "evaluada_en_sitio_en");
    $investigaciones = array_merge($investigaciones, $inv_eva_sitio);

    $inv_fin = elgg_get_relationship_inversa($feria, "finalista_en");
    $investigaciones = array_merge($investigaciones, $inv_fin);


    $entities = elgg_get_maestros_investigaciones($investigaciones);
    foreach ($entities as $entity) {
        $userX = array();
        $user = get_entity($entity['guid']);
        if (!array_key_exists($user->sexo, $tipo)) {
            $tipo[$user->sexo] = 0;
        }

        if (!array_key_exists($user->grupo_etnico, $etnia)) {
            $etnia[$user->grupo_etnico] = 0;
        }

        //Aparto los datos del usuario para imprimir en la tabla
        $userX['guid'] = "{$user->guid}";
        $userX['institucion'] = $entity['intitucion'];
        $userX['municipio'] = $entity['municipio'];
        $userX['investigacion'] = $entity['investigacion'];
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['sexo'] = $user->sexo;
        $userX['etnia'] = $user->grupo_etnico;
        $userX['email'] = $user->email;


        $encontrado = false;

        foreach ($usuarios as $r) {

            if ($r['guid'] == $userX['guid']) {
                $encontrado = true;
                $r['investigacion'].= ", " . $userX['investigacion'];
            }
        }

        if (!$encontrado) {
            $tipo[$user->sexo] ++;
            $etnia[$user->grupo_etnico] ++;
            array_push($usuarios, $userX);
        }
    }



    $retorno = array('lista' => $usuarios, 'tablas' => array('Género' => $tipo, 'Etnias' => $etnia));
    return $retorno;
}

/**
 * Función que consulta los usuarios de las investigaciones que participan en una Feria
 * @param Entity $feria de la convocatoria que se desea consultar
 * @return array|VACIO 
 */
function elgg_get_estadisticas_grupos_feria($feria) {


    $gruX = array();
    $grupos = array();


    $investigaciones = array();
    $investigacionesInscritas = elgg_get_relationship_inversa($feria, 'inscrita_en');
    $investigaciones = array_merge($investigaciones, $investigacionesInscritas);

    $inv_acred = elgg_get_relationship_inversa($feria, "acreditada en");
    $investigaciones = array_merge($investigaciones, $inv_acred);

    $inv_eva_inic = elgg_get_relationship_inversa($feria, "evaluada_inicialmente_en");
    $investigaciones = array_merge($investigaciones, $inv_eva_inic);

    $inv_eva_sitio = elgg_get_relationship_inversa($feria, "evaluada_en_sitio_en");
    $investigaciones = array_merge($investigaciones, $inv_eva_sitio);

    $inv_fin = elgg_get_relationship_inversa($feria, "finalista_en");
    $investigaciones = array_merge($investigaciones, $inv_fin);


    foreach ($investigaciones as $entity) {
        $gruX = array();
        $grupo = elgg_get_relationship_inversa($entity, 'tiene_la_investigacion');

        //Aparto los datos del Grupo para imprimir en la tabla
        $gruX['guid'] = "{$grupo[0]->guid}";
        $gruX['name'] = $grupo[0]->name;
        $gruX['usuarios'] = sizeof(elgg_get_entities_grupo_investigacion($grupo[0]));
        $gruX['investigaciones'] = sizeof(elgg_get_investigaciones_por_grupo($grupo[0]->guid));
        //Sumo la cantidades para las gráficas

        $encontrado = false;

        foreach ($grupos as $r) {

            if ($r['guid'] == $gruX['guid']) {
                $encontrado = true;
            }
        }

        if (!$encontrado) {
            array_push($grupos, $gruX);
        }
    }



    $retorno = array('lista' => $grupos);
    return $retorno;
}

/**
 * Función que consulta los usuarios de las investigaciones que participan en una Feria
 * @param Entity $feria de la convocatoria que se desea consultar
 * @return array|VACIO 
 */
function elgg_get_estadisticas_estudiantes_feria($feria) {

    $tipo = array();
    $etnia = array();
    $usuarios = array();


    $investigaciones = array();
    $investigacionesInscritas = elgg_get_relationship_inversa($feria, 'inscrita_en');
    $investigaciones = array_merge($investigaciones, $investigacionesInscritas);

    $inv_acred = elgg_get_relationship_inversa($feria, "acreditada en");
    $investigaciones = array_merge($investigaciones, $inv_acred);

    $inv_eva_inic = elgg_get_relationship_inversa($feria, "evaluada_inicialmente_en");
    $investigaciones = array_merge($investigaciones, $inv_eva_inic);

    $inv_eva_sitio = elgg_get_relationship_inversa($feria, "evaluada_en_sitio_en");
    $investigaciones = array_merge($investigaciones, $inv_eva_sitio);

    $inv_fin = elgg_get_relationship_inversa($feria, "finalista_en");
    $investigaciones = array_merge($investigaciones, $inv_fin);


    $entities = elgg_get_estudiantes_investigaciones($investigaciones);
    foreach ($entities as $entity) {
        $userX = array();
        $user = get_entity($entity['guid']);
        if (!array_key_exists($user->sexo, $tipo)) {
            $tipo[$user->sexo] = 0;
        }
        if (!array_key_exists($user->grupo_etnico, $etnia)) {
            $etnia[$user->grupo_etnico] = 0;
        }
        //Aparto los datos del usuario para imprimir en la tabla
        $userX['guid'] = "{$user->guid}";
        $userX['investigacion'] = $entity['investigacion'];
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['sexo'] = $user->sexo;
        $userX['curso'] = $user->curso;
        $userX['etnia'] = $user->grupo_etnico;
        $userX['email'] = $user->email;
        //Sumo la cantida del tipo de usuario para la gráfica
        $encontrado = false;

        foreach ($usuarios as $r) {

            if ($r['guid'] == $userX['guid']) {
                $encontrado = true;
                $r['investigacion'].= ", " . $userX['investigacion'];
            }
        }

        if (!$encontrado) {
            $tipo[$user->sexo] ++;
            $etnia[$user->grupo_etnico] ++;
            array_push($usuarios, $userX);
        }
    }



    $retorno = array('lista' => $usuarios, 'tablas' => array('Género' => $tipo, 'Etnias' => $etnia));
    return $retorno;
}

/**
 * Función que devuelve los estudiantes de las investigaciones que se encuentran en estado Inscrita en la convocatoria
 * @param array $investigaciones -> array de las investigaciones para consultar los estudiantes de cada una
 * @return array
 */
function elgg_get_estudiantes_investigaciones($investigaciones) {
    $users = array();
    foreach ($investigaciones as $inv) {
        $integrantes_inv = elgg_get_relationship_inversa($inv, "hace_parte_de");
        foreach ($integrantes_inv as $int) {
            array_push($users, array('guid' => $int->guid, 'investigacion' => $inv->name));
        }
    }
    return $users;
}

/**
 * Función que devuelve los maestros de las investigaciones que se encuentran en la convocatoria
 * @param array $investigaciones -> array de las investigaciones para consultar los estudiantes de cada una
 * @return array
 */
function elgg_get_maestros_investigaciones($investigaciones) {
    $users = array();
    foreach ($investigaciones as $inv) {
        $integrantes_inv = elgg_get_relationship_inversa($inv, "es_colaborador_de");
        foreach ($integrantes_inv as $int) {
            $institucion = elgg_get_relationship($int, 'trabaja_en');
            array_push($users, array('guid' => $int->guid, 'investigacion' => $inv->name, 'intitucion' => $institucion[0]->name, 'municipio' => $institucion[0]->municipio));
        }
    }
    return $users;
}

/**
 * Función que consulta los evaluadores de una Feria o de una COnvocatoria
 * @param Entity $entity Feria o Convocatoria que se desea consultar
 * @param String $relation  relación que se desea consultar
 * @return array|VACIO 
 */
function elgg_get_estadisticas_evaluadores($entity, $relation) {


    $usuarios = array();
    $tipo = array();
    $entities = elgg_get_relationship_inversa($entity, $relation);

    foreach ($entities as $ent) {
        $userX = array();
        $user = get_entity($ent['guid']);
        if (!array_key_exists($user->sexo, $tipo)) {
            $tipo[$user->sexo] = 0;
        }

        //Aparto los datos del usuario para imprimir en la tabla
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['sexo'] = $user->sexo;
        $userX['email'] = $user->email;

        //Sumo la cantida del tipo de usuario para la gráfica
        $tipo[$user->sexo] ++;
        array_push($usuarios, $userX);
    }



    $retorno = array('lista' => $usuarios, 'tablas' => array('Género' => $tipo));
    return $retorno;
}

/**
 * Función que devuelve los datos para generar el reporte de los usuarios dentro de una red
 * @param int $guid_red -> identificador de la red temática
 * @return array -> con los datos del reporte
 */
function elgg_get_usuarios_red($guid_red) {

    $red = get_entity($guid_red);
    $options_integrantes = array(
        'relationship' => 'es_miembro_de',
        'relationship_guid' => $guid_red,
        'inverse_relationship' => true);

    $usuarios = array();
    $genero = array();
    $tipo = array();
    $entities = elgg_get_entities_from_relationship($options_integrantes);
    
    $dueño = get_entity($red->owner_guid);
    
    array_push($entities, $dueño);
    
    foreach ($entities as $ent) {

        $userX = array();
        $user = get_entity($ent->guid);
        if (!array_key_exists($user->sexo, $genero)) {
            $tipo[$user->sexo] = 0;
        }
        if (!array_key_exists($user->getSubtype(), $tipo)) {
            $tipo[$user->getSubtype()] = 0;
        }
        $grupos = elgg_get_relationship($user, 'es_miembro_de');
        $name_grupos = "";
        foreach ($grupos as $g) {
            if ($g->getSubtype() == 'grupo_investigacion') {
                $name_grupos .= $g->name . '<br/><br/>';
            }
        }
        if (empty($name_grupos)) {
            $name_grupos = "El usuario no pertenece a ningún grupo de investigación";
        }
        //Aparto los datos del usuario para imprimir en la tabla
        $userX['name'] = $user->name . ' ' . $user->apellidos;
        $userX['email'] = $user->email;
        $userX['sexo'] = $user->sexo;
        $userX['tipo'] = $user->getSubtype();
        $userX['grupos'] = $name_grupos;

        //Sumo la cantida del tipo de usuario para la gráfica

        array_push($usuarios, $userX);
    }



    $retorno = array('lista' => $usuarios);
    return $retorno;
}

/* * ***************************************************GRUPOS******************************************************************** */

/**
 * Función que consulta todas las convocatorias en las que ha participado un grupo de investigación
 * @param String $guid Id del Grupo de Investigación del que se desea obtener la información
 * @return array|VACIO 
 */
function elgg_get_estadisticas_convocatoria_grupo($guid) {

    $investigaciones = elgg_get_investigaciones_por_grupo($grupo);



    $inv = array();
    $result = array();


    foreach ($investigaciones as $investigacion) {


        $nombre_linea = "";
        $estado = "";
        $guid = elgg_get_relationship($investigacion, "preinscrita_a_convocatoria");
        $guid1 = elgg_get_relationship($investigacion, "inscrita_a_convocatoria");
        $guid2 = elgg_get_relationship($investigacion, "evaluada_en_convocatoria");
        $guid3 = elgg_get_relationship($investigacion, "seleccionada_en_convocatoria");
        $convocatoria = NULL;

        if ($guid != NULL) {

            $convocatoria = get_entity($guid[0]->guid);
            $lineas = elgg_get_relationship($investigacion, "preinscrita_a_{$convocatoria->guid}_con_linea_tematica");
            $linea = get_entity($lineas[0]->guid);
            $nombre_linea = $linea->name;
            $estado = "Preinscrita";
        } else if ($guid1 != NULL) {

            $convocatoria = get_entity($guid1[0]->guid);
            $lineas = elgg_get_relationship($investigacion, "inscrita_a_{$convocatoria->guid}_con_linea_tematica");
            $linea = get_entity($lineas[0]->guid);
            $nombre_linea = $linea->name;
            $estado = "Inscrita";
        } else if ($guid2 != NULL) {

            $convocatoria = get_entity($guid2[0]->guid);
            $lineas = elgg_get_relationship($investigacion, "evaluada_en_{$convocatoria->guid}_con_linea_tematica");
            $linea = get_entity($lineas[0]->guid);
            $nombre_linea = $linea->name;
            $estado = "Evaluada";
        } else if ($guid3 != NULL) {

            $convocatoria = get_entity($guid3[0]->guid);
            $lineas = elgg_get_relationship($investigacion, "seleccionada_en_{$convocatoria->guid}_con_linea_tematica");
            $linea = get_entity($lineas[0]->guid);
            $nombre_linea = $linea->name;
            $estado = "Seleccionada";
        }


        if ($convocatoria->name != "") {
            $convG = array('guid' => $convocatoria->guid, 'nombre_conv' => $convocatoria->name, 'tipo_conv' => $convocatoria->tipo_convocatoria, 'dpto' => $convocatoria->departamento, 'linea' => $nombre_linea, 'nombre_inv' => $investigacion->name, 'estado' => $estado);

            $encontrado = false;

            foreach ($result as $r) {

                if ($r['guid'] == $convG['guid']) {
                    $encontrado = true;
                }
            }

            if (!$encontrado) {
                array_push($result, $convG);
            }
        }
    }
    return $result;
}

/**
 * Función que consulta todas las ferias en las que ha participado un grupo de investigación
 * @param String $guid Id del Grupo de Investigación del que se desea obtener la información
 * @return array|VACIO 
 */
function elgg_get_estadisticas_ferias_grupo($guid) {

    $investigaciones = elgg_get_investigaciones_por_grupo($guid);


    $feria_grupo = array();
    $result = array();


    foreach ($investigaciones as $investigacion) {



        $ferias = array();

        $feriaI = elgg_get_relationship($investigacion, 'inscrita_en');
        $ferias = array_merge($ferias, $feriaI);

        $feriaA = elgg_get_relationship($investigacion, "acreditada en");
        $ferias = array_merge($ferias, $feriaA);

        $feriaEI = elgg_get_relationship($investigacion, "evaluada_inicialmente_en");
        $ferias = array_merge($ferias, $feriaEI);

        $feriaES = elgg_get_relationship($investigacion, "evaluada_en_sitio_en");
        $ferias = array_merge($ferias, $feriaES);

        $feriaF = elgg_get_relationship($investigacion, "finalista_en");
        $ferias = array_merge($ferias, $feriaF);


        if (sizeof($ferias) != 0) {

            $feria_grupo = array('guid' => $ferias[0]->guid, 'nombre_feria' => $ferias[0]->name, 'tipo_feria' => $ferias[0]->tipo_feria, 'forma_partic' => $ferias[0]->formas_participacion, 'dpto' => $ferias[0]->departamento);

            $encontrado = false;
            foreach ($result as $r) {

                if ($r['guid'] == $feria_grupo['guid']) {
                    $encontrado = true;
                }
            }

            if (!$encontrado) {
                array_push($result, $feria_grupo);
            }
        }
    }

    return $result;
}

/* * ***************************************************ASESOR******************************************************************** */

/**
 * Función que busca las investigaciones de un asesor o evaluador en una convocatoria
 * @param int $guid_user Id del Asesor/Evaluador del que se desea obtener los proyectos asesorados o evaluados
 * @param int $guid_convocatoria Id de la Convocatoria
 * @param String $relacion Nombre de la relación dependiendo si es evaluador o asesor
 * @return array|VACIO 
 */
function elgg_get_estadisticas_proyectos_asesor_eval_conv($guid_user, $guid_convocatoria, $relacion) {

    $entities = elgg_get_asesorias_entities($guid_user, $guid_convocatoria, $relacion);
    $investigaciones = array();
    $linea_T = array();
    $categoria = array();

    foreach ($entities as $entity) {
        $investigacionX = array();
        $lin = get_entity($entity->linea_tematica)->name;
        if (!array_key_exists($lin, $linea_T)) {
            $linea_T[$lin] = 0;
        }
        if (!array_key_exists($entity->categoria_inv, $categoria)) {
            $categoria[$entity->categoria_inv] = 0;
        }
        //Aparto los datos de las investigaciones para imprimir en la tabla
        $grupo = elgg_get_relationship_inversa($entity, "tiene_la_investigacion");

        if (check_entity_relationship($grupo[0]->guid, "tiene_la_investigacion", $entity->guid)) {
            // Busca la relacion del grupo con la institución  para enviar datos al formulario de registro y actualización
            $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
        }
        $investigacionX['nombre'] = $entity->name;
        $investigacionX['linea'] = $lin;
        $investigacionX['categoria'] = $entity->categoria_inv;
        $investigacionX['grupo'] = $grupo[0]->name;
        $investigacionX['colegio'] = $institucion[0]->name;
        $investigacionX['colegio'] = $institucion[0]->municipio;

        //Sumo las cantidades para estadisticas
        $linea_T[$lin] ++;
        $categoria[$entity->categoria_inv] ++;
        array_push($investigaciones, $investigacionX);
    }

    $retorno = array('lista' => $investigaciones, 'tablas' => array('Línea Temática' => $linea_T, 'Categoria' => $categoria));
    return $retorno;
}

/**
 * Funcion que devuelve las entidades de las investigaciones de un asesore en una convocatorias
 * @param int $guid_Asesor -> guid del asesor
 * @param int $guid_conv -> guid de la convocatoria 
 * @return type -> array
 */
function elgg_get_asesorias_entities($guid_user, $guid_conv, $relacion) {
    $investigaciones = elgg_get_relationship(get_entity($guid_user), $relacion);
    return elgg_investigaciones_entity2($investigaciones, $guid_conv);
}

/**
 * Funcion que devuelve las entidades de las investigaciones de un asesore
 * @param int $guid_Asesor -> guid del asesor
 * @param text $relacion -> nombre de la relación
 * @return type -> array
 */
function elgg_get_all_asesorias_entities($guid_user, $relacion) {
    $investigaciones = elgg_get_relationship(get_entity($guid_user), $relacion);
    return $investigaciones;
}

/**
 * Función que busca las investigaciones de un asesor 
 * @param String $guid del asesor
 * @return array|VACIO 
 */
function elgg_get_estadisticas_proyectos_asesor($guid_asesor) {

    $entities = elgg_get_relationship(get_entity($guid_asesor), 'es_asesor_de');
    $investigaciones = array();
    $linea_T = array();
    $categoria = array();

    foreach ($entities as $entity) {
        $investigacionX = array();
        $lin = get_entity($entity->linea_tematica)->name;
        if (!array_key_exists($lin, $linea_T)) {
            $linea_T[$lin] = 0;
        }
        if (!array_key_exists($entity->categoria_inv, $categoria)) {
            $categoria[$entity->categoria_inv] = 0;
        }
        //Aparto los datos de las investigaciones para imprimir en la tabla
        $grupo = elgg_get_relationship_inversa($entity, "tiene_la_investigacion");

        if (check_entity_relationship($grupo[0]->guid, "tiene_la_investigacion", $entity->guid)) {
            // Busca la relacion del grupo con la institución  para enviar datos al formulario de registro y actualización
            $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
        }
        $investigacionX['nombre'] = $entity->name;
        $investigacionX['linea'] = $lin;
        $investigacionX['categoria'] = $entity->categoria_inv;
        $investigacionX['grupo'] = $grupo[0]->name;
        $investigacionX['colegio'] = $institucion[0]->name;
        $investigacionX['colegio'] = $institucion[0]->municipio;

        //Sumo las cantidades para estadisticas
        $linea_T[$lin] ++;
        $categoria[$entity->categoria_inv] ++;
        array_push($investigaciones, $investigacionX);
    }

    $retorno = array('lista' => $investigaciones, 'tablas' => array('Línea Temática' => $linea_T, 'Categoría' => $categoria));
    return $retorno;
}

/**
 * Función que busca las investigaciones de un asesor o evaluador en una convocatoria
 * @param int $guid_user Id del Asesor/Evaluador del que se desea obtener los proyectos asesorados o evaluados
 * @param int $guid_convocatoria Id de la Convocatoria
 * @param String $relacion Nombre de la relación dependiendo si es evaluador o asesor
 * @return array|VACIO 
 */
function elgg_get_estadisticas_calificacion_asesor_conv($guid_user, $guid_convocatoria) {

    $entities = elgg_get_asesorias_entities($guid_user, $guid_convocatoria, "es_asesor_de");
    $investigaciones = array();
    $linea_T = array();
    $categoria = array();

    foreach ($entities as $entity) {
        $investigacionX = array();
        $lin = get_entity($entity->linea_tematica)->name;
        if (!array_key_exists($lin, $linea_T)) {
            $linea_T[$lin] = 0;
        }
        if (!array_key_exists($entity->categoria_inv, $categoria)) {
            $categoria[$entity->categoria_inv] = 0;
        }
        //Aparto los datos de las investigaciones para imprimir en la tabla
        $grupo = elgg_get_relationship_inversa($entity, "tiene_la_investigacion");

        if (check_entity_relationship($grupo[0]->guid, "tiene_la_investigacion", $entity->guid)) {
            // Busca la relacion del grupo con la institución  para enviar datos al formulario de registro y actualización
            $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
        }
        $investigacionX['nombre'] = $entity->name;
        $investigacionX['linea'] = $lin;
        $investigacionX['categoria'] = $entity->categoria_inv;
        $investigacionX['grupo'] = $grupo[0]->name;
        $investigacionX['colegio'] = $institucion[0]->name;
        $investigacionX['municipio'] = $institucion[0]->municipio;
        $investigacionX['calificacion'] = caslifcacion_asesoria_investigación($entity->guid);

        //Sumo las cantidades para estadisticas
        $linea_T[$lin] ++;
        $categoria[$entity->categoria_inv] ++;
        array_push($investigaciones, $investigacionX);
    }


    $retorno = array('lista' => $investigaciones, 'tablas' => array('Línea Temática' => $linea_T, 'Categoria' => $categoria));
    return $retorno;
}

/**
 * Función que devuelve la calificacion total de la asesoria a una investigacion 
 * @param int $guid_investigacion -> id de la investigacion
 * @return type
 */
function caslifcacion_asesoria_investigación($guid_investigacion) {
    $calificacion = 0;
    $options = array(
        'type' => 'object',
        'subtype' => 'asesoria',
        'container_guid' => $guid_investigacion,
        'limit' => 0,
    );
    $asesorias = elgg_get_entities_from_metadata($options);
    $notX = 0;
    foreach ($asesorias as $as) {
        $annotations = $as->getAnnotations('calificacion');
        $notaFinal = 0;
        foreach ($annotations as $nota) {
            $notaFinal+=(int) $nota->value;
        }
        $calificacion += ($notaFinal / sizeof($annotations));
        $notX++;
    }
    $return = "";
    if ($calificacion == 0) {
        $return = "No hay calificaciones registradas";
    } else if (sizeof($asesorias) > 0) {
        $return = $calificacion / $notX;
    } else {
        $return = "No hay asesorias registradas";
    }
    return $return;
}

/**
 * Función que devuelve todas las asesorias de una investigacion.
 * @param int $guid_investigacion -> id de la investigación
 * @return array
 */
function get_asesorias_investigacion($guid_investigacion) {
    $asesoriasX = array();
    $ret = array();
    $tipo = array();
    $query = array('type' => 'object', 'subtype' => 'asesoria', 'container_guid' => $guid_investigacion,
        'order_by_metadata' => array('name' => 'fecha', 'direction' => 'DESC'));
    $entities = elgg_get_entities_from_metadata($query);
    //recorro las asesorias de la investigacion
    foreach ($entities as $entity) {
        if (!array_key_exists($entity->modo, $tipo)) {
            $tipo[$entity->modo] = 0;
        }
        //preparo los datos para la tabla
        $asesoriasX['nombre'] = $entity->title;
        $asesoriasX['fecha'] = $entity->fecha;
        $asesoriasX['hora'] = $entity->hora;
        $asesoriasX['modo'] = $entity->modo;
        $asesoriasX['tipo'] = $entity->tipo;
        $asesoriasX['observaciones'] = $entity->observaciones;


        $tipo[$entity->modo] ++;
        array_push($ret, $asesoriasX);
    }
    $retorno = array('lista' => $ret, 'tablas' => array('Tipo de Asesoría' => $tipo));
    return $retorno;
}

/**
 * Función que devuelve todas las asesorias de todas las investigaciones asignadas a un asesor.
 * @param int $guid_asesor -> guid del asesor
 * @return array
 */
function get_asesorias_all_investigaciones($guid_asesor) {

    $investigaciones = elgg_get_all_asesorias_entities($guid_asesor, 'es_asesor_de');
    $asesorasX = array();
    $ret = array();
    $linea_T = array();
    $tipo = array();
    //recorro las investigaciones asignadas al asesor
    foreach ($investigaciones as $inv) {
        $lin = get_entity($inv->linea_tematica)->name;
        if (!array_key_exists($lin, $linea_T)) {
            $linea_T[$lin] = 0;
        }

        //obtengo las asesorias de la investigacion
        $query = array('type' => 'object', 'subtype' => 'asesoria', 'container_guid' => $inv->guid,
            'order_by_metadata' => array('name' => 'fecha', 'direction' => 'DESC'));
        $entities = elgg_get_entities_from_metadata($query);

        //recorro las asesorias asiganadas a la investigación
        foreach ($entities as $entity) {

            if (!array_key_exists($entity->tipo, $tipo)) {
                $tipo[$entity->tipo] = 0;
            }
            //preparo los datos para la tabla
            $asesorasX['nombre'] = $entity->title;
            $asesorasX['fecha'] = $entity->fecha;
            $asesorasX['hora'] = $entity->hora;
            $asesorasX['tipo'] = $entity->tipo;
            $asesorasX['observaciones'] = $entity->observaciones;
            $asesorasX['investigacion'] = $inv->name;
            $asesorasX['linea'] = $lin;


            $tipo[$entity->tipo] ++;
            array_push($ret, $asesorasX);
        }
        $linea_T[$lin] ++;
    }
    $retorno = array('lista' => $ret, 'tablas' => array('Línea Temática' => $linea_T, 'Tipo de Asesoría' => $tipo));
    return $retorno;
}

/* * *******************************************************Evaluador******************************************************************* */

function elgg_get_estadisticas_proyectos_evaluador_feria($guid_evaluador, $guid_feria) {

    $evaluador = get_entity($guid_evaluador);

    $entities = array();

    $consulta = elgg_get_relationship($evaluador, "es_evaluador_inicial_mun_de");
    $entities = array_merge($entities, $consulta);

    $consulta2 = elgg_get_relationship($evaluador, "es_evaluador_inicial_dptal_de");
    $entities = array_merge($entities, $consulta2);

    $consulta3 = elgg_get_relationship($evaluador, "es_evaluador_en_sitio_mun_de");
    $entities = array_merge($entities, $consulta3);

    $consulta4 = elgg_get_relationship($evaluador, "es_evaluador_en_sitio_dptal_de");
    $entities = array_merge($entities, $consulta4);


    $investigaciones = elgg_investigaciones_entity($entities, $guid_feria);


    $invests = array();


    foreach ($investigaciones as $entity) {


        $investigacionX = array();
        $estado = "";

        if ((check_entity_relationship($guid_evaluador, 'es_evaluador_inicial_dptal_de', $entity->guid)) || (check_entity_relationship($guid_evaluador, 'es_evaluador_inicial_mun_de', $entity->guid))) {
            $estado = "Inicialmente Evaluada";
        }

        if ($estado != "") {
            $estado.=", ";
        }
        if ((check_entity_relationship($guid_evaluador, 'es_evaluador_en_sitio_dptal_de', $entity->guid)) || (check_entity_relationship($guid_evaluador, 'es_evaluador_en_sitio_mun_de', $entity->guid))) {
            $estado.="Evaluada en sitio";
        }


        if (!array_key_exists($estado, $categoria)) {
            $categoria[$estado] = 0;
        }

        //Aparto los datos de las investigaciones para imprimir en la tabla
        $grupo = elgg_get_relationship_inversa($entity, "tiene_la_investigacion");

        if (check_entity_relationship($grupo[0]->guid, "tiene_la_investigacion", $entity->guid)) {
            // Busca la relacion del grupo con la institución  para enviar datos al formulario de registro y actualización
            $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
        }
        $investigacionX['guid'] = "$entity->guid";
        $investigacionX['nombre'] = $entity->name;
        $investigacionX['estado'] = $estado;
        $investigacionX['grupo'] = $grupo[0]->name;
        $investigacionX['colegio'] = $institucion[0]->name;
        $investigacionX['municipio'] = $institucion[0]->municipio;

        //Sumo las cantidades para estadisticas



        foreach ($invests as $r) {

            if ($r['guid'] == $investigacionX['guid']) {
                $encontrado = true;
            }
        }

        if (!$encontrado) {
            $categoria[$estado] ++;
            array_push($invests, $investigacionX);
        }
    }

    $retorno = array('lista' => $invests, 'tablas' => array('Estado' => $categoria));
    return $retorno;
}

/**
 * Función que busca todas las investigaciones de un Evaluador
 * @param int $guid del evaluador
 * @return array|VACIO 
 */
function elgg_get_estadisticas_proyectos_evaluador($guid_evaluador) {

    $entities = elgg_get_relationship(get_entity($guid_evaluador), 'es_evaluador_de');
    $investigaciones = array();
    $linea_T = array();
    $categoria = array();

    foreach ($entities as $entity) {
        $investigacionX = array();
        $lin = get_entity($entity->linea_tematica)->name;
//        if (!array_key_exists($lin, $linea_T)) {
//            $linea_T[$lin] = 0;
//        }
//        if (!array_key_exists($entity->categoria_inv, $categoria)) {
//            $categoria[$entity->categoria_inv] = 0;
//        }
        //Aparto los datos de las investigaciones para imprimir en la tabla
        $grupo = elgg_get_relationship_inversa($entity, "tiene_la_investigacion");

        if (check_entity_relationship($grupo[0]->guid, "tiene_la_investigacion", $entity->guid)) {
            // Busca la relacion del grupo con la institución  para enviar datos al formulario de registro y actualización
            $institucion = elgg_get_relationship($grupo[0], "pertenece_a");
        }
        $investigacionX['nombre'] = $entity->name;
        $investigacionX['linea'] = $lin;
        $investigacionX['categoria'] = $entity->categoria_inv;
        $investigacionX['grupo'] = $grupo[0]->name;
        $investigacionX['colegio'] = $institucion[0]->name;
        $investigacionX['municipio'] = $institucion[0]->municipio;

        //Sumo las cantidades para estadisticas
        $linea_T[$lin] ++;
        $categoria[$entity->categoria_inv] ++;
        array_push($investigaciones, $investigacionX);
    }

//    $retorno = array('lista' => $investigaciones, 'tablas' => array('Línea Temática' => $linea_T, 'Categoría' => $categoria));


    $retorno = array('lista' => $investigaciones);
    return $retorno;
}

function elgg_get_redes_por_nombre($nombre) {
    $db_prefix = get_config('dbprefix');
    $opt = array(
        'type' => 'group',
        'subtype' => 'red_tematica',
        'limit' => 0,
        'joins' => array("JOIN {$db_prefix}groups_entity ge on ge.guid = e.guid"),
        'wheres' => array("ge.name  LIKE CONCAT ('%', '$nombre' ,'%')",)
    );

    return elgg_get_entities($opt);
}
