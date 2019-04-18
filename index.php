<?php

// linea
# linea


// VARIABLES

/* 
$nombre = 'Juan';
$apellido = 'Lopez';
$edad = 24;
$salario = 100.50;
$activo = true;


echo "Su nombre es {$nombre} y su apellido es {$apellido}";

*/

// VARIABLES GLOBALES
/*
$_SERVER
$_POST
$_GET
$_SESSION

echo '<pre>';
print_r($_GET);
echo '</pre>';
*/

$arreglo = ['Juan','Maria','Pedro'];
$arreglo_acs = [
    'nombre'=>'Juan',
    'apellido'=>'Lopez',
    'salarios'=>[200,300,500]
    ];
/*
echo '<pre>';
print_r($arreglo);
echo '</pre>';
echo $arreglo[1];
echo '<pre>';
print_r($arreglo_acs);
echo '</pre>';
echo $arreglo_acs['apellido'];
echo $arreglo_acs['salarios'][2];
*/

/*
$fecha = '30-12-2019';
echo $fecha;

$fecha_arr = explode('-',$fecha);
echo '<pre>';
print_r($fecha_arr);
echo '</pre>';
$fecha_sql = "{$fecha_arr[2]}-{$fecha_arr[1]}-{$fecha_arr[0]}";
echo $fecha_sql;
*/

// FUNCIONES 

/*
function suma($a,$b){
    return $a+$b;
}

function suma_array(array $arr){
    return $arr[0]+$arr[1]+$arr[2];
}

echo suma(7,4);
echo '<br>';
echo suma_array([4,5,8]);
*/

// ESTRUCTURA DE CONTROL Y BUCLES

$num1 = 1;
$num2 = 2;


function print_pre(array $arr){
    echo '<pre>';
        print_r($arr);
    echo '</pre>';
}



// == comparar igual valor
// === identicos en valor y tipo
// != diferente en valor
// !== diferente en valor y tipo

// && o AND 
// || o OR
/*
if($num1 == 1 && $num2 == 2){
    echo 'Son iguales';
}else{
    echo 'No son iguales';
}
*/
/*
$nombre = 'Juan';

if($nombre == 'Pedro'){
    echo 'Es pedro';
}elseif($nombre == 'Juan'){
    echo 'Es juan';
}else{
    echo 'Es su madre';
}

switch($nombre){
    case 'Pedro':
    echo 'Es pedro';
    break; 
    case 'Juan':
    echo 'Es Juan';
    break;
    default:
    echo 'Es su madre';
    break;
}

*/

/*
$arr = ['Juan','Pedro','Maria','Jose','Luis','Milagros','Junior'];

$i = 0;
while($i < count($arr)){
    echo $arr[$i].'<br>';
    if($i == 3){
        break;
    }
    $i++;    
}


echo '<br>';


for($i=0;$i < count($arr);$i++){
    echo $arr[$i].'<br>';
}
*/
/*
$user = ['nombre'=>'Juan','apellido'=>'Perez','edad'=>32];

foreach($user as $value){
    echo $value.'<br>';
}


$users = [
    ['nombre'=>'Juan','apellido'=>'Perez','edad'=>32],
    ['nombre'=>'Pedro','apellido'=>'Garcia','edad'=>22]
];


print_pre($users);

foreach ($users as $key => $value) {
    echo $value['nombre'].'<br>';
    echo $value['apellido'].'<br>';
}

*/


// CONEXION 

//print_r(PDO::getAvailableDrivers());

//phpinfo();






//$SERVER_NAME = "laptop\sqlexpress";
$SERVER_NAME = "dbserver";
$DATABASE="facfoxsql";
$DB_USER="sa";
$DB_PASSWORD='pr0i$$a';
try
{
  $conn = new PDO("sqlsrv:server=$SERVER_NAME;DATABASE=$DATABASE",$DB_USER,$DB_PASSWORD);
  $conn->query("SET NAMES latin1");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );   
  
  
//   // Ejemplo de insert con marcadores anonimos
//   $insert = $conn->prepare("INSERT INTO CCBDVEND (ve_codigo,ve_nombre,ve_comven,ve_comcob,ve_direc) VALUES (?,?,?,?,?)");

//   $codigo = 'CDP12';
//   $nombre = 'Dionicio';
//   $comision_venta = 10;
//   $comision_cobro = 5;
//   $direccion = 'Santiago';

//   $insert->bindParam(1,$codigo);
//   $insert->bindParam(2,$nombre);
//   $insert->bindParam(3,$comision_venta);
//   $insert->bindParam(4,$comision_cobro);
//   $insert->bindParam(5,$direccion);

//   $insert->execute();

// Ejemplo de insert con marcadores conicidos
$insert = $conn->prepare("INSERT INTO CCBDVEND (ve_codigo,ve_nombre,ve_comven,ve_comcob,ve_direc) VALUES (:codigo,:nombre,:comv,:comc,:direccion)");

$codigo = 'CDP14';
$nombre = 'Fransisco';
$comision_venta = 10;
$comision_cobro = 5;
$direccion = 'Santiago';

$insert->bindParam(':codigo',$codigo);
$insert->bindParam(':nombre',$nombre);
$insert->bindParam(':comv',$comision_venta);
$insert->bindParam(':comc',$comision_cobro);
$insert->bindParam(':direccion',$direccion);

//$insert->execute();

// if($insert->rowCount() > 0){
//     echo "El codigo {$codigo} se inserto correctamente";
// }else{
//     echo 'Error al insertar';
// }

// Ejemplo de Update

$update = $conn->prepare("UPDATE CCBDVEND SET ve_nombre = :nombre WHERE ve_codigo = :codigo");

$nombre_up = 'Juan';
$codigo_up = 'CDP14';

$update->bindParam(':nombre',$nombre_up);
$update->bindParam(':codigo',$codigo_up);

//$update->execute();

// if($update->rowCount() > 0){
//     echo "El codigo {$codigo_up} se actualizo correctamente";
// }else{
//     echo 'Error al actualizar';
// }

// Ejemplo de Delete
$delete = $conn->prepare("DELETE TOP (1) FROM CCBDVEND WHERE ve_codigo = :codigo AND ve_id = :id");

$codigo_del = '1018';
$id_del = 34;

$delete->bindParam(':codigo',$codigo_del);
$delete->bindParam(':id',$id_del,PDO::PARAM_INT);
//$delete->execute();

// if($delete->rowCount() > 0){
//     echo "El codigo {$codigo_del} se elimino correctamente";
// }else{
//     echo 'Error al eliminar';
// }

//CCBDCLIE

  $query = $conn->query("SELECT TOP 10 CL_CODIGO,CL_NOMBRE,CL_DIREC1,CL_TELEF1,ZO_CODIGO,CL_LIMCRE FROM CCBDCLIE");
  $res = $query->fetchAll(PDO::FETCH_ASSOC);

  //print_pre($res);

  foreach ($res as $key => $value) {
      echo $value['CL_CODIGO'].' ';
      echo  substr($value['CL_NOMBRE'],0,10).' ';
      echo $value['ZO_CODIGO'].' ';
      echo number_format($value['CL_LIMCRE'],2);
      echo '<br>';
  }

}catch(PDOException $e){
  echo $e->getMessage();
  die();
}

/*

$host='laptop\\sqlexpress';
//$host='localhost:1435';
$dbname='facfoxsql';
$user='sa';
$pass='pr0i$$a';

try {
  # MS SQL Server ySybase con PDO_DBLIB
  $pdo = new PDO("sqlsrv:Server=$host;Database=$dbname, $user, $pass");
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
    echo $e->getMessage();
}
*/

?>