<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
            background-color: yellow;
        }
        .pagination a {
            margin: 0 3px;
            background-color: bisque;
            
           
        }
        .container {
            margin-bottom: 50px  ;
            margin-left: 250px;
                      
        }
        
    </style>
</head>
<?php   
include 'dbcon.php';
$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Query to count the total number of records that match the search
$total_stmt = $pdo->prepare("SELECT COUNT(*) FROM cjwa_users WHERE cjwa_last_name LIKE ? OR cjwa_first_name LIKE ?");
$total_stmt->execute(["%$search%", "%$search%"]);
$total_rows = $total_stmt->fetchColumn();

// Query to select the records with pagination and search filter
$stmt = $pdo->prepare("SELECT * FROM cjwa_users WHERE cjwa_last_name LIKE ? OR cjwa_first_name LIKE ? LIMIT ? OFFSET ?");
$stmt->execute(["%$search%", "%$search%", $limit, $offset]);
$information = $stmt->fetchAll();

$total_pages = ceil($total_rows / $limit);
?>

<body>
   <div class="container">
        <div class="row mx-auto mt-3">
            <div class="col-md-8">
                <h4>Information List</h4>
                <a class="btn btn-success mb-2" role="button" href="<?=site_url('info/add');?>">Add</a>
                
                <!-- Flash message -->
                <?php flash_alert(); ?>
                
                <!-- Search form -->
                <form method="GET" id="search-form">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search by last or first name" value="<?= htmlspecialchars($search); ?>">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
                
                <!-- Data table -->
                <div id="informationTable">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($information as $i): ?>
                            <tr>
                                <td><?=$i['id'];?></td>
                                <td><?=$i['cjwa_last_name'];?></td>
                                <td><?=$i['cjwa_first_name'];?></td>
                                <td><?=$i['cjwa_email'];?></td>
                                <td><?=$i['cjwa_gender'];?></td>
                                <td><?=$i['cjwa_address'];?></td>
                                <td>
                                    <a href="<?=site_url('info/update/'.$i['id']);?>">Update</a> |
                                    <a href="<?=site_url('info/delete/'.$i['id']);?>">Delete</a>
                                   
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination" id="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="javascript:void(0);" class="btn btn-sm btn-secondary page-link" data-page="<?= $i; ?>"><?= $i; ?></a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            // Automatically submit the search form via Ajax
            $('#search').on('input', function() {
                var searchQuery = $(this).val();
                loadPage(1, searchQuery);  // Load first page with search query
            });

            // Handle pagination click
            $(document).on('click', '.pagination .page-link', function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                var searchQuery = $('#search').val();
                loadPage(page, searchQuery);
            });

            // Load page based on page number and search query
            function loadPage(page, searchQuery = '') {
                $.ajax({
                    type: 'GET',
                    url: '<?=site_url('info/read');?>',
                    data: {
                        search: searchQuery,
                        page: page
                    },
                    success: function(response) {
                        // Update the table and pagination dynamically
                        $('#informationTable').html($(response).find('#informationTable').html());
                        $('#pagination').html($(response).find('#pagination').html());
                    }
                });
            }
        });
    </script>
</body>
</html>
