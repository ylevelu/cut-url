<?php

include_once "config.php";
include_once "functions.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../profile.php");
    die;
}

if ($_GET['user_id'] != $_SESSION['user']['id']){
    $_SESSION['error'] = "Ссылка Вам не принадлежит!";
    header('Location: ../profile.php');
    die;
}

if ($_GET['user_id'] == $_SESSION['user']['id'] && isset($_GET['link']) && !empty($_GET['link'])){
    edit_link($_GET['id'], $_GET['link']);
    $_SESSION['success'] = "Ссылка успешно обновлена!";
    header('Location: ../profile.php');
    die;
}



$long_link = get_long_link($_GET['id']);

include_once "header_profile.php";
?>

<main class="container">
	<?php if(!empty($success)) { ?>
	<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
		<?php echo $success; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php } ?>
	<?php if(!empty($error)) { ?>
	<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
		<?php echo $error; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php }
	?>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Редактирование ссылки: <?php echo $long_link; ?></h2>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-4 offset-4">
			<form action="" method="get">
				<div class="mb-3">
					<label for="login-input" class="form-label">Имя ссылки</label>
					<input type="text" class="form-control is-valid" id="login-input" required name="link">
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					<input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
				</div>
				<button type="submit" class="btn btn-primary">Редактировать</button>
			</form>
		</div>
	</div>
</main>

<?php
include_once "footer_profile.php";
