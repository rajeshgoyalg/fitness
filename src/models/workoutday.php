<?php

namespace Api\Models;

class WorkoutDay
{
    private $connection;
    
    public $id;
    public $name;
    public $exercises;

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

    private function createDay()
    {
        try {
            $query = 'INSERT INTO workout_days
                         SET day_workout = :name';
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':name', $this->name);
            return $stmt->execute();
        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }

    private function createDayExercise($exercise)
    {
        try {
            $query = 'INSERT INTO day_exercises
                         SET day_id         = :day_id,
                             exercise_id    = :exercise_id,
                             exercise_order = :exercise_order';

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':day_id',         $this->id);
            $stmt->bindParam(':exercise_id',    $exercise->id);
            $stmt->bindParam(':exercise_order', $exercise->exercise_order);

            return $stmt->execute();
        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }
    
    public function create()
    {
        try {
            $this->connection->beginTransaction();
            $this->createDay();
            $this->id = $this->connection->lastInsertId();
            foreach ($this->exercises as $exercise) {
                $this->createDayExercise($exercise);
            }
            return $this->connection->commit();
        } catch (\PDOException $e) {
            $this->connection->rollBack();
            echo 'There is some problem : ' . $e->getMessage();
            return false;
        }
    }

    public function getAllWorkoutDays()
    {
        $query = 'SELECT * FROM workout_days
                   ORDER BY day_workout ASC';

        $stmt  = $this->connection->prepare($query);
        $stmt->execute();

        $dayRecords = [];
        if ($stmt->rowCount() > 0) {
            $dayRecords['records'] = [];
            while ($record = $stmt->fetchObject()) {
                $dayDetails = [
                    'id'   => $record->day_id,
                    'name' => $record->day_workout
                ];
                array_push($dayRecords['records'], $dayDetails);
            }
        }
        return $dayRecords;
    }

    public function getDayExercises()
    {
        $query = 'SELECT day_exercises.exercise_id, day_exercises.exercise_order, exercises.exercise_name
                    FROM day_exercises
                    LEFT JOIN exercises 
                      ON day_exercises.exercise_id = exercises.exercise_id
                   WHERE day_exercises.day_id = :day_id
                   ORDER BY day_exercises.exercise_order ASC';

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':day_id', $this->id);
        $stmt->execute();

        $dayExerciseRecords = [];
        if ($stmt->rowCount() > 0) {
            while ($record = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                array_push($dayExerciseRecords, $record);
            }
        }
        return $dayExerciseRecords;
    }

    public function deleteDay()
    {
        try {
            $query = 'DELETE FROM workout_days
                       WHERE day_id = :id';
            $stmt  = $this->connection->prepare($query);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }
}