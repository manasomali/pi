<?php
function grupo_modalidade()
{
	if(!empty($_POST['n_grupo']))
	{
		foreach($_POST['n_grupo'] as $check) 
		{
			return $check;
		}
	}
}
$grupo = grupo_modalidade();
#var_dump($grupo);


#desconto tusdd // 0 sem desconto // 1 com desconto
$check_0 = isset($_POST['desconto'][0]) ? 1 : 0;
$desconto = isset($_POST['desconto'][1]) ? 1 : 0;
#var_dump($desconto);



/**
 * Convert a comma separated file into an associated array.
 * The first row should contain the array keys.
 * 
 * Example:
 * 
 * @param string $filename Path to the CSV file
 * @param string $delimiter The separator used in the file
 * @return array
 * @link http://gist.github.com/385876
 * @author Jay Williams <http://myd3.com/>
 * @copyright Copyright (c) 2010, Jay Williams
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
function csv_to_array1($filename='upload/Consumidor.csv', $delimiter=';')
{
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
		{
			if(!$header)
				$header = array_map('trim', $row);
			else
				$data[] = array_combine($header, $row);
		}
		fclose($handle);
	}
	return $data;
}

$dados1 = csv_to_array1('upload/Consumidor.csv');

echo "<br/>";





function csv_to_array2($filename='Tarifas.csv', $delimiter=';')
{
	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	$data = array();
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
		{
			if(!$header)
				$header = array_map('trim', $row);
			else
				$data[] = array_combine($header, $row);
		}
		fclose($handle);
	}
	return $data;
}
$dados2 = csv_to_array2('Tarifas.csv');
echo "<br/>";



foreach ($dados1 as $key => $value) {
	$dados_entrada_data[]=$value['DATA'];
}
foreach ($dados2 as $key => $value) {
	$dados_tarifas_data[]=$value['DATA'];
}


$data_tarifa = array_intersect(($dados_tarifas_data),($dados_entrada_data));
$data_entrada = array_intersect(($dados_entrada_data),($dados_tarifas_data));
$initialkey_tarifa = key($data_tarifa);
$initialkey_entrada = key($data_entrada);
end($data_tarifa);
end($data_entrada);
$endkey_tarifa = key($data_tarifa);
$endkey_entrada = key($data_entrada);


#troca , por .
for ($i=0; $i < count($dados2); $i++)
{ 
	$dados2[$i] = str_replace(",",".",$dados2[$i]);
}
for ($j=0; $j < count($dados1); $j++)
{ 
	$dados1[$j] = str_replace(",",".",$dados1[$j]);
}


#separa o array multidimensional em outros
foreach ($dados1 as $key => $value) { $DCP[]=floatval($value['DCP']); }
foreach ($dados1 as $key => $value) { $DCFP[]=floatval($value['DCFP']); }
foreach ($dados1 as $key => $value) { $DMP[]=floatval($value['DMP']); }
foreach ($dados1 as $key => $value) { $DMFP[]=floatval($value['DMFP']); }
foreach ($dados1 as $key => $value) { $CP[]=floatval($value['CP']); }
foreach ($dados1 as $key => $value) { $CFP[]=floatval($value['CFP']); }

foreach ($dados2 as $key => $value) { $PIS[]=floatval($value['PIS']); }
foreach ($dados2 as $key => $value) { $COFINS[]=floatval($value['COFINS']); }

foreach ($dados2 as $key => $value) { $TUSDd_P[]=floatval($value["TUSDd_P_$grupo"]); }
foreach ($dados2 as $key => $value) { $TUSDd_FP[]=floatval($value["TUSDd_FP_$grupo"]); }
foreach ($dados2 as $key => $value) { $TUSDe_P[]=floatval($value["TUSDe_P_$grupo"]); }
foreach ($dados2 as $key => $value) { $TUSDe_FP[]=floatval($value["TUSDe_FP_$grupo"]); }
foreach ($dados2 as $key => $value) { $TE_P[]=floatval($value["TE_P_$grupo"]); }
foreach ($dados2 as $key => $value) { $TE_FP[]=floatval($value["TE_FP_$grupo"]); }




$j=$initialkey_entrada;
//verificaçao se ocorrei ultrapassagem
for ($i=$initialkey_tarifa; $i <= $endkey_tarifa; $i++) { 
	if (($DMP[$j] + $DMFP[$j]) > (($DCP[$j] + $DCFP[$j])*1.05))
	{
		$U[$j] = 1;
	} else
	{
		$U[$j] = 0;
	}
	$j++;
}





$P=1;

$ICMS=25;

$CCEE=400;
$ESS=3;
$K=3;

$j=$initialkey_entrada;
for ($i=$initialkey_tarifa; $i <= $endkey_tarifa; $i++) 
{


	if ($U[$j]==1)
	{
		$AC[$j] = (( 
			(($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))/1000 + 
			(($TUSDd_P[$i]*$DMP[$j])+($TUSDd_FP[$i]*$DMFP[$j])) + 
			(($TUSDe_P[$i]*$CP[$j])+($TUSDe_FP[$i]*$CFP[$j]))/1000 
		) 
		/ 
		(1-($PIS[$i]+$COFINS[$i]+$ICMS)/100))+((2*$TE_P[$i])*($DMP[$j] - $DCP[$j]) + (2*$TE_FP[$i])*($DMFP[$j] - $DCFP[$j]));
	}
	else if ($U[$j]==0)
	{
		$AC[$j] = ( 
			(($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))/1000 + 
			(($TUSDd_P[$i]*$DCP[$j])+($TUSDd_FP[$i]*$DCFP[$j])) + 
			(($TUSDe_P[$i]*$CP[$j])+($TUSDe_FP[$i]*$CFP[$j]))/1000 
		) 
		/ 
		(1-($PIS[$i]+$COFINS[$i]+$ICMS)/100);
	}

	$AL[$j] = ( 
		( 	((($CP[$j]+$CFP[$j])/1000*(1+$K/100))*$P)+(($TUSDd_P[$i]*$DMP[$j])+($TUSDd_FP[$i]*$DMFP[$j]))+(($TUSDe_P[$i]*$CP[$j])+($TUSDe_FP[$i]*$CFP[$j]))/1000) 
		/ 
		(1-($PIS[$i]+$COFINS[$i]+$ICMS)/100) 
	) 
	+
	$CCEE+((($CP[$j]+$CFP[$j])/1000*(1+$K/100))*$ESS);
	

	$j++;
}
#var_dump($AC);
#var_dump(array_sum($AC));
#var_dump($AL);
#var_dump(array_sum($AL));
#var_dump($U);
$i=$initialkey_tarifa;
$j=$initialkey_entrada;


while ($j <= $endkey_entrada) 
{
	if ($desconto == 1) {
		$PI[$j] =( ( (((($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))) + (($DCP[$j]*$TUSDd_P[$i]/1000)+($DCFP[$j]*$TUSDe_FP[$i]/1000)) ) *0.5 )- ((($CCEE + ((($CP[$j]+$CFP[$j]))*(1+$K/100))*$ESS))*((1-($PIS[$i]+$COFINS[$i]+$ICMS)/100))))/((($CP[$j]+$CFP[$j])*(1+$K/100)));
	}
	else {
	#if (($DMP[$j] + $DMFP[$j]) > (($DCP[$j] + $DCFP[$j])*1.05))
	#{
	#	$PI[$j] =( ((($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))/1000)+(((2*$TE_P[$i])*($DMP[$j] - $DCP[$j]) + (2*$TE_FP[$i])*($DMFP[$j] - $DCFP[$j]))*(1-($PIS[$i]+$COFINS[$i]+$ICMS)/100)) - ((($CCEE + ((($CP[$j]+$CFP[$j])/1000)*(1+$K/100))*$ESS))*((1-($PIS[$i]+$COFINS[$i]+$ICMS)/100))))/((($CP[$j]+$CFP[$j])/1000*(1+$K/100)));
	#}
	#else
	#{
		$PI[$j] =( ((($TE_P[$i]*$CP[$j])+($TE_FP[$i]*$CFP[$j]))) - ((($CCEE + ((($CP[$j]+$CFP[$j]))*(1+$K/100))*$ESS))*((1-($PIS[$i]+$COFINS[$i]+$ICMS)/100))))/((($CP[$j]+$CFP[$j])*(1+$K/100)));
	#}

	}
	$i++;
	$j++;
}

$messes = count(array_filter($PI));
$mediapi = array_sum($PI)/($messes);

#var_dump($PI);
?>

<script>
	/*                     calculo da media dinamica                  */
	var pi = [
	<?php 
	for ($i=0; $i < $endkey_entrada+1; $i++) 
	{ 
		if ($i == $endkey_entrada) {
			echo "'$PI[$i]'";
		}
		else
		{
			echo "'$PI[$i]',";

		}

	}
	?>
	]

	var periodo_total = [<?php echo "$messes"?>]
	var media_total = [<?php echo "",number_format($mediapi,2,",",".")?>]
	var steps = [
	<?php 
	for ($i=0; $i < $endkey_entrada+1; $i++) 
	{ 
		if ($i == $endkey_entrada) {
			echo "'$data_entrada[$i]'";
		}
		else
		{
			echo "'$data_entrada[$i]',";

		}

	}
	?>
	];
	$(function() {
		$("#slider").slider({
			range: true,
			min: 0,
			max: <?php echo"$endkey_entrada"?>,
			step: 1,
			values: [0, <?php echo"$messes"?> ],

			create: function( event, ui ) {
				$( "#amount" ).val(periodo_total + " Meses | "+ media_total + " R$/MWh" ); 
			},
			slide: function( event, ui ) {
				var media=0;
				var tam=0;
				var sum=0;
				for (var i = (ui.values[0]); i < (Number(ui.values[ 1 ])+Number(1)); i++) {
					/*alert(sum + " + " + pi[i]);*/
					sum = Number(sum) + Number(pi[i]);
					tam = tam + 1;
				}

				var media = sum / tam ; 
				/*alert(media+ "/" +sum+ "/"+ tam);*/

				$( "#amount" ).val(steps[ui.values[ 0 ]] + " - " + steps[ui.values[ 1 ]] + " | "+ media.toFixed(2) + " R$/MWh");
			}
		});
		/*$( "#amount" ).val("Mova o controle deslizante");*/
	} 


	);

</script>
<style>
input[type="text"] {
	border-radius: 4px;
	color: #fff;
	font-size: 18px;
	font-weight: 400;
	text-align: center;
	vertical-align: middle;
	text-transform: uppercase;
}	
</style>

<p>
	<input type="text" readonly style="text-align: center; width: 500px; border:0; color:black;" value="Período | Média">
</p><p style="margin-top: -20px;">
	<input type="text" id="amount" readonly style="text-align: center; width: 500px; border:0; color:black;">
</p>
<div id="slider" class="center" class="ui-slider-handle ui-slider" style="margin: 0 auto; width: 80%"></div>

<style>
.ui-slider .ui-slider-handle {
	width:2em;
	left:-.6em;
	background: #3366CC;
}
.ui-slider-range { background: rgba(51,102,204, 0.5); }

/*                     fim do calculo da media dinamica                  */
</style>



<?php


//Limite de ultapassagem
for ($u=0; $u < $endkey_entrada+1; $u++) 
{ 
	$LU[$u] = (($DCP[$u] + $DCFP[$u])*1.05);
}

?> 
<div id="conteudo-right">
	<?php 
	include'graph1.php';
	?> 
</div>
<?php 



for ($d=0; $d <= $endkey_entrada ; $d++) { 
	$array[$d] = array($data_entrada[$d],$PI[$d]);
}
?>


<style type="text/css" media="screen">


table#dados
{
	
	width:auto;
	border:none;
	border-collapse: collapse;
	border-spacing:0px;
	padding:0px;
	margin-top: 50px;
	display: inline;
}
table td
{
	text-align:center;
	padding: 3px;
	font-size: large;
	border-left: 1px solid #808080;
	border-right: 1px solid #808080;
	border-top: 1px solid #808080;
	border-bottom: 1px solid #808080;
	vertical-align: middle;
}

tr#titulos
{
	color:white;
	background-color:#59BD09;
	opacity:0.8;
	text-align:left;
	height:auto;
	padding:0px;
	border-left: 1px solid #808080;
	border-right: 1px solid #808080;
	border-bottom: 1px solid #808080;
	border-top: 1px solid #808080;
	vertical-align: middle;
}
td.colpi {
	text-align:center;
	padding: 5px;
	font-size: 20px;
	border-left: 1px solid #808080;
	border-right: 1px solid #808080;
	border-top: 1px solid #808080;
	border-bottom: 1px solid #808080;
	font-weight: bolder;
	vertical-align: middle;
}
div#cal {
	margin-top: -60px;
}
</style>

<div>
	<table id="dados">
		<tr id="titulos">
			<td><?php echo "DATA"; ?></td>
			<td ><?php echo "Demanda Contratada </br> na Ponta [MW]"; ?></td>
			<td ><?php echo "Demanda Contratada </br> Fora da Ponta [MW]"; ?></td>
			<!--	<td ><?php echo "Demanda Medida na Ponta [kW]"; ?></td>  -->
			<!--	<td ><?php echo "Demanda Medida Fora da Ponta [MW]"; ?></td>  -->
			<td ><?php echo "Consumo </br>na Ponta [MWh]"; ?></td>
			<td ><?php echo "Consumo </br>Fora da Ponta [MWh]"; ?></td>
			<td class="colpi"><?php echo "PI [R$/MWh]"; ?></td>
		</tr>

		<?php
		array_shift($data_entrada);
		array_shift($CP);
		array_shift($CFP);
		array_shift($PI);
		for($i=0; $i <= $endkey_entrada; $i++) 
		{
			?>
			<tr>
				<td><?php print_r ($data_entrada[$i]); ?></td>
				<td><?php print_r (number_format($DCP[$i],4,",",".")); ?></td>
				<td><?php print_r (number_format($DCFP[$i],4,",",".")); ?></td>
				<!--  <td><?php print_r ($DMP[$i]); ?></td> -->
				<!--  <td><?php print_r ($DMFP[$i]); ?></td> -->
				<td><?php print_r (number_format($CP[$i],4,",",".")); ?></td>
				<td><?php print_r (number_format($CFP[$i],4,",",".")); ?></td>
				<td><?php print_r (number_format(($PI[$i]),4,",",".")); ?></td>
			</tr>
			<?php 
		}
		?>

	</table>


</div>
