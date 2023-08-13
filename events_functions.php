<?php

    include("dbcon.php");

    // Fetch open events function
    if (isset($_POST["action"]) && $_POST["action"] == "fetchOpenEvents") {
        $output = "";
        $sql = "SELECT * FROM events WHERE event_status = 'Open' ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $buttonText = ($row["event_status"] === "Open") ? "Close" : "Open";
                $buttonColorClass = ($row["event_status"] === "Open") ? "btn-danger" : "btn-success";
                $statusTextColorClass = ($row["event_status"] === "Open") ? "text-success" : "text-danger";
                $liamado_plasada = $row["liamado_plasada"] . "%";
                $dehado_plasada = $row["dehado_plasada"] . "%";
                $created_at = $row["created_at"]; 
                $eventDate = date("F j, Y", strtotime($created_at));

                $output .= "
                    <tr>
                        <td>" . $row["event_name"] . "</td>
                        <td>" . $row["event_area"] . "</td>
                        <td>" . $liamado_plasada . "</td>
                        <td>" . $dehado_plasada . "</td>
                        <td class='" . $statusTextColorClass . " font-weight-bold'>" . $row["event_status"] . "</td>
                        <td>" . $eventDate . "</td> 

                        <td>
                            <button class='btn btn-primary editBtn' data-id='" . $row["id"] . "'>Edit</button>
                            <button class='btn changeStatusBtn " . $buttonColorClass . "' data-id='" . $row["id"] . "' data-status='" . $row["event_status"] . "'>" . $buttonText . "</button>
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

    // Fetch close events function
    elseif (isset($_POST["action"]) && $_POST["action"] == "fetchCloseEvents") {
        $output = "";
        $sql = "SELECT * FROM events WHERE event_status = 'Close' ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $buttonText = ($row["event_status"] === "Open") ? "Close" : "Open";
                $buttonColorClass = ($row["event_status"] === "Open") ? "btn-danger" : "btn-success";
                $statusTextColorClass = ($row["event_status"] === "Open") ? "text-success" : "text-danger";
                $liamado_plasada = $row["liamado_plasada"] . "%";
                $dehado_plasada = $row["dehado_plasada"] . "%";
                $created_at = $row["created_at"]; 
                $eventDate = date("F j, Y", strtotime($created_at));

                $disableButtonClass = "";
                $sqlCheckOpenEvent = "SELECT id FROM events WHERE event_status = 'Open'";
                $resultCheckOpenEvent = $conn->query($sqlCheckOpenEvent);
                if ($resultCheckOpenEvent->num_rows > 0) {
                    $disableButtonClass = "disabled";
                }

                $output .= "
                    <tr>
                        <td>" . $row["event_name"] . "</td>
                        <td>" . $row["event_area"] . "</td>
                        <td>" . $liamado_plasada . "</td>
                        <td>" . $dehado_plasada . "</td>
                        <td class='" . $statusTextColorClass . " font-weight-bold'>" . $row["event_status"] . "</td>
                        <td>" . $eventDate . "</td> 

                        <td>
                            <button class='btn changeStatusBtn " . $buttonColorClass . " " . $disableButtonClass . "' data-id='" . $row["id"] . "' data-status='" . $row["event_status"] . "' " . $disableButtonClass . ">" . $buttonText . "</button>
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

    // Add event function
    elseif (isset($_POST["action"]) && $_POST["action"] == "add") {
        $event_name = $_POST["event_name"];
        $event_area = $_POST["event_area"];
        $liamado_plasada = $_POST["liamado_plasada"];
        $dehado_plasada = $_POST["dehado_plasada"];
        $event_status = "Open";

        $sql = "INSERT INTO events (
            event_name, 
            event_area, 
            liamado_plasada, 
            dehado_plasada, 
            event_status) VALUES 
            (
            '$event_name', 
            '$event_area', 
            '$liamado_plasada', 
            '$dehado_plasada', 
            '$event_status'
            )";

        if ($conn->query($sql) === TRUE) {
            echo "Event added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Fetch single event function
    elseif (isset($_POST["action"]) && $_POST["action"] == "fetch_single") {
        $event_id = $_POST["event_id"];
        $sql = "SELECT * FROM events WHERE id = '$event_id'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo json_encode($row);
        }
        
    }

    // Edit event function
    elseif (isset($_POST["action"]) && $_POST["action"] == "edit") {
        $event_id = $_POST["event_id"];
        $event_name = $_POST["event_name"];
        $event_area = $_POST["event_area"];
        $liamado_plasada = $_POST["liamado_plasada"];
        $dehado_plasada = $_POST["dehado_plasada"];
        
        $sql = "UPDATE events SET 
                        event_name = '$event_name', 
                        event_area = '$event_area', 
                        liamado_plasada = '$liamado_plasada', 
                        dehado_plasada = '$dehado_plasada', 
                        WHERE id = '$event_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Event updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Update event status function
    elseif (isset($_POST["action"]) && $_POST["action"] == "update_status") {
        $event_id = $_POST["event_id"];
        $event_status = $_POST["event_status"];

        $sql = "UPDATE events SET event_status = '$event_status' WHERE id = '$event_id'";

        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "Error updating event status: " . $conn->error;
        }
    }

    // Check open event function
    elseif (isset($_POST["action"]) && $_POST["action"] == "checkOpenEvent") {
        $sqlCheckOpenEvent = "SELECT id FROM events WHERE event_status = 'Open'";
        $resultCheckOpenEvent = $conn->query($sqlCheckOpenEvent);

        if ($resultCheckOpenEvent->num_rows > 0) {
            echo "btn-danger"; // open events
        } else {
            echo "btn-success"; // closed events
        }
    }

    $conn->close();

?>