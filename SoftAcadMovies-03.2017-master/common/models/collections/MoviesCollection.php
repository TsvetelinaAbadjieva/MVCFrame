<?php

class MoviesCollection extends Collection
{
    protected $table = 'movies m';
    protected $entity = 'MoviesEntity';


    public function save($data)
    {
        // TODO: Implement save() method.
    }


    public function get($where = [], $offset = -1, $limit = 5, $like = [], $order = '')
    {
        $query = "SELECT  m.*, mc.title as category_title
        FROM {$this->table}
        Left JOIN movies_categories mc ON mc.id = m.movies_categories_id
        WHERE 1 
        ";

        $where = $this->db->escape($where);

        foreach ($where as $key => $value) {
            $query.= " AND {$key} = '{$value}' ";
        }

        if (!empty($like)) {
            $query.= " AND m.{$like[0]} LIKE '%{$like[1]}%' ";
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
}

