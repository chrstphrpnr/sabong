<!DOCTYPE html>
<html>
<head>

    <title>Arena Events</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <h2>Arena Events</h2>
        <button class="btn btn-success" data-toggle="modal" data-target="#addModal">Add Event</button>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Event Name</th>
                    <th>Event Area</th>
                    <th>Event Date</th>
                    <th>Meron Position</th>
                    <th>Wala Position</th>
                    <th>Liamado Plasada</th>
                    <th>Dehado Plasada</th>
                    <th>Fights</th>
                    <th>Event Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="eventTable">
                <!-- populate  -->
            </tbody>
        </table>
    </div>



    <!-- Add Event Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add Event form fields -->
                        <div class="form-group">
                            <label>Event Name</label>
                            <input type="text" name="event_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Event Area</label>
                            <input type="text" name="event_area" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Event Date</label>
                            <input type="date" name="event_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Meron Position</label>
                            <input type="text" name="meron_position" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Wala Position</label>
                            <input type="text" name="wala_position" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Liamado Plasada</label>
                            <select name="liamado_plasada" class="form-control" required>
                                <?php
                                for ($i = 0; $i <= 100; $i++) {
                                    echo "<option value=\"$i%\">$i%</option>";
                                }
                                ?>
                            </select>
                        </div>`


                        <div class="form-group">
                            <label>Dehado Plasada</label>
                            <select name="dehado_plasada" class="form-control" required>
                                <?php
                                for ($i = 0; $i <= 100; $i++) {
                                    echo "<option value=\"$i%\">$i%</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Expected Fights</label>
                            <input type="text" name="expected_event_fights" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Event Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Edit Event form fields -->
                        <input type="hidden" name="event_id" id="event_id">
                        
                        <div class="form-group">
                            <label>Event Name</label>
                            <input type="text" name="event_name" id="event_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Event Area</label>
                            <input type="text" name="event_area" id="event_area" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Event Date</label>
                            <input type="date" name="event_date" id="event_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Meron Position</label>
                            <input type="text" name="meron_position" id="meron_position" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Wala Position</label>
                            <input type="text" name="wala_position" id="wala_position" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Liamado Plasada</label>
                            <select id="liamado_plasada" name="liamado_plasada" class="form-control" required>
                                <?php
                                for ($i = 0; $i <= 100; $i++) {
                                    $selected = ($i . '%' == $data['liamado_plasada']) ? 'selected' : '';
                                    echo "<option value=\"$i%\" $selected>$i%</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Dehado Plasada</label>
                            <select id="dehado_plasada" name="dehado_plasada" class="form-control" required>
                                <?php
                                for ($i = 0; $i <= 100; $i++) {
                                    $selected = ($i . '%' == $data['dehado_plasada']) ? 'selected' : '';
                                    echo "<option value=\"$i%\" $selected>$i%</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Expected Fights</label>
                            <input type="text" name="expected_event_fights" id="expected_event_fights" class="form-control" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Delete Event Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="event_id" id="delete_event_id">
                        <p>Are you sure you want to delete this event?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Fetch events 
            fetchEvents();

            // Fetch events function
            function fetchEvents() {
                $.ajax({
                    url: "events_functions.php",
                    type: "POST",
                    data: { action: "fetch" },
                    success: function(response) {
                        $("#eventTable").html(response);
                    }
                });
            }

            // Add event form submission
            $("#addForm").on("submit", function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "events_functions.php",
                    type: "POST",
                    data: formData + "&action=add",
                    success: function(response) {
                        $("#addModal").modal("hide");
                        $("#addForm")[0].reset();
                        fetchEvents();
                    }
                });
            });

            // Edit event modal open
            $(document).on("click", ".editBtn", function() {
                var event_id = $(this).data("id");
                $.ajax({
                    url: "events_functions.php",
                    type: "POST",
                    data: { action: "fetch_single", event_id: event_id },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $("#event_id").val(data.id); //id field
                        $("#event_name").val(data.event_name);
                        $("#event_area").val(data.event_area); //event_area
                        $("#event_date").val(data.event_date); //event_date
                        $("#meron_position").val(data.meron_position); //meron_position
                        $("#wala_position").val(data.wala_position); //wala_position
                        $("#liamado_plasada").val(data.liamado_plasada + '%'); //liamado_plasada 
                        $("#dehado_plasada").val(data.dehado_plasada + '%'); //dehado_plasada
                        $("#expected_event_fights").val(data.expected_event_fights); //expected_event_fights
                        $("#editModal").modal("show");
                    }

                });
            });


            // Submit form data using Ajax
            $(document).on("submit", "#editForm", function(e) {
                e.preventDefault();

                // Get the form data
                var formData = $(this).serialize();
                console.log(formData);

                $.ajax({
                    url: "events_functions.php",
                    type: "POST",
                    data: formData + "&action=edit", 
                    success: function(response) {
                        console.log(response);
                        $("#editModal").modal("hide");
                        fetchEvents(); // Fetch updated events
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });

                // Close the modal
                $("#editModal").modal("hide");
            });


            // Delete event modal open
            $(document).on("click", ".deleteBtn", function() {
                var event_id = $(this).data("id");
                $("#delete_event_id").val(event_id);
                $("#deleteModal").modal("show");
            });


            // Delete event form submission
            $("#deleteForm").on("submit", function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "events_functions.php",
                    type: "POST",
                    data: formData + "&action=delete",
                    success: function(response) {
                        console.log(response);

                        $("#deleteModal").modal("hide");
                        fetchEvents();
                    }
                });
            });

            // Change status button click event
            $(document).on("click", ".changeStatusBtn", function() {
                var event_id = $(this).data("id");
                var event_status = $(this).data("status");

                var new_status = event_status === "Open" ? "Close" : "Open";

                $.ajax({
                    url: "events_functions.php",
                    type: "POST",
                    data: {
                        action: "update_status",
                        event_id: event_id,
                        event_status: new_status
                    },
                    success: function(response) {
                        if (response === "success") {
                            $(".changeStatusBtn[data-id='" + event_id + "']").data("status", new_status);
                            $(".changeStatusBtn[data-id='" + event_id + "']").text(new_status);
                            fetchEvents();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });


        });


    </script>

</body>
</html>
