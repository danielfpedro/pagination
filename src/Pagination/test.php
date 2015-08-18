<?php
require "Pagination.php";

use Pagination\Pagination;

$pagination = new Pagination(120);

?>

<?php if ($pagination->hasPagination): ?>
	<ul class="pagination">
		<?= $pagination->first(); ?>
		<?= $pagination->prev(); ?>
		<?= $pagination->numbers(); ?>
		<?= $pagination->next(); ?>
		<?= $pagination->last(); ?>
	</ul>
<?php endif ?>