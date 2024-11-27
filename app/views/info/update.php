<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-3">
        <h2>Update</h2>
        <?php flash_alert(); ?>
        <form id="updateForm">
            <div class="mb-3 mt-3">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?=$ui['cjwa_last_name'];?>">
            </div>
            <div class="mb-3">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?=$ui['cjwa_first_name'];?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" value="<?=$ui['cjwa_email'];?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="gender">Gender:</label>
                <input type="text" class="form-control" id="gender" name="gender" value="<?=$ui['cjwa_gender'];?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?=$ui['cjwa_address'];?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <style>
               .button{
                background-color: aqua;
               }
            </style>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $('#updateForm').on('submit', function(e) {
                e.preventDefault();

                // Collect form data
                var formData = $(this).serialize();

                // Send data using Ajax
                $.ajax({
                    type: "POST",
                    url: "<?=site_url('/info/update/' . segment(3));?>", // Update URL if necessary
                    data: formData,
                    success: function(response) {
                        alert('Information updated successfully!');
                        window.location.href = "<?=site_url('info/read');?>"; // Redirect to the list page
                    },
                    error: function() {
                        alert('Error updating information');
                    }
                });
            });
        });
    </script>
</body>
</html>
