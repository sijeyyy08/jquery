<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-3">
        <h2>Add Information</h2>
        <?php flash_alert(); ?>
        <form id="addForm">
            <div class="mb-3 mt-3">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" id="lname" name="lname">
            </div>
            <div class="mb-3">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" id="fname" name="fname">
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="gender">Gender:</label>
                <input type="text" class="form-control" id="gender" name="gender">
            </div>
            <div class="mb-3">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div> 

    <script>
        $(document).ready(function(){
            $('#addForm').on('submit', function(e) {
                e.preventDefault();

                // Collect form data
                var formData = $(this).serialize();

                // Send data using Ajax
                $.ajax({
                    type: "POST",
                    url: "<?=site_url('/info/add');?>", // Update URL if necessary
                    data: formData,
                    success: function(response) {
                        alert('Information added successfully!');
                        window.location.href = "<?=site_url('info/read');?>"; // Redirect to the list page
                    },
                    error: function() {
                        alert('Error adding information');
                    }
                });
            });
        });
    </script>
</body>
</html>
