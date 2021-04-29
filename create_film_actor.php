<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $Cat = isset($_POST['actor_id']) && !empty($_POST['actor_id']) && $_POST['actor_id'] != 'auto' ? $_POST['actor_id'] : NULL;
    // Check if POST variable "film_id" exists, if not default the value to blank, basically the same for all variables
    $Na = isset($_POST['film_id']) ? $_POST['film_id'] : '';
    $Last_update = isset($_POST['last_update']) ? $_POST['last_update'] :date('Y-m-d H:i:s');
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO film_actor VALUES (?, ?, ?)');
    $stmt->execute([$Cat, $Na, $Last_update]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Film_Create</h2>
    <form action="create_film_actor.php" method="post">
        <label for="actor_id">Actor_Id</label>
        <input type="text" name="actor_id"value="auto" id="actor_id">
        <label for="film_id">Film_Id</label>
        <input type="text" name="film_id" id="film_id">
        <label for="last_update">Last_Update</label>
        <input type="datetime-local" name="last_update" value="<?=date('Y-m-d\TH:i')?>" id="last_update">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>