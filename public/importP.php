<?php 
define('MYSQL_HOST','localhost');
define('MYSQL_DB_NAME','mbr');
define('MYSQL_USER','root');
define('MYSQL_PASSWORD','root');

try
{
	$pdo = new PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD );
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "CSV apenas<br><hr>";

}catch(PDOException $e){
	echo $e;
}

$linhas=1;
$var = 1;
 $handle = fopen('csvfinal.csv', "r");

    while (($data = fgetcsv($handle, 1000, ';', '"')) !== FALSE) {

	        $query = "INSERT INTO tb_contatos 
	        	VALUES 
	        	(:id,
	        	:nome_do_produto,
	        	:nome_do_produtor,
	        	:documento_produtor,
	        	:nome_afiliado,
	        	:transacao, 
	        	:meio_de_pagamento, 
	        	:origem, 
	        	:moeda_1, 
	        	:preco_do_produto, 
	        	:moeda_2, 
	        	:preco_da_oferta, 
	        	:taxa_de_cambio, 
	        	:moeda_3, 
	        	:preco_original, 
	        	:numero_da_parcela, 
	        	:recorrencia, 
	        	:data_de_venda, 
	        	:data_de_confirmacao, 
	        	:status, 
	        	:nome, 
	        	:documento_usuario, 
	        	:email, 
	        	:ddd, 
	        	:telefone, 
	        	:cep, 
	        	:cidade, 
	        	:estado, 
	        	:bairro, 
	        	:pais, 
	        	:endereco, 
	        	:numero, 
	        	:complemento, 
	        	:chave, 
	        	:codigo_produto, 
	        	:codigo_afiliacao, 
	        	:codigo_oferta, 
	        	:origem_checkout, 
	        	:tipo_de_pagamento, 
	        	:periodo_gratis, 
	        	:coproducao, 
	        	:origem_comissao, 
	        	:preco_total, 
	        	:tipo_pagamento,
	        	:insercao_hotmart, 
	        	:prioridade, 
	        	:observacao, 
	        	:id_responsavel)";

	        var_dump($stmt = $pdo->prepare($query));

	        $stmt->bindValue(':id', 				$linhas++, PDO::PARAM_INT);
	     	$stmt->bindValue(':nome_do_produto', 	$data[0], PDO::PARAM_STR);
	     	$stmt->bindValue(':nome_do_produtor', 	$data[1], PDO::PARAM_STR);
	     	$stmt->bindValue(':documento_produtor', $data[2], PDO::PARAM_STR);
	     	$stmt->bindValue(':nome_afiliado', 		$data[3], PDO::PARAM_STR);
	     	$stmt->bindValue(':transacao', 			$data[4], PDO::PARAM_STR);
	     	$stmt->bindValue(':meio_de_pagamento',  $data[5], PDO::PARAM_STR);
	     	$stmt->bindValue(':origem', 			$data[6], PDO::PARAM_STR);
	     	$stmt->bindValue(':moeda_1', 			$data[7], PDO::PARAM_STR);
	     	$stmt->bindValue(':preco_do_produto',   $data[8], PDO::PARAM_STR);
	     	$stmt->bindValue(':moeda_2', 			$data[9], PDO::PARAM_STR);
	     	$stmt->bindValue(':preco_da_oferta',    $data[10], PDO::PARAM_STR);
	     	$stmt->bindValue(':taxa_de_cambio', 	$data[11], PDO::PARAM_STR);
	     	$stmt->bindValue(':moeda_3', 			$data[12], PDO::PARAM_STR);
	     	$stmt->bindValue(':preco_original', 	$data[13], PDO::PARAM_STR);
	     	$stmt->bindValue(':numero_da_parcela',  $data[14], PDO::PARAM_STR);
	     	$stmt->bindValue(':recorrencia', 		$data[15], PDO::PARAM_STR);
	     	$stmt->bindValue(':data_de_venda', 		$data[16], PDO::PARAM_STR);
	     	$stmt->bindValue(':data_de_confirmacao',$data[17], PDO::PARAM_STR);
	     	$stmt->bindValue(':status', 			$data[18], PDO::PARAM_STR);
	     	$stmt->bindValue(':nome', 				$data[19], PDO::PARAM_STR);
	     	$stmt->bindValue(':documento_usuario',  $data[20], PDO::PARAM_STR);
	     	$stmt->bindValue(':email', 				$data[21], PDO::PARAM_STR);
	     	$stmt->bindValue(':ddd', 				$data[22], PDO::PARAM_STR);
	     	$stmt->bindValue(':telefone', 			$data[23], PDO::PARAM_STR);
	     	$stmt->bindValue(':cep', 				$data[24], PDO::PARAM_STR);
	     	$stmt->bindValue(':cidade', 			$data[25], PDO::PARAM_STR);
	     	$stmt->bindValue(':estado', 			$data[26], PDO::PARAM_STR);
	     	$stmt->bindValue(':bairro', 			$data[27], PDO::PARAM_STR);
	     	$stmt->bindValue(':pais', 				$data[28], PDO::PARAM_STR);
	     	$stmt->bindValue(':endereco', 			$data[29], PDO::PARAM_STR);
	     	$stmt->bindValue(':numero', 			$data[30], PDO::PARAM_STR);
	     	$stmt->bindValue(':complemento', 		$data[31], PDO::PARAM_STR);
	     	$stmt->bindValue(':chave', 				$data[32], PDO::PARAM_STR);
	     	$stmt->bindValue(':codigo_produto', 	$data[33], PDO::PARAM_STR);
	     	$stmt->bindValue(':codigo_afiliacao', 	$data[34], PDO::PARAM_STR);
	     	$stmt->bindValue(':codigo_oferta', 		$data[35], PDO::PARAM_STR);
	     	$stmt->bindValue(':origem_checkout', 	$data[36], PDO::PARAM_STR);
	     	$stmt->bindValue(':tipo_de_pagamento', 	$data[37], PDO::PARAM_STR);
	     	$stmt->bindValue(':periodo_gratis', 	$data[38], PDO::PARAM_STR);
	     	$stmt->bindValue(':coproducao', 		$data[39], PDO::PARAM_STR);
	     	$stmt->bindValue(':origem_comissao',	$data[40], PDO::PARAM_STR);
	     	$stmt->bindValue(':preco_total', 		$data[41], PDO::PARAM_STR);
	     	$stmt->bindValue(':tipo_pagamento', 	$data[42], PDO::PARAM_STR);
	     	$stmt->bindValue(':insercao_hotmart', 	'Hotmart', PDO::PARAM_STR);
	     	$stmt->bindValue(':prioridade', 		NULL, PDO::PARAM_STR);
	     	$stmt->bindValue(':observacao', 		NULL, PDO::PARAM_STR);
	     	$stmt->bindValue(':id_responsavel', 	1, PDO::PARAM_INT);

	     	try{
	     		$stmt->execute();
	     		echo "Executou truta";
	     	}catch(PDOException $e){
	     		echo $e;
	     	}
		    
	}

	     	var_dump($data);

	     	//$stmt->debugDumpParams().'<br>';
        	
    

    fclose($handle);

/*try
{
	$pdo = new PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD );
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "foi<br><hr>";

}catch(PDOException $e){
	echo $e;
}

try{
		$fp = fopen("csvfinal.csv", "r");
		
		while( !feof($fp) ) {
		  if( !$data = fgetcsv($fp, 1000, ';', '"')) {
		     continue;
		  }
		  echo "sera?";
		  	$query = "INSERT INTO tb_contatos VALUES (".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."','".$data[18]."','".$data[19]."','".$data[20]."','".$data[21]."','".$data[22]."','".$data[23]."','".$data[24]."','".$data[25]."','".$data[25]."','".$data[26]."','".$data[27]."','".$data[28]."','".$data[29]."','".$data[30]."','".$data[31]."','".$data[32]."','".$data[33]."','".$data[34]."','".$data[35]."','".$data[36]."','".$data[37]."','".$data[38]."','".$data[39]."','".$data[40]."','".$data[41]."','".$data[42]."','NULL', '', 'NULL')";

		  	//47 cols
			
			$stmt = $pdo->query($query);
			
	}

	fclose($fp);
}catch(\PDOException $e){
	echo $e;
	echo "não vai";
}*/

?>