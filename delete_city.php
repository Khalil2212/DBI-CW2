<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['city_id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM city WHERE city_id = ?');
    $stmt->execute([$_GET['city_id']]);
    $CA = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$CA) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM city WHERE city_id = ?');
            $stmt->execute([$_GET['city_id']]);
            $msg = 'You have deleted the contact!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read_city.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete City #<?=$CA['city_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete city #<?=$CA['city_id']?>?</p>
    <div class="yesno">
        <a href="delete_city.php?city_id=<?=$CA['city_id']?>&confirm=yes">Yes</a>
        <a href="delete_city.php?city_id=<?=$CA['city_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>