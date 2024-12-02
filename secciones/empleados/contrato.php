<?php


include("../../bd.php");
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    print_r($registro);

    $primernombre=$registro["primernombre"];
    $segundonombre=$registro["segundonombre"];
    $primerapellido=$registro["primerapellido"];
    $segundoapellido=$registro["segundoapellido"];

    $nombrecompleto=$primernombre." ".$segundonombre." ".$primerapellido." ".$segundoapellido;

    $foto=$registro["foto"];
    $cv=$registro["cv"];
    $idpuesto=$registro["idpuesto"];
    $fechadeingreso=$registro["fechadeingreso"];

    $fechaInicio=new DateTime($fechadeingreso);
    $fechaFin=new DateTime(date('Y-m-d'));
    $diferencia=date_diff($fechaInicio,$fechaFin);
}
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>
</head>
<body>
    
  <header>
    <h1>Contrato laboral</h1>
    <h2>Entre [Empresa] y empleado</h2>
  </header>

  <main>

    <section>
      <h3>Datos de la empresa</h3>
      <ul>
        <li>Razón social: [Razón social]</li>
        <li>Número de identificación fiscal: [Número de identificación fiscal]</li>
        <li>Dirección: [Dirección]</li>
        <li>Teléfono: [Teléfono]</li>
        <li>Correo electrónico: [Correo electrónico]</li>
      </ul>
    </section>

    <section>
      <h3>Datos del empleado</h3>
      <ul>
        <li>Nombre y apellidos: [Nombre y apellidos]</li>
        <li>Documento de identidad: [Documento de identidad]</li>
        <li>Fecha de nacimiento: [Fecha de nacimiento]</li>
        <li>Dirección: [Dirección]</li>
        <li>Teléfono: [Teléfono]</li>
        <li>Correo electrónico: [Correo electrónico]</li>
      </ul>
    </section>

    <section>
      <h3>Condiciones laborales</h3>
      <ul>
        <li>Puesto de trabajo: [Puesto de trabajo]</li>
        <li>Fecha de inicio: [Fecha de inicio]</li>
        <li>Duración del contrato: [Duración del contrato]</li>
        <li>Jornada laboral: [Jornada laboral]</li>
        <li>Salario: [Salario]</li>
        <li>Vacaciones: [Vacaciones]</li>
        <li>Incapacidad temporal: [Incapacidad temporal]</li>
        <li>Cesantía: [Cesantía]</li>
      </ul>
    </section

  </main>

  <footer>
    <p>Este contrato se firma en [lugar] a [fecha].</p>
    <p>[Firma de la empresa]<br>
    [Firma del empleado]</p>
  </footer>

    
</body>
</html>

<?php
$HTML=ob_get_clean();
require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf=new Dompdf();
$opciones=$dompdf->getOptions();
$opciones->set(array("isRemoteEnabled"=>true));
$dompdf->setOptions($opciones);
$dompdf->loadHtml($HTML);
$dompdf->setPaper('letter');
$dompdf->render();



  $dompdf->stream("archivo.pdf", array("Attachment" => false));

?>

<?php echo $nombrecompleto;?>