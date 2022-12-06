<?php
ob_start();
	include_once("principal.php");
    include_once("medias.php");
	
?>
<?php
	if(isset($_SESSION['mensagem'])){
		echo $_SESSION['mensagem'];
		unset($_SESSION['mensagem']);
	}

?>

<div class="container-fluid">
<div class="row-fluid">
<div class="col col-lg-H col-md-H col-sm-H haggy">
<?php 
              	$i=1;
              	while ( $i<=3) {

              		$idUsuario=$_SESSION['usuarioId'];
    				$query=mysql_query("SELECT * FROM `detalhes_disciplina` INNER JOIN tabela_turma ON detalhes_disciplina.idTurma=tabela_turma.idTurma INNER JOIN professor ON professor.BI=detalhes_disciplina.id_Professor INNER JOIN tabela_estudante on tabela_turma.idTurma=tabela_estudante.idTurma where tabela_estudante.idUsuario='$idUsuario'");

              		if ( $i==1) {
              			$Trimestre='1º Trimestre';
              		}
              		if ( $i==2) {
              			$Trimestre='2º Trimestre';
              		}
              		if ( $i==3) {
              			$Trimestre='3º Trimestre';
              		}
               ?>
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
				<div class="divH"><label>Notas de Frequencia -> </label> <?php echo $Trimestre;?></div>
              </div>
			    <div class="panel-body">
				<div class="table-responsive">
                <table class="table table-condensed table-striped table-bordered table-hover">
                  <thead class="bg-primary">
                    <tr class="filters">
					<th>Disciplina</th>
					<th>Teste 1</th>	
					<th>Teste 2</th>
					<th>Media Testes</th>
					<th>Trabalho 1</th>
					<th>Trabalho 2</th>
					<th>Media Trabalhos</th>
					<th>TP</th>
					<th>Média</th>
					<th>Classificação</th>	
				  </tr>
				</thead>
				<tbody class="searchable">
			<?php 
			   $idTurma=$linhas['idTurma'];
		while($linhas=mysql_fetch_array($query)){
			$idEstudante=$linhas['numeroBI'];
			$id_Relacao=$linhas['id_Relacao'];
            $m=new medias($idEstudante,$id_Relacao,$Trimestre);
			echo "<tr>";
            echo "<td ><input type='hidden' size='2' maxlength='2' class='form-control' id='Disciplina' name='Disciplina' value='".$linhas['id_Disciplina']."'>".$linhas['id_Disciplina']."</td>";
			echo "<td>".$m->T1."</td>";
			echo "<td>".$m->T2."</td>";
			echo "<td>".$m->MT."</td>";
			echo "<td>".$m->Trab1."</td>";
            echo "<td>".$m->Trab2."</td>";
            echo "<td>".$m->MTrab."</td>";
            echo "<td>".$m->TP."</td>";
            echo "<td>".$m->M."</td>"; 
            echo "<td class='text-center'>".$m->Classificacao()."</td>";
				
			echo "</tr>";
                }

		?>

		</tbody>
	  </table>
	  </div>
	</div>
    </div>
             <?php
                	$i++;
                 }  ?>
                 <!-- <div>Media final</div> -->
	</div>
</div> <!-- /container -->

<script type="text/javascript">
	function lancar() {
		document.getElementById("form1").submit();
		
	}
</script>

<?php
	include_once("rodape.php");
    
?>