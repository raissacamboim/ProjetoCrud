<?php
class Noticias {
    private $conn;
    private $table_name = "noticias";

    // Construtor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar uma nova notícia
    public function registrar($titulo, $autor, $data, $noticia, $foto) {
        $query = "INSERT INTO " . $this->table_name . " (titulo, autor, data, noticia, foto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$titulo, $autor, $data, $noticia, $foto]);
        return $stmt;
    }
    
    public function lerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    // Método para listar todas as notícias
    public function ler() { 
        $query = "SELECT * FROM " . $this->table_name; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        return $stmt; 
    }

    // Método para atualizar uma notícia existente
    public function atualizar($id, $titulo, $autor, $data, $noticia, $foto) {
        // Corrigido o erro de digitação "sauteur"
        $query = "UPDATE " . $this->table_name . " SET titulo = ?, autor = ?, data = ?, noticia = ?, foto = ? WHERE id = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$titulo, $autor, $data, $noticia, $foto, $id]);
        return $stmt; 
    }

    // Método para deletar uma notícia
    public function deletar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute([$id]); 
        return $stmt; 
    }
}
?>
