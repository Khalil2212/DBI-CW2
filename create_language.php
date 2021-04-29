<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $lang = isset($_POST['language_id']) && !empty($_POST['language_id']) && $_POST['language_id'] != 'auto' ? $_POST['language_id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $Na = isset($_POST['name']) ? $_POST['name'] : '';
    $Last_update = isset($_POST['last_update']) ? $_POST['last_update'] :date('Y-m-d H:i:s');
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO language VALUES (?, ?, ?)');
    $stmt->execute([$lang, $Na, $Last_update]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Language</h2>
    <form action="create_language.php" method="post">
        <label for="language_id">Language_ID</label>
        <input type="text" name="language_id"value="auto" id="language_id">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <label for="last_update">Last_Update</label>
        <input type="datetime-local" name="last_update" value="<?=date('Y-m-d\TH:i')?>" id="last_update">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>