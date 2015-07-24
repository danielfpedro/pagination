Biblioteca cara criação de paginação de dados.

### Como usar

	// PHP
	$pagination = new Pagination;
	$pagination->make(10) // 10 é o número total de registros

	//HTML
	<ul class="pagination">
		<?= $pagination->first() ?>
		<?= $pagination->prev() ?>
		<?= $pagination->numbers() ?>
		<?= $pagination->next() ?>
		<?= $pagination->last() ?>
	</ul>

### Paginando o Select no Banco de Dados
Dependendo do Banco de Dados usado a forma que de paginar a `query` irá variar, segue abaixo um exemplo usando `MySql`.

	SELECT * FROM artigos LIMIT ' .$pagination->getOffset(). ', ' . $pagination->getPerPage()

### Métodos
* __constructor($perPage = 20, $tag = li, $pageName = 'page')
* make($totalRecords)
* first($label = '<<', $extraClasses = null)
* prev($label = '<', $extraClasses = null)
* numbers($rangeNumbers = 5, $label = '<', $extraClasses = null)
* next($label = '>', $extraClasses = null)
* last($label = '>>', $extraClasses = null)
* hasPagination()

### Geters e Seters
* setBaseHref($baseHref)
* getCurrentPage()
* getPerPage()
* getOffset()
