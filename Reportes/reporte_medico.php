<?php 
if (!empty($_POST))
{
        $con=mysqli_connect("localhost","root","","paula");
        if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
}

#$medico=$_POST['medico'];
$medico = trim($_POST['medico']);
#$fecha=$_POST['fecha'];
$fecha= date("d-m-Y");
#$nuevafecha = date("d-m-Y", strtotime($fecha));
$result = mysqli_query($con,"SELECT * FROM historial where Atendedor like '%$medico%' and Fecha like '%$fecha%' ORDER BY Fecha ASC");
/*echo "<h2 align='center'>PLANILLA DE RENDICION DE EFECTIVO</h2><br>";

echo "<h3>Seguros a Cobrar</h3>";
echo "<font size='2'>";
echo "<table width='800' border='1'>
<tr>
<th>Item</th>
<th>Fecha</th>
<th>Nombre</th>
<th>Cedula</th>
<th>Estudio</th>
<th>Doctor</th>
<th>Seguro</th>
<th>Monto</th>
<th>MontoSeguros</th>
<th>Descuento</th>
<th>Comentario</th>
</tr>";
$i=0;
while($row = mysqli_fetch_array($result))
{
        #if ($row['Seguro'] == "SEMEI" or $row['Seguro'] == "Seguros")
        if ($row['Seguro'] !== " " and $row['Seguro'] !== "Preferencial"  and $row['Seguro'] !== "Hospitalar")
        {
        $i++;
        $resultado = mysqli_query($con,'select clientes.Nombre,clientes.Apellido from clientes INNER join historial on clientes.Cedula = historial.Cedula where clientes.Cedula="'.$row['Ced$
        echo "<tr>";
        echo "<td><font size='2'>" . $i . "</td>";
        echo "<td><font size='2'>" . $row['Fecha'] . "</td>";
 while($fila = mysqli_fetch_array($resultado))
        {
        echo "<td><font size='2'>" . $fila['Nombre'] . " " . $fila['Apellido']. "</td>";
        }
        echo "<td><font size='2'>" . $row['Cedula'] . "</td>";
        echo "<td><font size='2'>" . $row['Estudio'] . "</font></td>";
        echo "<td><font size='2'>" . $row['Atendedor'] . "</td>";
        echo "<td><font size='2'>" . $row['Seguro'] . "</td>";
        echo "<td><font size='2'>" . $row['Monto'] . "</td>";
        echo "<td><font size='2'>" . $row['MontoS'] . "</td>";
        echo "<td><font size='2'>" . $row['Descuento'] . "</td>";
        echo "<td><font size='2'>" . $row['ID'] . "</td>";
        echo "<td><font size='2'>" . $row['Comentario'] . "</td>";
        echo "</tr>";
        $total=$total+$row['Monto'];
        $descuento=$descuento+$row['Descuento'];
        }
}
$total= number_format($total, 3, '.', '.');
$descuento= number_format($descuento, 3, '.', '.');
echo "<tr>";
echo "<td colspan=7><font size='2'><b><i>Total General</td>";
echo "<td><font size='2'><b><i>$total</td>";
echo "<td><b><i>$descuento</td>";
echo "</table>";
echo "</font>";

echo "<br><hr><br>";

*/

$total=0;
$descuento=0;
echo "<h3>Efectivo a rendir</h3>";

echo "<table border='1'>
<tr>
<th>Item</th>
<th>Fecha</th>
<th>Nombre</th>
<th>Cedula</th>
<th>Estudio</th>
<th>Doctor</th>
<th>Seguro</th>
<th>Monto</th>
<th>MontoSeguros</th>
<th>Descuento</th>
<th>ID</th>
<th>Comentario</th>
</tr>";
$a=0;
$result2 = mysqli_query($con,"SELECT * FROM historial where Atendedor like '%$medico%' and Fecha like '%$fecha%' ORDER BY Fecha ASC");
while($row = mysqli_fetch_array($result2))
{
#       if ($row['Seguro'] != "SEMEI" and $row['Seguro'] != "Seguros")
  #      if ($row['Seguro'] == " " or strpos($row['Seguro'], 'Preferencial' ) !== false or strpos($row['Seguro'], 'Hospitalar' ) !== false)
#       {
        $a++;
        $resultado = mysqli_query($con,'select clientes.Nombre,clientes.Apellido from clientes INNER join historial on clientes.Cedula = historial.Cedula where clientes.Cedula="'.$row['Cedula'].'" limit 1');
        echo "<tr>";
        echo "<td><font size='2'>" . $a . "</td>";
        echo "<td><font size='2'>" . $row['Fecha'] . "</td>";
        while($fila = mysqli_fetch_array($resultado))
        {
        echo "<td><font size='2'>" . $fila['Nombre'] . " " . $fila['Apellido']. "</td>";
        }
        echo "<td><font size='2'>" . $row['Cedula'] . "</td>";
        echo "<td><font size='2'>" . $row['Estudio'] . "</td>";
        echo "<td><font size='2'>" . $row['Atendedor'] . "</td>";
        echo "<td><font size='2'>" . $row['Monto'] . "</td>";
        echo "<td><font size='2'>" . $row['MontoS'] . "</td>";
        echo "<td><font size='2'>" . $row['Descuento'] . "</td>";
        echo "<td><font size='2'>" . $row['ID'] . "</td>";
        echo "<td><font size='2'>" . $row['Comentario'] . "</td>";
        echo "</tr>";
        $total=$total+$row['Monto'];
        $totals=$totals+$row['MontoS'];
        $descuento=$descuento+$row['Descuento'];
 #       }
}
$total= number_format($total, 3, '.', '.');
$totals= number_format($totals, 3, '.', '.');
$descuento= number_format($descuento, 3, '.', '.');
echo "<tr>";
echo "<td colspan=7><font size='2'><b><i>Total General</td>";
echo "<td><font size='2'><b><i>$total</td>";
echo "<td><font size='2'><b><i>$totals</td>";
echo "<td><font size='2'><b><i>$descuento</td>";
echo "</table>";

echo "<h3>Resumen de Estudios</h3>";


echo "<table border='1'>
<tr>
<th>Estudio</th>
<th>Cantidad</th>
</tr>";
$result3 = mysqli_query($con,"select Monto,Descuento,Estudio,count(*) as micontador from historial where Atendedor like '%$medico%' and Fecha like '%$fecha%' group BY Estudio");
$rtotal=0;
while($row = mysqli_fetch_array($result3))
{
$multiplicacion=$row['Monto']*$row['micontador'];
        echo "<tr>";
        echo "<td><font size='2'>" . $row['Estudio'] . "</td>";
        echo "<td><font size='2'>" . $row['micontador'] . "</td>";
       # echo "<td><font size='2'>" . $row['Monto'] . "</td>";
       # echo "<td><font size='2'>" . number_format($row['Monto']*$row['micontador'], 3, '.', '.') . "</td>";
        echo "</tr>";
        $rtotal=$rtotal+$multiplicacion ;
}
$rtotal= number_format($rtotal, 3, '.', '.');
mysqli_close($con);
?>