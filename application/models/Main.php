<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function getTasks($order, $direction, $page, $countOnPage)
    {
        $offset = $page * $countOnPage;

        $result['tasks'] = $this->db->row(
            "SELECT SQL_CALC_FOUND_ROWS `id`,
                    `name`,
                    `email`,
                    `task_text`,
                    CASE WHEN `done` = 1
                         THEN 'checked'
                         ELSE ''
                    END `checked`,
                    CASE WHEN `edited` = 1
                         THEN ' | Отредактировано администратором'
                         ELSE ''
                    END `edited`
               FROM `tasks`
              ORDER BY {$order} {$direction}
              LIMIT {$offset}, {$countOnPage}"
        );

        $totalPages = $this->db->row('SELECT FOUND_ROWS() as `total`');
        $result['totalPages'] = $totalPages[0]['total'];

        return $result;
    }

    public function newTask($name, $email, $task_text)
    {
        $result = $this->db->query(
            "INSERT INTO `tasks` (`name`, `email`, `task_text`)
                  VALUES (:name, :email, :task_text)",
            [
                'name' => $name,
                'email' => $email,
                'task_text' => $task_text,
            ]
        );

        return $result;
    }

    public function changeStatus($task, $task_text, $status)
    {
        $taskData = $this->db->row(
            "SELECT `task_text`,
                    `edited`
               FROM `tasks`
              WHERE `id` = :id",
            [
                'id' => $task
            ]
        );

        $edited = $taskData[0]['edited'];
        if ($edited === 0 && $taskData[0]['task_text'] !== htmlspecialchars($task_text)) {
            $edited = 1;
        }
        $this->db->query(
            "UPDATE `tasks`
                SET `done` = :done,
                    `task_text` = :task_text,
                    `edited` = :edited
              WHERE `id` = :task",
            [
                'done' => $status,
                'task_text' => $task_text,
                'task' => $task,
                'edited' => $edited,
            ]
        );
    }
}
