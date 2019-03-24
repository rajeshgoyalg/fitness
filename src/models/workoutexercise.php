<?php

namespace Api\Models;

class WorkoutExercise
{
    private $connection;
    
    public $id;
    public $name;

    public function __construct($dbHandle)
    {
        $this->connection = $dbHandle;
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

    public function createExercise()
    {
        try {
            $query = 'INSERT INTO exercises
                         SET exercise_name = :name';
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':name', $this->name);
            return $stmt->execute();
        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }

    public function getAllExercises()
    {
        $query = 'SELECT * FROM exercises
                   ORDER BY exercise_name ASC';

        $stmt  = $this->connection->prepare($query);
        $stmt->execute();

        $exerciseRecords = [];
        if ($stmt->rowCount() > 0) {
            $exerciseRecords['records'] = [];
            while ($record = $stmt->fetchObject()) {
                $exerciseDetails = [
                    'id'   => $record->exercise_id,
                    'name' => $record->exercise_name
                ];
                array_push($exerciseRecords['records'], $exerciseDetails);
            }
        }
        return $exerciseRecords;
    }

    public function deleteExercise()
    {
        try {
            $query = 'DELETE FROM exercises
                       WHERE exercise_id = :id';
            $stmt  = $this->connection->prepare($query);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }
}