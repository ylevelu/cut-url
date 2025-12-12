<?php
	include_once "includes/header_profile.php";

	if (!isset($_SESSION['user']['id'])) {
	header("Location: " . get_url("/"));
	}

	$error = get_error();
	$success = get_success();

	$links = get_user_links($_SESSION['user']['id']);

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
		<?php } ?>
		<div class="row mt-5">
			<?php if (get_links_count_for_user($_SESSION['user']['id'])) { ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Ссылка</th>
						<th scope="col">Сокращение</th>
						<th scope="col">Переходы</th>
						<th scope="col">Действия</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($links as $key => $link) { ?>
						<tr>
							<th scope="row"><?php echo $key + 1; ?></th>
							<td><a href="<?php echo $link['long_link']; ?>" target="_blank"><?php echo $link['long_link']; ?></a></td>
							<td class="short-link"><?php echo get_url($link['short_link']); ?></td>
							<td><?php echo $link['views']; ?></td>
							<td>
								<a href="#" class="btn btn-primary btn-sm copy-btn" title="Скопировать в буфер" data-clipboard-text="<?php echo get_url($link['short_link']); ?>"><i class="bi bi-files"></i></a>
								<a href="<?php echo get_url('includes/edit.php?user_id=' . $link['user_id']. '&id=' . $link['id']); ?>" class="btn btn-warning btn-sm" title="Редактировать"><i class="bi bi-pencil"></i></a>
								<a href="<?php echo get_url('includes/delete.php?user_id=' . $link['user_id']. '&id=' . $link['id']); ?>" class="btn btn-danger btn-sm" title="Удалить"><i class="bi bi-trash"></i></a>
							</td>
						</tr>
				<?php } } else { ?>
						<div class="col">
							<h2 class="text-center"> На данный момент у Вас нет ссылок! </h2>
						</div>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</main>

<?php include_once "includes/footer_profile.php"; ?>