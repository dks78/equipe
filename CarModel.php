<?php
class CarModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchAllCars(): array
    {
        $fetchCars = $this->pdo->prepare('SELECT * FROM cars');
        $fetchCars->execute();
        return $fetchCars->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filterCars(string $searchTerm): array
    {
        $result = [];

        try {
            $sql = "SELECT * FROM cars
                    WHERE name LIKE :searchTerm ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
            $stmt->execute();

            $errorInfo = $stmt->errorInfo();
            if ($errorInfo[0] !== PDO::ERR_NONE) {
                echo "Ошибка при выполнении запроса: " . $errorInfo[2];
                return $result;
            }

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }

        return $result;
    }
}

?>