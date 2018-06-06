<?php
    
    class Task {
        private static $allowedOrders = ['asc', 'desc'];
        private static $allowedColumns = ['description', 'is_done', 'date_added'];
        
        private $pdo;
        
        private static function checkedColumnAndOrder($columnOrder) {
            list($column, $order) = explode(' ', $columnOrder);
            
            return in_array($column, self::$allowedColumns) && in_array($order, self::$allowedOrders) ? $columnOrder : 'id asc';
        }
        
        public function __construct($pdo) {
            $this->pdo = $pdo;
            
        }
        
        public function findAllOrderBy($columnOrder)
        {
            $columnOrder = self::checkedColumnAndOrder($columnOrder);
            
            $query = "SELECT * from tasks
            ORDER BY $columnOrder;
            ";
            $prepquery = $this->pdo->prepare($query);
            $prepquery->execute();
            
            return $prepquery->fetchAll();
        }
        
        public function findTask($id)
        {
            if ($id) {
                $query = "SELECT * from tasks
                WHERE id = :id;
                ";
                $prepquery = $this->pdo->prepare($query);
                $prepquery->execute([
                    'id' => $id,
                ]);
                
                return $prepquery->fetch();
            }
            return null;
        }
        
        public function insertTask($descr)
        {
            if($descr) {
                $dt = new \Datetime();
                $dt = $dt->format('Y-m-d H:i:s');
                
                $query = "INSERT into tasks
            VALUES(null, :description, 0, :dt);
                ";
                $prepquery = $this->pdo->prepare($query);
                $prepquery->execute([
                    'description' => $descr,
                    'dt' => $dt,
                ]);
            }
        }
        
        public function completeTask($id)
        {
            if ($id) {
                $query = "UPDATE tasks
                set is_done = 1
                where id = :id;
                ";
                $prepquery = $this->pdo->prepare($query);
                $prepquery->execute([
                    'id' => $id,
                ]);
            }
        }
        
        public function deleteTask($id)
        {
            if ($id) {
                $query = "DELETE from tasks
                WHERE id = :id;
                ";
                $prepquery = $this->pdo->prepare($query);
                $prepquery->execute([
                    'id' => $id,
                ]);
            }
        }
        
        public function updateTask($id, $descr)
        {
            if ($id) {
                $query = "UPDATE tasks
                set description = :description
                where id = :id;
                ";
                $prepquery = $this->pdo->prepare($query);
                $prepquery->execute([
                    'description' => $descr,
                    'id' => $id,
                ]);
            }
        }
    }
    /**
     * Created by PhpStorm.
     * User: konstantin
     * Date: 05.06.2018
     * Time: 16:50
     */