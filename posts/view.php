<?php
require_once __DIR__ . '/../config/database.php';

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

/* FETCH POSTS */
$sql = "SELECT * FROM posts
        WHERE title LIKE '%$search%'
        OR content LIKE '%$search%'
        ORDER BY id DESC
        LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $sql);

/* COUNT TOTAL POSTS */
$countQuery = "SELECT COUNT(*) AS total
               FROM posts
               WHERE title LIKE '%$search%'
               OR content LIKE '%$search%'";

$countResult = mysqli_query($conn, $countQuery);

$rowCount = mysqli_fetch_assoc($countResult);

$totalPosts = $rowCount['total'];

$totalPages = ceil($totalPosts / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>View Posts</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
}

.card{
    border:none;
    box-shadow:0px 2px 10px rgba(0,0,0,0.1);
}

.table td{
    vertical-align:middle;
}
</style>

</head>

<body>

<nav class="navbar navbar-dark bg-dark">
<div class="container">

<a class="navbar-brand">
Blog Management System
</a>

<div>

<a href="../dashboard.php"
class="btn btn-success btn-sm">
Dashboard
</a>

<a href="../auth/logout.php"
class="btn btn-danger btn-sm">
Logout
</a>

</div>

</div>
</nav>

<div class="container mt-4">

<div class="card p-4">

<h2 class="mb-4">All Blog Posts</h2>

<!-- SEARCH FORM -->

<form method="GET" class="mb-4">

<div class="input-group">

<input
type="text"
name="search"
class="form-control"
placeholder="Search by title or content"
value="<?php echo htmlspecialchars($search); ?>"
>

<button
type="submit"
class="btn btn-primary">
Search
</button>

</div>

</form>

<div class="mb-3">

<a href="create.php"
class="btn btn-success">
+ Create New Post
</a>

</div>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Title</th>
<th>Content</th>
<th>Created At</th>
<th width="180">Actions</th>
</tr>

</thead>

<tbody>

<?php
if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo htmlspecialchars($row['title']); ?></td>

<td><?php echo htmlspecialchars($row['content']); ?></td>

<td><?php echo $row['created_at']; ?></td>

<td>

<a
href="edit.php?id=<?php echo $row['id']; ?>"
class="btn btn-warning btn-sm">
Edit
</a>

<a
href="delete.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure you want to delete this post?')">
Delete
</a>

</td>

</tr>

<?php
}
}
else{
?>

<tr>
<td colspan="5" class="text-center">
No posts found
</td>
</tr>

<?php
}
?>

</tbody>

</table>

<!-- PAGINATION -->

<nav>

<ul class="pagination justify-content-center">

<?php
for($i = 1; $i <= $totalPages; $i++){
?>

<li class="page-item <?php if($page == $i) echo 'active'; ?>">

<a
class="page-link"
href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>">
<?php echo $i; ?>
</a>

</li>

<?php
}
?>

</ul>

</nav>

</div>

</div>

</body>
</html>