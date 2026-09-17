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

// Get the project and current page from query parameters
$project = isset($_GET['project']) ? $_GET['project'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// cURL request to the reports API with pagination
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://audit.imarkinfotech.com/api/v1/reports?project=" . urlencode($project) . "&per_page=10&page=$page",
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
$reports = $data['data'] ?? [];
$links = $data['links'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Listing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Reports for Project: <?php echo htmlspecialchars($project); ?></h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>URL</th>
                    <th>Result</th>
                    <th>Generated At</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                 $i=1; 
                foreach ($reports as $report):
                    if ($report['result'] > 79) {
                        $badgeClass = 'badge-success';
                        $badgeText = 'Good';
                    } elseif ($report['result'] > 49) {
                        $badgeClass = 'badge-warning';
                        $badgeText = 'Decent';
                    } else {
                        $badgeClass = 'badge-danger';
                        $badgeText = 'Bad';
                    }
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($i); ?></td>
                        <td><?php echo htmlspecialchars($report['url']); ?></td>
                        <td><?php echo htmlspecialchars($report['result']); ?> <span class="badge <?php echo $badgeClass; ?>"><?php echo $badgeText;?></span></td>
                        <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($report['generated_at']))); ?></td>
                    </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($links['prev']): ?>
                    <li class="page-item">
                        <a class="page-link" href="?project=<?php echo urlencode($project); ?>&page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($links['first']): ?>
                    <li class="page-item">
                        <a class="page-link" href="?project=<?php echo urlencode($project); ?>&page=1">First</a>
                    </li>
                <?php endif; ?>

                <?php if ($links['next']): ?>
                    <li class="page-item">
                        <a class="page-link" href="?project=<?php echo urlencode($project); ?>&page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($links['last']): ?>
                    <li class="page-item">
                        <a class="page-link" href="?project=<?php echo urlencode($project); ?>&page=<?php echo parse_url($links['last'], PHP_URL_QUERY); ?>">Last</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>