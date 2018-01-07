<?php
/**
 * Created by PhpStorm.
 * User: lelenaic
 * Date: 07/01/18
 * Time: 20:48
 */

namespace Site4;

class Task
{
    /**
     * @var int
     */
    private $_id;
    /**
     * @var String
     */
    private $_message;
    /**
     * @var int
     */
    private $_created_at;
    /**
     * @var bool
     */
    private $_done;

    /**
     * Task constructor.
     * @param int $_id
     * @param String $_message
     * @param int $_created_at
     * @param bool $_done
     */
    public function __construct(int $_id = 0, String $_message = '', int $_created_at = 0, bool $_done = false)
    {
        $this->_id = $_id;
        $this->_message = $_message;
        $this->_created_at = $_created_at;
        $this->_done = $_done;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * @return String
     */
    public function getMessage(): String
    {
        return $this->_message;
    }

    /**
     * @param String $message
     */
    public function setMessage(String $message)
    {
        $this->_message = $message;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->_created_at;
    }

    /**
     * @param int $created_at
     */
    public function setCreatedAt(int $created_at)
    {
        $this->_created_at = $created_at;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->_done;
    }

    /**
     * @param bool $done
     */
    public function setDone(bool $done)
    {
        $this->_done = $done;
    }

    /**
     * Get a human readable timestamp
     * @return String
     */
    public function getHRTimestamp(): String
    {
        return date('d/m/Y - H:i', $this->_created_at);
    }

    /**
     * @return Task[]
     */
    public static function all(): array
    {
        $tasks = Database::query("SELECT id,message,created_at,done FROM tasks");
        $array = [];
        foreach ($tasks as $task) {
            $array[] = new Task($task['id'], $task['message'], $task['created_at'], $task['done']);
        }
        return $array;
    }

    /**
     * @return int[]
     */
    public static function getAllIds(): array
    {
        $tasks = Database::query("SELECT id,message,created_at,done FROM tasks");
        $array = [];
        foreach ($tasks as $task) {
            $array[] = $task['id'];
        }
        return $array;
    }

    public static function find(int $id): Task
    {
        $task = Database::query('SELECT id,message,created_at,done FROM tasks WHERE id=?', $id);
        if (count($task) > 0) {
            $task = $task[0];
            return new Task($task['id'], $task['message'], $task['created_at'], $task['done']);
        } else {
            return new Task;
        }
    }

    public function save(): bool
    {
        if ($this->_id == 0) {
            $saved = Database::exec('INSERT INTO tasks (message, created_at) VALUES (?, ?)', $this->_message, $this->_created_at);
            if ($saved) {
                $task = Database::query('SELECT id FROM tasks WHERE message=? AND created_at=? ORDER BY id DESC LIMIT 1', $this->_message, $this->_created_at);
                $this->_id = $task[0]['id'];
            }
            return $saved;
        } else {
            return Database::exec('UPDATE tasks SET message=?, done=? WHERE id=?', $this->_message, $this->_done, $this->_id);
        }
    }

    public function delete(): bool
    {
        if ($this->_id != 0) {
            return Database::exec('DELETE FROM tasks WHERE id=?', $this->_id);
        } else {
            return false;
        }
    }
}