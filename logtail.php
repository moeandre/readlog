<?php
if($_POST['logname']){
	$logs = array(
		'novo-batch'=>'Novo_batch.log',
		'novo-prd' => 'Novo_prod.log',
	);

	$name = $logs[$_POST['logname']];
	$cmd = "tail -10 /home/loja1001/log/".$name;
	exec("$cmd 2>&1", $output);
	foreach($output as $outputline) {
		echo ("$outputline\n");
	}
}
?>