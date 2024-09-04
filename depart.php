<?php
// Include the database configuration file
include 'connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Department (DepartmentID, DepartmentName, Description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id, $name, $description);

    // Execute the statement
    if ($stmt->execute()) {
       // echo "New department record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 2px;
            text-align: center;
        }
        .card-body {
            text-align: center;
        }
        .form-control {
            margin-top: 5px;
        }
        .card-action {
            text-align: center;
            margin-top: 20px;
        }
        textarea.form-control {
            resize: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">DEPARTMENT</div>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2 text-left">
                                        <label for="id" class="form-label">Department ID</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="id" name="id" placeholder="Enter ID" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2 text-left">
                                        <label for="name" class="form-label">Department Name</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2 text-left">
                                        <label for="description" class="form-label">Description</label>
                                    </div>
                                    <div class="col-md-4">
                                        <textarea id="description" name="description" rows="4" class="form-control" placeholder="Enter description"></textarea>
                                    </div>
                                </div>
                                
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
