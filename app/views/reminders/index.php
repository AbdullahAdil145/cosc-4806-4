    <?php require_once 'app/views/templates/header.php'; ?>

    <section class="reminders-section">
      <h2 class="section-heading" style="text-align: center;">Reminders</h2>

      <!-- Add new reminder form -->
      <form method="POST" action="/reminders/create" style="text-align: center; margin-bottom: 20px;">
        <input type="hidden" name="user_id" value="1"> <!-- Replace with actual logged-in user ID -->
        <input type="text" name="subject" placeholder="New reminder subject" required>
        <button type="submit" class="add-reminder-button">Add New Reminder</button>
      </form>

      <div class="reminders-wrapper">
        <?php if (!empty($data['reminders'])): ?>
          <?php foreach ($data['reminders'] as $reminder): ?>
            <div class="reminder-card">
              <p><?= htmlspecialchars($reminder['subject']) ?></p>
              <p class="reminder-date"><?= htmlspecialchars($reminder['created_at']) ?></p>

              <!-- Complete button -->
              <form method="POST" action="/reminders/complete/<?= $reminder['id'] ?>" style="display: inline;">
                <button type="submit" class="reminder-button">Complete</button>
              </form>

              <!-- Update form -->
              <form method="POST" action="/reminders/update/<?= $reminder['id'] ?>" style="display: inline;">
                <input type="text" name="subject" value="<?= htmlspecialchars($reminder['subject']) ?>" required>
                <button type="submit" class="reminder-button">Update</button>
              </form>

              <!-- Delete button -->
              <form method="POST" action="/reminders/delete/<?= $reminder['id'] ?>" style="display: inline;">
                <button type="submit" class="reminder-button">Delete</button>
              </form>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="text-align: center;">No reminders found.</p>
        <?php endif; ?>
      </div>
    </section>

    <?php require_once 'app/views/templates/footer.php'; ?>
