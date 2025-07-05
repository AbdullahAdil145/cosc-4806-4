<?php

class Reminders extends Controller {

    public function index() {
        $reminder = $this->model('Reminder');
        $list_of_reminders = $reminder->get_all_reminders();
        $this->view('reminders/index', ['reminders' => $list_of_reminders]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reminder = $this->model('Reminder');
            $user_id = $_POST['user_id'] ?? null;
            $subject = $_POST['subject'] ?? '';

            if ($user_id && $subject) {
                $reminder->create_reminder($user_id, $subject);
                header("Location: /reminders/index");
                exit;
            }
        }
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reminder = $this->model('Reminder');
            $subject = $_POST['subject'] ?? '';

            if ($subject) {
                $reminder->update_reminder($id, $subject);
                header("Location: /reminders/index");
                exit;
            }
        }
    }

    public function delete($id) {
        $reminder = $this->model('Reminder');
        $reminder->delete_reminder($id);
        header("Location: /reminders/index");
        exit;
    }

    public function complete($id) {
        $this->delete($id);
    }
}
