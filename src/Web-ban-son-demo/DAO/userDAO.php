<?php

require_once '../models/users.php';
require_once 'BaseDAO.php';

class UserDAO extends BaseDAO {
    protected string $table = 'users';

    public function insert($model) {
        $model->password = password_hash($model->password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO {$this->table} (name, email, password, phone, address, role, is_delete)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        pdo_execute($sql,
            $model->name,
            $model->email,
            $model->password,
            $model->phone,
            $model->address,
            $model->role,
            $model->is_delete
        );
    }

    public function update($id, $model) {
        $sql = "UPDATE {$this->table} SET
                name = ?, email = ?, phone = ?, address = ?, role = ?, is_delete = ?
                WHERE id = ?";
        pdo_execute($sql,
            $model->name,
            $model->email,
            $model->phone,
            $model->address,
            $model->role,
            $model->is_delete,
            $id
        );
    }

    public function isEmailExists($email): bool {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE email = ?";
        return (int)pdo_query_value($sql, $email) > 0;
    }

    public function getUserByEmail($email): ?User {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        $row = pdo_query_one($sql, $email);
        return $row ? new User($row) : null;
    }

    public function loginUser($email, $password): ?User {
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return null;
    }
}
?>