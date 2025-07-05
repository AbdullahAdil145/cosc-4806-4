<?php require_once 'app/views/templates/header.php'; ?>

<section class="reminders-section">
  <h2 class="section-heading">Reminders</h2>

  <form method="POST" action="/reminders/create" class="add-reminder-form">
    <input type="hidden" name="user_id" value="1">
    <input type="text" name="subject" placeholder="New reminder subject" required class="reminder-input">
    <button type="submit" class="add-reminder-button">Add New Reminder</button>
  </form>

  <div class="reminders-wrapper">
  <?php if (!empty($reminder)): ?>
  <?php foreach ($reminder as $reminder): ?>
        <div class="reminder-card">
          <p class="reminder-text"><?= htmlspecialchars($reminder['subject']) ?></p>
          <p class="reminder-date"><?= htmlspecialchars($reminder['created_at']) ?></p>

          <form method="POST" action="/reminders/complete/<?= $reminder['id'] ?>" class="inline-form">
            <button type="submit" class="reminder-button complete">Complete</button>
          </form>

          <form method="POST" action="/reminders/update/<?= $reminder['id'] ?>" class="inline-form">
            <input type="text" name="subject" value="<?= htmlspecialchars($reminder['subject']) ?>" required class="reminder-input">
            <button type="submit" class="reminder-button update">Update</button>
          </form>

          <form method="POST" action="/reminders/delete/<?= $reminder['id'] ?>" class="inline-form">
            <button type="submit" class="reminder-button delete">Delete</button>
          </form>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="no-reminders">No reminders found.</p>
    <?php endif; ?>
  </div>
</section>