<?php 

class News
{
    use Model;

    protected $table = "news";
    protected $allowedColumns = [
        "title",
        "description",
        "text",
        "image",
        "date"
    ];

    public function validate($data)
    {
        $this->errors = [];

        if (empty($data["title"]))  {
            $this->errors["title"] = "Title is required";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
}