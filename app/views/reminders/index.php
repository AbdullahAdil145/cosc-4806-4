<?php require_once 'app/views/templates/header.php'; ?>

<section class="reminders-section">
  <h2 class="section-heading">Reminders</h2>

  <form method="POST" action="/reminders/create" class="add-reminder-form">
    <input type="text" name="subject" placeholder="New reminder subject" required class="reminder-input">
    <button type="submit" class="add-reminder-button">Add New Reminder</button>
  </form>

  <div class="reminders-wrapper">
    <?php if (!empty($reminder)): ?>
      <?php foreach ($reminder as $reminder): ?>
        <div class="reminder-card">
          <p class="reminder-text" id="reminder-text-<?= $reminder['id'] ?>">
            <?= htmlspecialchars($reminder['subject']) ?>
          </p>
          <p class="reminder-date"><?= htmlspecialchars($reminder['created_at']) ?></p>

          <form method="POST" action="/reminders/complete/<?= $reminder['id'] ?>" class="inline-form">
            <button type="submit" class="reminder-button complete">Complete</button>
          </form>

          <button type="button" class="reminder-button update" onclick="editReminder(<?= $reminder['id'] ?>, '<?= htmlspecialchars($reminder['subject'], ENT_QUOTES) ?>')">Update</button>

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

<script>
function editReminder(id, subject) {
  const textEl = document.getElementById('reminder-text-' + id);
  textEl.innerHTML = `<input type="text" id="edit-input-${id}" value="${subject}">
    <button onclick="saveReminder(${id})">Save</button>
    <button onclick="cancelEdit(${id}, '${subject}')">Cancel</button>`;
}

function saveReminder(id) {
  const newSubject = document.getElementById('edit-input-' + id).value;

  const form = document.createElement('form');
  form.method = 'POST';
  form.action = '/reminders/update/' + id;

  const input = document.createElement('input');
  input.type = 'hidden';
  input.name = 'subject';
  input.value = newSubject;

  form.appendChild(input);
  document.body.appendChild(form);
  form.submit();
}

function cancelEdit(id, subject) {
  const textEl = document.getElementById('reminder-text-' + id);
  textEl.innerHTML = subject;
}
</script>