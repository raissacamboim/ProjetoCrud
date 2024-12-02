<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";


    public function __construct($db) {
        $this->conn = $db;
    }
    public function registrar($nome, $sexo, $fone, $email, $senha) {
        $query = "INSERT INTO " . $this->table_name . " (nome, sexo, fone, email, senha) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($senha, PASSWORD_BCRYPT);
        $stmt->execute([$nome, $sexo, $fone, $email, $hashed_password]);
        return $stmt;
    }


    public function login($email, $senha) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }
  

    public function ler() { 
        $query = "SELECT * FROM " . $this->table_name; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    } 
    public function lerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function atualizar($id, $nome, $sexo, $fone, $email) {
        $query = "UPDATE " . $this->table_name . " SET nome = ?, sexo = ?, fone = ?, email = ? WHERE id = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $sexo, $fone, $email, $id]);
        return $stmt; 
    }


    public function deletar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute([$id]); 
        return $stmt; 
    }

    public function listarTodos(){
        $sql = "select * from usuarios";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;//->fetchAll(PDO::FETCH_ASSOC); 
    }

        // Método para buscar uma notícia por ID
        public function buscarPorId($id) {
            // Consulta SQL para buscar os dados da notícia
            $query = "SELECT * FROM noticias WHERE id = :id";
    
            // Prepara a consulta
            $stmt = $this->conn->prepare($query);
    
            // Associa o valor do ID ao parâmetro
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            // Executa a consulta
            $stmt->execute();
    
            // Usa fetchAll para pegar todos os resultados (apesar de esperar só um)
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Verifica se o array de resultados está vazio
            if (!empty($resultados)) {
                // Retorna o primeiro resultado, pois esperamos um único
                return $resultados[0]; 
            } else {
                // Se não encontrar, retorna falso
                return false;
            }
        }
}
?>
