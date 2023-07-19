<?php
include("dbcon.php");

// Add event function
if (isset($_POST["action"]) && $_POST["action"] == "add") {
    $event_name = $_POST["event_name"];
    $event_area = $_POST["event_area"];
    $event_date = $_POST["event_date"];
    $meron_position = $_POST["meron_position"];
    $wala_position = $_POST["wala_position"];
    $liamado_plasada = $_POST["liamado_plasada"];
    $dehado_plasada = $_POST["dehado_plasada"];
    $total_event_fights = 0;
    $expected_event_fights = $_POST["expected_event_fights"];
    $event_status = "Open";

    $sql = "INSERT INTO events (event_name, event_area, event_date, meron_position, wala_position, liamado_plasada, dehado_plasada, total_event_fights, expected_event_fights, event_status) VALUES ('$event_name', '$event_area', '$event_date', '$meron_position', '$wala_position', '$liamado_plasada', '$dehado_plasada', $total_event_fights, '$expected_event_fights', '$event_status')";

    if ($conn->query($sql) === TRUE) {
        echo "Event added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Fetch events function
if (isset($_POST["action"]) && $_POST["action"] == "fetch") {
    $output = "";
    $sql = "SELECT * FROM events ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            $buttonText = ($row["event_status"] === "Open") ? "Close" : "Open";
            $buttonColorClass = ($row["event_status"] === "Open") ? "btn-danger" : "btn-success";
            $statusTextColorClass = ($row["event_status"] === "Open") ? "text-success" : "text-danger";
            $fights = $row["total_event_fights"] . "/" . $row["expected_event_fights"];
            $liamado_plasada = $row["liamado_plasada"] . "%";
            $dehado_plasada = $row["dehado_plasada"] . "%";

            $output .= "
                <tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["event_name"] . "</td>
                    <td>" . $row["event_area"] . "</td>
                    <td>" . $row["event_date"] . "</td>
                    <td>" . $row["meron_position"] . "</td>
                    <td>" . $row["wala_position"] . "</td>
                    <td>" . $liamado_plasada . "</td>
                    <td>" . $dehado_plasada . "</td>
                    <td>" . $fights . "</td>

                    <td class='" . $statusTextColorClass . " font-weight-bold'>" . $row["event_status"] . "</td>
                    <td>
                        <button class='btn btn-primary editBtn' data-id='" . $row["id"] . "'>Edit</button>
                        <button class='btn btn-danger deleteBtn' data-id='" . $row["id"] . "'>Delete</button>
                        <button class='btn btn-success changeStatusBtn " . $buttonColorClass . "' data-id='" . $row["id"] . "' data-status='" . $row["event_status"] . "'>" . $buttonText . "</button>
                    
                    </td>
                </tr>
            ";
        }
    } else {
        $output .= "
            <tr>
                <td colspan='12'>No events found</td>
            </tr>
        ";
    }

    echo $output;
}

// Fetch single event function
if (isset($_POST["action"]) && $_POST["action"] == "fetch_single") {
    $event_id = $_POST["event_id"];
    $sql = "SELECT * FROM events WHERE id = '$event_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    }
    
}

// Edit event function
if (isset($_POST["action"]) && $_POST["action"] == "edit") {
    $event_id = $_POST["event_id"];
    $event_name = $_POST["event_name"];
    $event_area = $_POST["event_area"];
    $event_date = $_POST["event_date"];
    $meron_position = $_POST["meron_position"];
    $wala_position = $_POST["wala_position"];
    $liamado_plasada = $_POST["liamado_plasada"];
    $dehado_plasada = $_POST["dehado_plasada"];
    $expected_event_fights = $_POST["expected_event_fights"];
    
    $sql = "UPDATE events SET 
                    event_name = '$event_name', 
                    event_area = '$event_area', 
                    event_date = '$event_date', 
                    meron_position = '$meron_position', 
                    wala_position = '$wala_position', 
                    liamado_plasada = '$liamado_plasada', 
                    dehado_plasada = '$dehado_plasada', 
                    expected_event_fights = '$expected_event_fights' 
                    WHERE id = '$event_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Event updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete event function
if (isset($_POST["action"]) && $_POST["action"] == "delete") {
    $event_id = $_POST["event_id"];
    $sql = "DELETE FROM events WHERE id = '$event_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Event deleted successfully";
    } else {
        echo "Error deleting event: " . $conn->error;
    }
}

// Update event status function
if (isset($_POST["action"]) && $_POST["action"] == "update_status") {
    $event_id = $_POST["event_id"];
    $event_status = $_POST["event_status"];

    $sql = "UPDATE events SET event_status = '$event_status' WHERE id = '$event_id'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error updating event status: " . $conn->error;
    }
}


$conn->close();
?>
