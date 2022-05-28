<?php 

    class ProfessorService {

         private $conexao;
         private $professor;

         

         public function __construct(Conexao $conexao, Professor $professor) {
                $this->conexao = $conexao->conectar();
                $this->professor = $professor;   
         }


         public function inserir() {
               
               $query = 'insert into professor(nome, materia, sexo)VALUES(:nome, :materia, :sexo)';
               $stmt = $this->conexao->prepare($query);
               $stmt->bindValue(':nome', $this->professor->__get('nome'));
               $stmt->bindValue(':materia', $this->professor->__get('materia'));
               $stmt->bindValue(':sexo', $this->professor->__get('sexo'));
               $stmt->execute();
            

          
                        
         }  

         public function consultar() {
               	$query = 'select * from professor';
                $stmt = $this->conexao->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
         }

         public function filtrar() {
                     $query = 'select * from professor where materia = :materia';
                $stmt = $this->conexao->prepare($query);
                $stmt->bindValue(':materia', 'Química');
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_OBJ);
         }

         public function editar() {
                
                $query = 'update professor set materia = :materia where id = :id';
                $query2 = 'update professor set nome = :nome where id = :id';
                $query3 = 'update professor set sexo = :sexo where id = :id';

                $stmt1 = $this->conexao->prepare($query);
                $stmt1->bindValue(':materia', $this->professor->__get('materia'));
                $stmt1->bindValue(':id', $this->professor->__get('id'));

                $stmt2 = $this->conexao->prepare($query2);
                $stmt2->bindValue(':nome', $this->professor->__get('nome'));
                $stmt2->bindValue(':id', $this->professor->__get('id'));

                $stmt3 = $this->conexao->prepare($query3);
                $stmt3->bindValue(':sexo', $this->professor->__get('sexo'));
                $stmt3->bindValue(':id', $this->professor->__get('id'));
               
                $stmt1->execute();
                $stmt2->execute();
                $stmt3->execute();

         }

         public function deletar() {
                $query = 'delete from professor where id = :id';
                $stmt = $this->conexao->prepare($query);
                $stmt->bindValue(':id', $this->professor->__get('id'));
                $stmt->execute();
         }   

    }     


?>