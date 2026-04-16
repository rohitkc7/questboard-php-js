<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class Quest
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    public function getAll(): array
    {
        $statement = $this->connection->query(
            "SELECT * FROM quests ORDER BY created_at DESC"
        );
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(array $data): bool
    {
        $statement = $this->connection->prepare(
            "INSERT INTO quests (title, description, difficulty, xp_reward)
         VALUES (:title, :description, :difficulty, :xp_reward)"
        );
        return $statement->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':difficulty' => $data['difficulty'],
            ':xp_reward' => $data['xp_reward'],
        ]);
    }
}