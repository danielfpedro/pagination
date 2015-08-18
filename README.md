Biblioteca cara criação de paginação de dados.

### Como usar

```php
use Pagination\Pagination;

$pagination = new Pagination(100); // Passe o total de registros
```

```html
<ul class="pagination">
	<?= $pagination->first() ?>
	<?= $pagination->prev() ?>
	<?= $pagination->numbers() ?>
	<?= $pagination->next() ?>
	<?= $pagination->last() ?>
</ul>
```

### Paginando o Select no Banco de Dados
Dependendo do Banco de Dados usado a forma de paginar a `query` irá variar, segue abaixo um exemplo usando `MySql`.

```php
SELECT * FROM artigos LIMIT {$pagination->getOffset()}, {$pagination->getPerPage()}
```

### Métodos
* __construct($totalRecords, $perPage = 20, $tag = li, $pageName = 'page')
* first($label = '<<', $extraClasses = null)
* prev($label = '<', $extraClasses = null)
* numbers($rangeNumbers = 5, $extraClasses = null)
* next($label = '>', $extraClasses = null)
* last($label = '>>', $extraClasses = null)
* hasPagination()

### Geters e Seters
* setBaseHref($baseHref)
* getCurrentPage()
* getPerPage()
* getOffset()
* getTotalPages() // Só disponível após chamar o ::make() pois ele necessita do total de registros para calcular o total de páginas

### Range Number
Na criação dos números você terá a opção especificar o `rangeNumbers` que tem como padrão o valor `5`.
Esta opção diz respeito ao `range` de números que serão exibidos antes e depois da pagina atual.
