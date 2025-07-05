<?php

class Reminder {

    public function __construct() {
    }

    public function get_all_reminders() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM reminders WHERE user_id = ?;");
        $statement->execute([$_SESSION['user_id']]);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function create_reminder($user_id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO reminders (user_id, subject, created_at) VALUES (?, ?, NOW());");
        return $statement->execute([$user_id, $subject]);
    }

    public function update_reminder($id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE reminders SET subject = ? WHERE id = ?;");
        return $statement->execute([$subject, $id]);
    }

    public function delete_reminder($id) {
        $db = db_connect();
        $statement = $db->prepare("DELETE FROM reminders WHERE id = ?;");
        return $statement->execute([$id]);
    }

    // Complete reminder is the same as delete
    public function complete_reminder($id) {
        return $this->delete_reminder($id);
    }
}
