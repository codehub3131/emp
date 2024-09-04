<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 40px auto;
        }
        .attendance-form label {
            font-weight: bold;
        }
        .attendance-form button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .attendance-form button:hover {
            background-color: #45a049;
        }
        #main{

            margin-top: 20px;

        }
    </style>
    <script>
        function calculateOvertimeAndStatus() {
            const checkInTime = document.getElementById('checkIn').value;
            const checkOutTime = document.getElementById('checkOut').value;

            // Convert times to minutes
            const [checkInHours, checkInMinutes] = checkInTime.split(':').map(Number);
            const [checkOutHours, checkOutMinutes] = checkOutTime.split(':').map(Number);

            const checkInTotalMinutes = checkInHours * 60 + checkInMinutes;
            const checkOutTotalMinutes = checkOutHours * 60 + checkOutMinutes;

            // Calculate total worked minutes
            const totalWorkedMinutes = checkOutTotalMinutes - checkInTotalMinutes;

            // Calculate total worked hours
            const totalWorkedHours = totalWorkedMinutes / 60;

            // Calculate overtime only if total worked hours exceed 8 hours
            let overtimeHours = 0;
            if (totalWorkedHours > 8) {
                overtimeHours = (totalWorkedHours - 8).toFixed(2);
            }

            document.getElementById('overtime').value = overtimeHours;

            // Set status based on total worked hours
            let status = 0;
            if (totalWorkedHours > 8) {
                status = 1;
            } else if (totalWorkedHours === 4) {
                status = 1.5;
            }
            document.getElementById('status').value = status;
        }

        function setMaxDate() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('inDate').setAttribute('max', today);
            document.getElementById('outDate').setAttribute('max', today);
        }

        window.onload = setMaxDate;
    </script>
</head>
<body>

    <div class="card">
        <h2 style="text-align: center; font-size: 48px;">Attendance</h2>
            <div id="main">
                <form class="attendance-form" action="/submit_attendance" method="post">
                    
                    <!-- Employee Name -->
                    <div class="form-group">
                        <label for="employeeName">Employee Name:</label>
                        <input type="text" class="form-control" id="employeeName" name="employeeName" required>
                    </div>

                    <!-- Employee ID -->
                    <div class="form-group">
                        <label for="employeeId">Employee ID:</label>
                        <input type="text" class="form-control" id="employeeId" name="employeeId" required>
                    </div>

                    <!-- Check-In Date and Time in One Row -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inDate">Check-In Date:</label>
                            <input type="date" class="form-control" id="inDate" name="inDate" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="checkIn">Check-In Time:</label>
                            <input type="time" class="form-control" id="checkIn" name="checkIn" value="09:00" required oninput="calculateOvertimeAndStatus()">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="outDate">Out Date:</label>
                            <input type="date" class="form-control" id="outDate" name="outDate" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="checkOut">Check-Out Time:</label>
                            <input type="time" class="form-control" id="checkOut" name="checkOut" value="17:00" required oninput="calculateOvertimeAndStatus()">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="overtime">Overtime Hours:</label>
                            <input type="number" class="form-control" id="overtime" name="overtime" min="0" step="0.01" value="0" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Status:</label>
                            <input type="number" class="form-control" id="status" name="status" value="0" readonly>
                        </div>
                    </div>

                

                    <!-- Submit Button -->
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    
                </form>



            </div>

        
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
