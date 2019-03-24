<?php

namespace Api\Models;

class WorkoutPlan implements \SplSubject
{
    private $connection;

    public $id;
    public $name;
    public $days;
    public $users;

    protected $observers = [];

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

    private function createPlan()
    {
        try {
            $query = 'INSERT INTO workout_plans
                         SET plan_name = :name';
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':name', $this->name);
            return $stmt->execute();
        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }

    private function createPlanDay($day)
    {
        try {
            $query = 'INSERT INTO plan_days
                         SET plan_id  = :plan_id,
                             day_id   = :day_id,
                             week_day = :week_day';

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':plan_id',  $this->id);
            $stmt->bindParam(':day_id',   $day->id);
            $stmt->bindParam(':week_day', $day->week_day);

            return $stmt->execute();
        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }
    
    public function create()
    {
        try {
            $this->connection->beginTransaction();
            $this->createPlan();
            $this->id = $this->connection->lastInsertId();
            foreach ($this->days as $day) {
                $this->createPlanDay($day);
            }
            return $this->connection->commit();
        } catch (\PDOException $e) {
            $this->connection->rollBack();
            echo 'There is some problem : ' . $e->getMessage();
            return false;
        }
    }

    public function getAllPlans()
    {
        $query = 'SELECT * FROM workout_plans
                   ORDER BY plan_id DESC';

        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        $planRecords = [];
        if ($stmt->rowCount() > 0) {
            $planRecords["records"] = [];
            while ($record = $stmt->fetchObject()) {
                $planDetails = [
                    'id'   => $record->plan_id,
                    'name' => $record->plan_name
                ];
                array_push($planRecords["records"], $planDetails);
            }
        }
        return $planRecords;
    }

    public function getPlanDetails()
    {
        $query = 'SELECT * FROM workout_plans
                   WHERE plan_id = :id';
        $stmt  = $this->connection->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $row = $stmt->fetchObject();

        if ($row !== false) {
            $this->name = $row->plan_name;
            $this->days = $this->getWorkoutPlanDays();
            $this->users = $this->readUsers();
        }

        return $this;
    }   

    private function getWorkoutPlanDays()
    {
        $query = 'SELECT plan_days.day_id, plan_days.week_day, workout_days.day_workout 
                    FROM plan_days
                    LEFT JOIN workout_days
                      ON plan_days.day_id = workout_days.day_id
                   WHERE plan_days.plan_id = :id
                   ORDER BY plan_days.week_day ASC';

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $planDayRecords = [];
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetchObject()) {
                $planAssociation = [
                    'day_id'      => $row->day_id,
                    'week_day'    => $row->week_day,
                    'day_workout' => $row->day_workout,
                ];
                array_push($planDayRecords, $planAssociation);
            }
        }

        return $planDayRecords;
    }

    public function readUsers()
    {
        $query = 'SELECT * FROM users
                   WHERE plan_id = :id
                   ORDER BY user_id ASC';

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $userRecords = [];
        if ($stmt->rowCount() > 0) {
            while ($record = $stmt->fetchObject()) {
                $userDetails = [
                    'user_id' => $record->user_id,
                ];
                array_push($userRecords, $userDetails);
            }
        }
        
        // print_r($userRecords);die;
        return $userRecords;
    }

    public function updatePlan()
    {
        try {
            $query = 'UPDATE workout_plans
                         SET plan_name = :name
                       WHERE plan_id   = :id';

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':id',   $this->id);

            $stmt->execute();

            $result = $stmt->rowCount() === 1;
            if ($result) {
                $this->notify();
            }
            return $result;
        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }

    public function deletePlan()
    {
        try {
            $query = 'DELETE FROM workout_plans
                       WHERE plan_id = :id';
            $stmt  = $this->connection->prepare($query);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        } catch (\PDOException $e) {
            echo 'There is some problem : ' . $e->getMessage();
        }
    }

    public function attach(\SplObserver $observer)
    {
        $observerKey = spl_object_hash($observer);
        $this->observers[$observerKey] = $observer;
    }

    public function detach(\SplObserver $observer)
    {
        $observerKey = spl_object_hash($observer);
        unset($this->observers[$observerKey]);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function format()
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'days'  => $this->days,
            'users' => $this->users,
        ];
    }
}