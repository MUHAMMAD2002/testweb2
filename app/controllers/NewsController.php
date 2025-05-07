<?php 

class NewsController
{
    use Controller;

    public function index()
    {
        $model = new News;
        $news = $model->findAll();

        $this->view("news/index", ["news" => $news]);
    }

    public function show($id = null)
    {
        $model = new News;
        $result = $model->first(["id" => $id]);
        
        $this->view("news/show", ["data" => $result]);
    }

    public function create()
    {
        $this->view("news/create");
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Validate inputs
            $title = trim($_POST["title"]);
            $description = trim($_POST["description"]);
            $content = trim($_POST["content"]);
            $date = date("Y-m-d H:i:s");

            // Handle image upload
            $imagePath = $this->handleImageUpload();

            if ($imagePath !== false) {
                // Save to database
                $model = new News;
                $success = $model->insert([
                    "title" => $title,
                    "description" => $description,
                    "text" => $content,
                    "image" => $imagePath,
                    "date" => $date,
                ]);

                redirect("news/");
            }

            $error = "Faild to create news article";
            $this->view("news/create", ["error" => $error]);
        }
    }

    protected function handleImageUpload()
    {
        if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
            return false;
        }

        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/public/assets/images/news/";

        // Create directory if it doesn't exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Get file info
        $fileTmpPath = $_FILES["image"]["tmp_name"];
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $fileType = $_FILES["image"]["type"];

        // Sanitize file name
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Generate unique file name
        if ($fileType == "image/webp") {
            $newFileName = md5(time() . $fileName) . ".jpg." . $fileExtension;
        } else {
            $newFileName = md5(time() . $fileName) . "." . $fileExtension;
        }

        // Check if file is an image
        $allowedTypes = ["image/jpg", "image/png", "image/gif", "image/webp"];
        if (!in_array($fileType, $allowedTypes)) {
            return false;
        }

        // set maximum file size (2mb)
        $maxFileSize = 2 * 1024 * 1024;
        if ($fileSize > $maxFileSize) {
            return false;
        }

        // Move the file
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            return $newFileName;
        }

        return false;
    }

    public function edit($id = null)
    {
        show($id);
    }

    public function delete($id = null)
    {
        $model = new News;
        $result = $model->delete($id);
        redirect("news");
    }
}