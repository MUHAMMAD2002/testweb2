<?php 

Trait Model
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_column = "id";
    protected $order_type = "desc";
    protected $errors = [];

    public function findAll()
    {
        $query = "
        SELECT * FROM $this->table
        ORDER BY $this->order_column $this->order_type
        LIMIT $this->limit OFFSET $this->offset
        ";
        return $this->query($query);
    }

    public function where($data, $data_not = []) // ['id' => 3, 'title' => '..']
    {
        $keys = array_keys($data); // ['id', 'title']
        $keys_not = array_keys($data_not);

        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key." = :".$key." && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key." != :".$key." && ";
        }

        $query = rtrim($query, " && ");
        $query .= "
        ORDER BY $this->order_column $this->order_type
        LIMIT $this->limit OFFSET $this->offset
        ";

        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }

    public function first($data, $data_not = []) {
        $result = $this->where($data, $data_not);
        if ($result) {
            return $result[0];
        }
        return false;
    }

    public function insert($data)
    {
        // remove unwanted data
        if(!empty($this->allowColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (".implode(",", $keys).") VALUES (:".implode(",:", $keys).")";

        $this->query($query, $data);
        return false;
    }

    public function update($id, $data, $id_column = "id") 
    {
        // remove unwanted data
        if (!empty($this->allowColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $query .= $key." = :".$key.", ";
        }

        $query = rtrim($query, ", ");
        $query .= " WHERE $id_column = :$id_column";
        $data[$id_column] = $id;

        $this->query($query, $data);
    }

    public function delete($id, $id_column = "id")
    {
        $data[$id_column] = $id;
        $query = "
        DELETE FROM $this->table
        WHERE $id_column = :$id_column
        ";

        $this->query($query, $data);
        return false;
    }
}