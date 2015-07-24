<?php
require "Pagination.php";

use Pagination\Pagination;

$pagination = new Pagination();

$pagination->createPaginators(10, 120);

?>

<?php if ($pagination->hasPagination): ?>
	<ul class="pagination">
		<?= $pagination->first(); ?>

		<?= $pagination->last(); ?>
	</ul>
<?php endif ?>