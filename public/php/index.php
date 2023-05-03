<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
// $servidor = "localhost"; $usuario = "victormartinez"; $contrasenia = '$mc8vK36'; $nombreBaseDatos = "victormartinez";
$servidor = "localhost"; $usuario = "root"; $contrasenia = ''; $nombreBaseDatos = "dvapp";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);

// Detalles Cliente
if (isset($_GET["detalles_cliente"])){
    $sqlClientes = mysqli_query($conexionBD,"SELECT * FROM clientes WHERE id=" . $_GET["detalles_cliente"]);
if(mysqli_num_rows($sqlClientes) > 0){
    $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($clientes);
}
else{ echo json_encode([["success"=>0]]); }
}

// Pólizas Cliente
if (isset($_GET["polizas_cliente"])){
    $sqlPolizas = mysqli_query($conexionBD,"SELECT * FROM polizas WHERE id_cliente=" . $_GET["polizas_cliente"]);
if(mysqli_num_rows($sqlPolizas) > 0){
    $polizas_cliente = mysqli_fetch_all($sqlPolizas,MYSQLI_ASSOC);
    echo json_encode($polizas_cliente);
}
else{ echo json_encode([["success"=>0]]); }
}

// Listar Clientes
if (isset($_GET["consultar_clientes"])){
    $sqlClientes = mysqli_query($conexionBD,"SELECT * FROM clientes WHERE estado = 'alta'");
if(mysqli_num_rows($sqlClientes) > 0){
    $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($clientes);
}
else{ echo json_encode([["success"=>0]]); }
}

// Listar Clientes Baja
if (isset($_GET["consultar_clientes_baja"])){
    $sqlClientes = mysqli_query($conexionBD,"SELECT * FROM clientes WHERE estado = 'baja'");
if(mysqli_num_rows($sqlClientes) > 0){
    $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($clientes);
}
else{ echo json_encode([["success"=>0]]); }
}

//restaurar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["restaurar_cliente"])){

    $id = $_GET["restaurar_cliente"]; 
    $sqlClientes = mysqli_query($conexionBD,"UPDATE clientes SET estado='alta' WHERE id='$id'");
    if($sqlClientes){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar_cliente"])){

    $id = $_GET["borrar_cliente"]; 
    $sqlClientes = mysqli_query($conexionBD,"UPDATE clientes SET estado='baja' WHERE id='$id'");
    if($sqlClientes){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

// Buscar Clientes
if (isset($_GET["buscar_clientes"])){
    $data = json_decode(file_get_contents("php://input"));
    $provincia=$data->provincia;
    $entidad=$data->entidad;


    $sqlClientes = mysqli_query($conexionBD,"SELECT * FROM clientes WHERE estado = 'alta'
        AND entidad='" . $entidad . "'" . " AND provincia='" . $provincia . "'");
if(mysqli_num_rows($sqlClientes) > 0){
    $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($clientes);
}
else{ echo json_encode([["success"=>0]]); }
}

//Inserta un nuevo cliente
if(isset($_GET["insertar_cliente"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $apellidos=$data->apellidos;
    $nombre_apellidos = $nombre . " " . $apellidos;
    $documento_identidad = $data->$documento_identidad;
    $fecha_nacimiento = $data->$fecha_nacimiento; 
    $domicilio = $data->$domicilio; 
    $localidad=$data->localidad;
    $cp=$data->cp;
    $provincia=$data->provincia;
    $provincia_nombre=$data->provincia_nombre;
    $telefono=$data->telefono;
    $email=$data->email;
    $estado=$data->estado;
    
        // if(($nombre!="")&&($apellidos!="")&&($telefono!="")&&($localidad!="")&&($cp!="")&&($provincia!="")&&($entidad!="")&&($estado!="")&&($provincia_nombre!="")){
            if(($nombre_apellidos!="")&&($telefono!="")&&($localidad!="")&&($provincia!="")&&($$documento_identidad!="")&&($email!="")){

    $sqlClientes = mysqli_query($conexionBD,"INSERT INTO clientes(nombre_apellidos,documento_identidad) 
    VALUES($nombre_apellidos','$documento_identidad') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}

//Inserta una nueva póliza
if(isset($_GET["insertar_poliza"])){
    $data = json_decode(file_get_contents("php://input"));
    $id_cliente=$data->id_cliente;
    $numero_poliza=$data->numero_poliza;
    $importe_recibo=$data->importe_recibo;
    $fecha=$data->fecha;
    $estado=$data->estado;
    $observaciones=$data->observaciones;
    
        if(($id_cliente!="")&&($numero_poliza!="")&&($importe_recibo!="")&&($fecha!="")&&($estado!="")&&($observaciones!="")){
            
    $sqlClientes = mysqli_query($conexionBD,"INSERT INTO polizas(id_cliente,numero_poliza,importe_recibo,fecha,estado,observaciones) 
    VALUES('$id_cliente','$numero_poliza','$importe_recibo','$fecha','$estado','$observaciones') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}

// SELECT PROVINCIAS
if (isset($_GET["consultar_provincias"])) {

    $sqlProvincias = mysqli_query($conexionBD, "SELECT * FROM provincias");
    if (mysqli_num_rows($sqlProvincias) > 0) {
        $provincias = mysqli_fetch_all($sqlProvincias, MYSQLI_ASSOC);
        echo json_encode($provincias);
    } else {
        echo json_encode([["success" => 0]]);
    }
}

// SELECT MUNICIPIOS
if (isset($_GET["consultar_municipio"])) {

    $sqlProvincias = mysqli_query($conexionBD, "SELECT * FROM municipios WHERE provincia=" . $_GET["consultar_municipio"]);
    if (mysqli_num_rows($sqlProvincias) > 0) {
        $provincias = mysqli_fetch_all($sqlProvincias, MYSQLI_ASSOC);
        echo json_encode($provincias);
    } else {
        echo json_encode([["success" => 0]]);
    }
}

// SELECT CLIENTES
if (isset($_GET["select_clientes"])) {

    $sqlClientes_id = mysqli_query($conexionBD, "SELECT * FROM clientes WHERE estado='alta'");
    if (mysqli_num_rows($sqlClientes_id) > 0) {
        $clientes = mysqli_fetch_all($sqlClientes_id, MYSQLI_ASSOC);
        echo json_encode($clientes);
    } else {
        echo json_encode([["success" => 0]]);
    }
}

// Actualiza clientes
if(isset($_GET["actualizar_clientes"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar_clientes"];
    $nombre=$data->nombre;
    $apellidos=$data->apellidos;
    $telefono=$data->telefono;
    $localidad=$data->localidad;
    $cp=$data->cp;
    $provincia=$data->provincia;
    $entidad=$data->entidad;
    $provincia_nombre=$data->provincia_nombre;
    
    $sqlClientes = mysqli_query($conexionBD,"UPDATE clientes SET nombre='$nombre',apellidos='$apellidos',telefono='$telefono',
    localidad='$localidad',cp='$cp',provincia='$provincia',entidad='$entidad',provincia_nombre='$provincia_nombre' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

// Consulta un Cliente concreto
if (isset($_GET["consultar"])){
    $sqlClientes = mysqli_query($conexionBD,"SELECT * FROM clientes WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlClientes) > 0){
        $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
        echo json_encode($clientes);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

// Listar Pólizas
if (isset($_GET["consultar_polizas"])){
    $sqlClientes = mysqli_query($conexionBD,"SELECT * FROM polizas WHERE deleted = 0 ORDER BY fecha DESC");
if(mysqli_num_rows($sqlClientes) > 0){
    $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($clientes);
}
else{ echo json_encode([["success"=>0]]); }
}

// Buscar Pólizas
if (isset($_GET["buscar_polizas"])){
    $data = json_decode(file_get_contents("php://input"));
    $fechaInicio=$data->fechaInicio;
    $fechaFin=$data->fechaFin;
    $seleccionado=$data->seleccionado;

    $sqlClientes = mysqli_query($conexionBD,"SELECT * FROM polizas WHERE deleted = 0 AND id_cliente=" . 
        $seleccionado . " AND fecha BETWEEN '" . $fechaInicio . "' AND '" .$fechaFin . "'");
if(mysqli_num_rows($sqlClientes) > 0){
    $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($clientes);
}
else{ echo json_encode([["success"=>0]]); }
}

// Buscar Pólizas Clientes
if (isset($_GET["buscar_polizas_clientes"])){
    $data = json_decode(file_get_contents("php://input"));
    $fechaInicio=$data->fechaInicio;
    $fechaFin=$data->fechaFin;
    $entidad=$data->entidad;
    $provincia=$data->provincia;

    $sqlClientes = mysqli_query($conexionBD,
    "SELECT p.* FROM polizas p JOIN clientes c ON p.id_cliente = c.id WHERE deleted = 0 AND fecha BETWEEN '" . $fechaInicio . "' " . "AND '" .$fechaFin . "' " . 
    "AND provincia=" . $provincia . " AND entidad='" . $entidad . "'");

if(mysqli_num_rows($sqlClientes) > 0){
    $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($clientes);
}
else{ echo json_encode([["success"=>0]]); }
}

// Buscar Nombres Clientes
if (isset($_GET["buscar_nombres"])){
    $data = json_decode(file_get_contents("php://input"));
    $idClientes=$data->idClientes;
    $consulta = "SELECT * FROM clientes WHERE ";

    for($i = 0; $i < count($idClientes); $i++){
        $consulta.=" id=" . $idClientes[$i];
        if($i < count($idClientes) - 1){
            $consulta.=" OR";
        }
    }
    //  $consulta="Select * from clientes";

    $sqlClientes = mysqli_query($conexionBD,$consulta);

    if(mysqli_num_rows($sqlClientes) > 0){
        $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
        echo json_encode($clientes);
    }
    else{ 
        echo json_encode([["success"=>0]]); 
    }
}


// Listar Pólizas Baja
if (isset($_GET["consultar_polizas_baja"])){
    $sqlClientes = mysqli_query($conexionBD,"SELECT * FROM polizas WHERE deleted = 1 ORDER BY fecha DESC");
if(mysqli_num_rows($sqlClientes) > 0){
    $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($clientes);
}
else{ echo json_encode([["success"=>0]]); }
}

//Restaurar Pólizas
if (isset($_GET["restaurar_poliza"])){

    $id = $_GET["restaurar_poliza"]; 
    $sqlClientes = mysqli_query($conexionBD,"UPDATE polizas SET deleted=0 WHERE id='$id'");
    if($sqlClientes){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

// Detalles Poliza
if (isset($_GET["detalles_poliza"])){
    $sqlClientes = mysqli_query($conexionBD,"SELECT * FROM polizas WHERE id=" . $_GET["detalles_poliza"]);
if(mysqli_num_rows($sqlClientes) > 0){
    $clientes = mysqli_fetch_all($sqlClientes,MYSQLI_ASSOC);
    echo json_encode($clientes);
}
else{ echo json_encode([["success"=>0]]); }
}

//Borrar Pólizas
if (isset($_GET["borrar_poliza"])){

    $id = $_GET["borrar_poliza"]; 
    $sqlClientes = mysqli_query($conexionBD,"UPDATE polizas SET deleted=1 WHERE id='$id'");
    if($sqlClientes){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

// Carga datos de la póliza al formulario
if (isset($_GET["consultar_poliza"])){
    $sqlPolizas = mysqli_query($conexionBD,"SELECT * FROM polizas WHERE id=".$_GET["consultar_poliza"]);
    if(mysqli_num_rows($sqlPolizas) > 0){
        $polizas = mysqli_fetch_all($sqlPolizas,MYSQLI_ASSOC);
        echo json_encode($polizas);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

// Actualiza clientes
if(isset($_GET["actualizar_polizas"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar_polizas"];
    $id_cliente=$data->id_cliente;
    $numero_poliza=$data->numero_poliza;
    $importe_recibo=$data->importe_recibo;
    $fecha=$data->fecha;
    $estado=$data->estado;
    $observaciones=$data->observaciones;
    
    $sqlClientes = mysqli_query($conexionBD,"UPDATE polizas SET id_cliente='$id_cliente',numero_poliza='$numero_poliza'
    ,importe_recibo='$importe_recibo',fecha='$fecha',estado='$estado',observaciones='$observaciones' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

?>