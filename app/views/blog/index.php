<?php
/** @var array $blogs */
?>
<?php require_once 'app/views/templates/header.php'; ?>
<section class="blog-section">
  <h2 class="section-heading" style="text-align: center;">📰 Blog</h2>
  <div class="blog-wrapper">
    <?php foreach ($blogs as $post): ?>
      <div class="blog-card">
        <a href="<?= $post['link'] ?>" target="_blank" rel="noreferrer">
          <?php
            preg_match('/<img.*?src="(.*?)"/', $post['description'], $imgMatch);
            $imageUrl = $imgMatch[1] ?? '';
          ?>
          <?php if ($imageUrl): ?>
            <img src="<?= $imageUrl ?>" alt="Blog Image" class="blog-thumb" />
          <?php endif; ?>
          <div class="blog-content">
            <h3><?= $post['title'] ?></h3>
            <p class="blog-date"><?= date("n/j/Y", strtotime($post['pubDate'])) ?></p>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</section>
