<?php

namespace Api\Models;

class User implements \SplObserver
{
    private $connection;
    
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $plan_id;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
			$this->$property = $value;
		}
    }
    
    public function __get($property) 
    {
		if (property_exists($this, $property)) {
			return $this->property;
		}
	}

    public function createUser()
    {
        try {
            $query = 'INSERT INTO users
                         SET first_name = :first_name,
                             last_name  = :last_name,
                             email      = :email, 
                             plan_id    = :plan_id';

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':first_name', $this->first_name);
            $stmt->bindParam(':last_name',  $this->last_name);
            $stmt->bindParam(':email',      $this->email);
            $stmt->bindParam(':plan_id',    $this->plan_id);

            return $stmt->execute();
        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }

    public function getAllUsers()
    {
        $query = 'SELECT * FROM users';
        $stmt  = $this->connection->prepare($query);
        $stmt->execute();

        $userRecords = [];
        if ($stmt->rowCount() > 0) {
            $userRecords['records'] = [];
            while ($record = $stmt->fetchObject()) {
                $userDetail = [
                    'id'         => $record->user_id,
                    'first_name' => $record->first_name,
                    'last_name'  => $record->last_name,                    
                    'email'      => $record->email,
                    'plan_id'    => $record->plan_id,
                ];
                array_push($userRecords['records'], $userDetail);
            }
        }
        return $userRecords;
    }

    public function getUserDetails()
    {
        $query = 'SELECT * FROM users
                   WHERE user_id = :id';

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $record = $stmt->fetchObject();
        if ($record) {
            $this->id         = $record->user_id;
            $this->first_name = $record->first_name;
            $this->last_name  = $record->last_name;
            $this->email      = $record->email;
            $this->plan_id    = $record->plan_id;
        }

        return $this;
    }

    public function updateUser()
    {
        try {
            $query = 'UPDATE users
                         SET first_name = :first_name,
                             last_name  = :last_name,
                             email      = :email,
                             plan_id    = :plan_id
                       WHERE 
                             user_id    = :id';

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':first_name', $this->first_name);
            $stmt->bindParam(':last_name',  $this->last_name);
            $stmt->bindParam(':email',      $this->email);
            $stmt->bindParam(':plan_id',    $this->plan_id);
            $stmt->bindParam(':id',         $this->id);

            return $stmt->execute();

        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }

    public function deleteUser()
    {
        try {
            $query = 'DELETE FROM users
                       WHERE user_id = :id';
            $stmt  = $this->connection->prepare($query);

            $stmt->bindParam(':id', $this->id);

            return $stmt->execute();

        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }

    public function update(\SplSubject $publisher)
    {
        $to      = $this->email;
        $subject = 'Workout routine changed';
        $body    = 'Changing your workout routine is critical for improving fitness and avoiding boredom.';
        $headers = 'From: noreply@fitnessapp.com';

        mail($to, $subject, $body, $headers);
    }

    public function format()
    {
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'plan_id'    => $this->plan_id,
        ];
    }
}