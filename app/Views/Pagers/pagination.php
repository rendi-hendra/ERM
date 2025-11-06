<?php
$links = $pager->links();
if (count($links) === 0) {
    return;
}
?>
<nav class="flex justify-center space-x-2 mt-4" aria-label="Pagination">
    <?php foreach ($links as $link): ?>
        <?php
        $uri = $link['uri'] ?? '#';
        $title = $link['title'] ?? '';
        $isActive = ! empty($link['active']);
        ?>
        <a href="<?= esc($uri) ?>"
            class="px-3 py-2 rounded-lg text-sm <?= $isActive ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' ?>">
            <?= esc($title) ?>
        </a>
    <?php endforeach; ?>
</nav>