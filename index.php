<?php
$connect = mysqli_connect("localhost", "root", "mysql", "sitemap_demo");

$query = "SELECT * FROM pages";

$result = mysqli_query($connect, $query);

if (!empty($result)) {
    echo '<h1>Menu</h1>';
    echo '<ul>';
    echo '<li><a href="index.php">Home</a></li>';
    while ($page = mysqli_fetch_object($result))
        echo '<li><a href="index.php?page=' . $page->slug . '">' . $page->title . '</a></li>';
    echo '</ul>';
}
if (isset($_GET['page'])) {

    $page = $_GET['page'];
    $connect = mysqli_connect("localhost", "root", "mysql", "sitemap_demo");

    $query = "SELECT * FROM pages where slug='{$page}' LIMIT 1";

    $result = mysqli_query($connect, $query);

    if (!empty($result)) {
        $page = mysqli_fetch_object($result);
        echo '<h1>' . $page->title . '</h1>';
        echo '<p>' . $page->content . '</p>';
    }

}

?>
