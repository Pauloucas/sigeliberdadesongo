<?php
include_once("principal.php");

class medias{
	
	public $idNota;
	public $idEstudante;
    public $T1;
    public $T2;
    public $MT;
    public $Trab1;
    public $Trab2;
    public $MTrab;
    public $TP;
    public $M;
    public $Turma;

    function __construct($idEstudante,$id_Relacao,$Trimestre) {
        //Buscar nota
        $sql=mysql_query("SELECT * FROM tabela_notas where idEstudante='$idEstudante' AND id_Relacao_Disciplina='$id_Relacao' AND Trimestre='$Trimestre'");
        $Notas=mysql_fetch_array($sql);
        $this->idNota=$Notas['idNota'];
        $this->idEstudante=$Notas['idEstudante'];
        $this->T1=$Notas['Teste1'];
        $this->T2=$Notas['Teste2'];
        $this->Trab1=$Notas['Trabalho1'];
        $this->Trab2=$Notas['Trabalho2'];
        $this->TP=$Notas['TP'];
        $this->MT=(($this->T1+$this->T2)/2)*0.5;
        $this->MTrab=(($this->Trab1+$this->Trab2)/2)*0.3;
        $this->M= $this->MT+$this->MTrab+($this->TP*0.2);
            //Buscar turma
        $Turmasql=mysql_query("SELECT * FROM detalhes_disciplina join tabela_turma on detalhes_disciplina.idTurma=tabela_turma.idTurma where id_Relacao='$id_Relacao'");
        $Turmasql=mysql_fetch_array($Turmasql);
        $Turma=explode(' ',$Turmasql['nomeTurma']);
        $this->Turma=$Turma[0];
    }


    function Classificacao(){
		if ($this->M>=9.5) {
            if ($this->Turma==10||$this->Turma==12) {
                if ($this->M>=13.5) return "Dispensado";
                else return "Admitido";
            }
			else return "Aprovado";
		} else {
			if ($this->Turma==10||$this->Turma==12) {
                return "Excluido";
            }
            else return "Reprovado";
		}
		
	}
}