<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuestBoard</title>
    <link rel="stylesheet" href="/questboard/public/assets/css/style.css">
</head>

<body>
    <main class="container">
        <h1>QuestBoard</h1>
        <p>Turn your goals into quests.</p>

        <h2>Create a Quest</h2>
        <?php if (!empty($success)): ?>
        <p style="color:green;">Quest Created successfully</p>
        <script>
        const cleanUrl = window.location.origin + window.location.pathname;
        window.history.replaceState({}, document.title, cleanUrl);
        </script>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form action="/questboard/public/" method="POST">
            <div>
                <label for="title">Title</label><br>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($old['title']) ?? '' ?>"
                    required>
                <?php if (!empty($errors['title'])): ?>
                <p style="color:red;"><?= htmlspecialchars($errors['title']) ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="description">Description</label><br>
                <textarea id="description"
                    name="description"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
            </div>
            <div>
                <label for=" difficulty">Difficulty</label><br>
                <select id="difficulty" name="difficulty">
                    <option value="easy" <?= ($old['difficulty'] ?? 'easy') === 'easy' ? 'selected' : '' ?>>Easy
                    </option>
                    <option value="medium" <?= ($old['difficulty'] ?? '') === 'medium' ? 'selected' : '' ?>>Medium
                    </option>
                    <option value="hard" <?= ($old['difficulty'] ?? '') === 'hard' ? 'selected' : '' ?>>Hard</option>
                </select>
            </div>

            <div>
                <label for="xp_reward">XP Reward</label><br>
                <input type="number" id="xp_reward" name="xp_reward"
                    value="<?= htmlspecialchars((string) ($old['xp_reward'] ?? 10)) ?>">
                <?php if (!empty($errors['xp_reward'])): ?>
                <p style="color:red;"><?= htmlspecialchars($errors['xp_reward']) ?></p>
                <?php endif; ?>
            </div>
            <br>
            <button type="submit">Create Quest</button>
        </form>
        <h2>Current Quests</h2>
        <?php
        if (empty($quests)) : ?>
        <p>No quests found</p>
        <?php else: ?>
        <?php foreach ($quests as $quest): ?>
        <article>
            <h3><?= htmlspecialchars($quest['title']) ?></h3>
            <p><?= htmlspecialchars($quest['description'] ?? '')  ?></p>
            <p><strong>Difficulty:</strong><?= htmlspecialchars($quest['difficulty']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($quest['status']) ?></p>
            <p><strong>XP Reward:</strong> <?= htmlspecialchars((string)$quest['xp_reward']) ?></p>
        </article>
        <form method="POST" action="/questboard/public/?delete=1" style="margin-top:10px;">
            <input type="hidden" name="id" value="<?= $quest['id'] ?>">
            <button type="submit">Delete</button>
        </form>
        <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <script src="/questboard/public/assets/js/app.js"></script>
</body>

</html>