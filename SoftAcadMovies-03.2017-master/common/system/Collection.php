<?php

abstract class Collection {

    protected $entity = 'Entity';
    protected $table  = 'Table';
    protected $db;

    abstract public function save($data);

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getOne($where = [])
    {
        $query = "SELECT * FROM {$this->table}
        WHERE 1
        ";

        $where = $this->db->escape($where);

        foreach ($where as $key => $value) {
            $query.= " AND {$key} = '{$value}' ";
        }

        $query.= "
            LIMIT 1
        ";

        $result = $this->db->query($query);

        if (!$result) {
            $this->db->error();
        }

        $row = $this->db->translate($result);
        $entity = new $this->entity();

        return $entity->init($row);;
    }

    public function get($where = [], $offset = -1, $limit = 5, $like = [], $order = '')
    {
        $query = "SELECT * FROM {$this->table}
        WHERE 1 
        ";

        $where = $this->db->escape($where);

        foreach ($where as $key => $value) {
            $query.= " AND {$key} = '{$value}' ";
        }

        if (!empty($like)) {
            $query.= " AND {$like[0]} LIKE '%{$like[1]}%' ";
        }

        if ($order != '') {
            $query .= " ORDER BY  '{$order}' ";
        }

        if ($offset >= 0) {
            $query .= " LIMIT {$offset}, {$limit} ";
        }


        $result = $this->db->query($query);

        if (!$result) {
            $this->db->error();
        }

        $rows = [];
        while ($row = $this->db->translate($result)) {
            $entity = new $this->entity();
            $entity->init($row);
            $rows[] = $entity;
        }


        return $rows;
    }

    public function insert($data)
    {
        $query = "INSERT INTO {$this->table} SET";

        $data = $this->db->escape($data);
        $i = 0;
        foreach ($data as $key => $value) {
            ++$i;
            if ($i == count($data)) {
                $query.= " {$key} = '{$value}'  ";
            } else {
                $query.= " {$key} = '{$value}',  ";
            }
        }

        $result =  $this->db->query($query);

        if (!$result) {
            $this->db->error();
        }

        return $this->db->affected_rows();
    }


    public function update($data, $where = [])
    {
        $query = "UPDATE {$this->table} SET";

        $data = $this->db->escape($data);
        $where = $this->db->escape($where);
        $i = 0;
        foreach ($data as $key => $value) {
            ++$i;
            if ($i == count($data)) {
                $query.= " {$key} = '{$value}'  ";
            } else {
                $query.= " {$key} = '{$value}',  ";
            }
        }
        $query .= " WHERE 1 ";
        foreach ($where as $key => $value) {
            $query .= " AND {$key} = '{$value}' ";
        }

        $result = $this->db->query($query);

        if (!$result) {
            $this->db->error();
        }

        return $this->db->affected_rows();
    }

    public function delete($where = [])
    {
        $query = "DELETE FROM {$this->table} WHERE 1";

        $where = $this->db->escape($where);
        foreach ($where as $key => $value) {
            $query.= " AND {$key} = '{$value}'";
        }

        $result = $this->db->query($query);
        if (!$result) {
            $this->db->error();
        }

        return $this->db->affected_rows();
    }



}