<?php
session_start();

// Check if the token is set in the session
if (isset($_SESSION['authToken'])) {
    $token = $_SESSION['authToken'];
} else {
    // Redirect to the login page if the token is not set
    header('Location: /');
    exit;
}

// Get the current page from query parameters or default to 1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// cURL request to the projects API with pagination
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://audit.imarkinfotech.com/api/v1/projects?search_by=project&sort_by=created_at&sort=desc&per_page=10&page=$page",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

if ($curl_errno = curl_errno($curl)) {
    $curl_error = curl_error($curl);
    curl_close($curl);
    echo "cURL error ({$curl_errno}): {$curl_error}";
    exit;
}

curl_close($curl);

$data = json_decode($response, true);
$projects = $data['data'] ?? [];
$links = $data['links'] ?? [];

function favicon($domain) {
    // Assuming the favicon is located at the root of the domain
    return "https://{$domain}/favicon.ico";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Listing</title>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Project Listing</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Reports</th>
                    <th>Result</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=0;
                foreach ($projects as $project): ?>
                    <?php
                    $i++;
                    // Calculate badge class and text based on result and reports
                    $ratio = $project['result'] / $project['reports'];
                    if ($ratio > 79) {
                        $badgeClass = 'badge-success';
                        $badgeText = 'Good';
                    } elseif ($ratio > 49) {
                        $badgeClass = 'badge-warning';
                        $badgeText = 'Decent';
                    } else {
                        $badgeClass = 'badge-danger';
                        $badgeText = 'Bad';
                    }
                    $collapseId = 'collapse-' . $i; // Unique ID for collapse section
                    ?>
                    <tr>
                        <td> 
                            <?php if($project['favicon']!=""){?>
                            <img src="<?php echo $project['favicon']; ?>" alt="Favicon" class="width-4 height-4"  style="width: 21px;">
                            <?php }?>
                        
                        <?php echo htmlspecialchars($project['project']); ?></td>
                        <td><?php echo htmlspecialchars($project['reports']); ?></td>
                        <td> <a href="#" class="badge <?php echo $badgeClass; ?>">
                                <?php echo htmlspecialchars($badgeText); ?>
                            </a></td>
                        <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($project['created_at']))); ?></td>
                        <td>
                            <a href="report.php?project=<?php echo urlencode($project['project']); ?>" class="btn btn-info btn-sm">View Reports</a>
                            <a class="btn btn-primary" data-toggle="collapse" href="#<?php echo $collapseId; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $collapseId; ?>">
                                View Overview
                            </a>
                        </td>
                    </tr>



                    <tr class="collapse" id="<?php echo $collapseId; ?>">
                        <td colspan="5">
                            <div class="card card-body">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            <div class="font-weight-medium py-1">Overview for <?php echo htmlspecialchars($project['project']); ?></div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                          
                                          
                                          
                                            <div class="d-print-none text-muted"><?php echo htmlspecialchars(date('Y-m-d', strtotime($project['created_at']))); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg">
                                            <div class="row">
                                                <div class="col-12 col-lg-auto">
                                                    <div class="mx-auto mx-lg-0 position-relative d-flex align-items-center justify-content-center width-40 height-40 p-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 160" class="stroke-warning" width="144" height="144">
                                                            <circle cx="80" cy="80" r="75" stroke="#ddd" stroke-width="5" fill="transparent"></circle>
                                                            <path d="M80,5A75,75,0,1,1,5,80,75,75,0,0,1,80,5" stroke-linecap="round" stroke-width="10" fill="transparent" stroke-dasharray="330,471"></path>
                                                        </svg>
                                                        <div class="position-absolute">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <div class="font-weight-bold h1 mb-0">
                                                                    <?php 
                                                                    $totalnumber = $project['reports']*100;
                                                                    $final = ($project['result']*100)/$totalnumber;
                                                                    echo round($final);

                                                                    ?>
                                                                    
                                                                </div>
                                                                <div class="text-muted border-top pt-1">
                                                                    100
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg text-center text-lg-left">
                                                    <div class="my-2 h5"><?php echo htmlspecialchars($project['project']); ?></div>
                                                    <div class="my-2 text-break text-muted"><?php echo htmlspecialchars($project['meta_details']); ?></div>
                                                    <div class="my-2 text-break"><a href="https://<?php echo $project['project']?>" rel="nofollow noreferrer noopener" target="_blank">https://<?php echo $project['project']?></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <!-- Add your footer content here -->
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        // Extract pagination details from the $links array
        $nextPageUrl = $links['next_page_url'] ?? null;
        $prevPageUrl = $links['prev_page_url'] ?? null;
        $path = $links['path'] ?? '';
        $perPage = $links['per_page'] ?? 10;
        $total = $links['total'] ?? 0;
        $from = $links['from'] ?? 1;
        $to = $links['to'] ?? $perPage;

        // Calculate total pages
        $totalPages = ceil($total / $perPage);

        // Parse current page from the URL
        $currentUrl = $_SERVER['REQUEST_URI'];
        parse_str(parse_url($currentUrl, PHP_URL_QUERY), $queryParams);
        $currentPage = $queryParams['page'] ?? 1;
        ?>
        <nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($prevPageUrl): ?>
            <?php
            // Extract page number from the previous page URL
            parse_str(parse_url($prevPageUrl, PHP_URL_QUERY), $prevParams);
            $prevPage = $prevParams['page'] ?? $currentPage;
            ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $prevPage; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($currentPage > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=1">First</a>
            </li>
        <?php endif; ?>

        <?php if ($nextPageUrl): ?>
            <?php
            // Extract page number from the next page URL
            parse_str(parse_url($nextPageUrl, PHP_URL_QUERY), $nextParams);
            $nextPage = $nextParams['page'] ?? $currentPage;
            ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $nextPage; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($currentPage < $totalPages): ?>
            <li class="page-item">
                <?php
                // Calculate the last page number
                $lastPage = $totalPages;
                ?>
                <a class="page-link" href="?page=<?php echo $lastPage; ?>">Last</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
