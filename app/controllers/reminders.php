<?php

class Reminders extends Controller {
    public function index() {
        $reminder = $this->model('Reminder');
        $data = get_all_reminders->test();
        $this->view('reminders/index');
    }
}