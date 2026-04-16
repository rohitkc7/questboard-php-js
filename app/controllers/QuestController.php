<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Quest;

class QuestController
{
    private Quest $questModel;

    public function __construct(Quest $questModel)
    {
        $this->questModel = $questModel;
    }

    public function index(array $data = []): void
    {
        $quests = $this->questModel->getAll();

        $errors = $data['errors'] ?? [];
        $success = $data['success'] ?? false;
        $old = $data['old'] ?? [
            'title' => '',
            'description' => '',
            'difficulty' => 'easy',
            'xp_reward' => 10,
        ];

        require __DIR__ . '/../views/home.php';
    }

    public function store(array $postData): void
    {
        $title = trim($postData['title'] ?? '');
        $description = trim($postData['description'] ?? '');
        $difficulty = $postData['difficulty'] ?? 'easy';
        $xpReward = (int) ($postData['xp_reward'] ?? 10);

        $old = [
            'title' => $title,
            'description' => $description,
            'difficulty' => $difficulty,
            'xp_reward' => $xpReward,
        ];

        $errors = $this->validate($postData);

        if (!empty($errors)) {
            $this->index([
                'errors' => $errors,
                'old' => $old,
            ]);
            return;
        }

        $this->questModel->create([
            'title' => $title,
            'description' => $description,
            'difficulty' => $difficulty,
            'xp_reward' => $xpReward,
        ]);

        header('Location: /questboard/public/?success=1');
        exit;
    }

    private function validate(array $postData): array
    {
        $errors = [];

        $title = trim($postData['title'] ?? '');
        $xpReward = (int) ($postData['xp_reward'] ?? 10);

        if ($title === '') {
            $errors['title'] = 'Title is required';
        }

        if ($xpReward <= 0) {
            $errors['xp_reward'] = 'XP must be greater than 0';
        }

        return $errors;
    }
}