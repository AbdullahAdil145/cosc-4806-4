<? require_once 'app/views/templates/header.php';
 ?>
<section class="reminders-section">
  <h2 class="section-heading" style="text-align: center;">Reminders</h2>
  <button class="add-reminder-button">Add New Reminder</button>
  <div class="reminders-wrapper">
    <div class="reminder-card">
      <p>This is a reminder.</p>
      <p class="reminder-date">12/12/2023</p>
      <button class="reminder-button">Complete</button>
      <button class="reminder-button">Update</button>
      <button class="reminder-button">Delete</button>
      </div>

    <?php 
    print_r($data['reminders'])
    ?>
   
<?php require_once 'app/views/templates/footer.php'?>
