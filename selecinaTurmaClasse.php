<?php
ob_start();
	include_once("principal.php");
	
?>

<?php
	if(isset($_SESSION['mensagem'])){
		echo $_SESSION['mensagem'];
		unset($_SESSION['mensagem']);
	}
?>
<?php
                  $idUsuario=$_SESSION['usuarioId'];
                  $query=mysql_query("SELECT * FROM `detalhes_disciplina` INNER JOIN tabela_turma ON detalhes_disciplina.idTurma=tabela_turma.idTurma INNER JOIN professor ON professor.BI=detalhes_disciplina.id_Professor WHERE professor.idUsuario='$idUsuario'");
?>
<?php 
	if(isset($_POST['ok'])){
		session_start();
		$_SESSION['id_Relacao']=$_POST['id_Relacao'];
		$_SESSION['Trimestre']=$_POST['Trimestre'];

		header("Location: lancarnotas.php");
		
	}
 ?>

<div class="container-fluid">
<div class="row-fluid">
<div class="col col-lg-H col-md-H col-sm-H Diodita">
    <div class="panel panel-default panel-table">
        <div class="panel-heading" >
            
              <p>
              	
                	<div class="divH"><label>Turmas-Semestre</label></div>
                	
                
              </p> 
        </div>

			 <div class="panel-body">  
           <form name="form2" method="post" action="">
			  <div class="col-sm-4">
				
				  <select class="input sm form-control" name="id_Relacao" required="">
				  <option value="">Selecione a Disciplina e a Turma</option>
				  	<?php 
                      
                      while($linhas=mysql_fetch_array($query)){ 
                          
                         echo "<option value = '".$linhas['id_Relacao']."'>".$linhas['id_Disciplina']." Turma: ".$linhas['nomeTurma']."</option>";
                      }
                      
                      ?>
					</select>
					</div>
			  <div class="col-sm-4">
				
				  <select class="input sm form-control" name="Trimestre" required="">
				  <option value="">Selecione o Trimestre</option>
				  	<option value = "1º Trimestre">1º Trimestre</option>";
				  	<option value = "2º Trimestre">2º Trimestre</option>";
				  	<option value = "3º Trimestre">3º Trimestre</option>";
					</select>
			  </div>

			  
				   <div class="col-sm-1 col-md-1">
					<button class='btn btn-sm btn-success' name="ok" type="submit" ><span class="glyphicon glyphicon-search"></span> Buscar</button>
				   </div>
				   
				   </div>
					
				</form>
		</div>
		</div>
</div>	
</div>


<?php
	include_once("rodape.php");
    
?>