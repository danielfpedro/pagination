<?php

namespace Pagination;

class Pagination
{
	private $baseHref = null;
	public $pageName;
	public $totalRecords;
	public $perPage;
	public $currentPage;
	public $totalPages;
	public $numbersRange;

	private $startPage;
	private $endPage;

	public $tag;

	public $hasPagination = true;

	public function __construct($perPage = 20, $tag = 'li', $pageName = 'page')
	{
		if ($perPage) {
			$this->perPage = $perPage;
		}
		if ($tag) {
			$this->tag = $tag;
		}
		$this->currentPage = $this->getCurrentPage();
	}

	public function setNumbersRange($numbersRange)
	{
		$this->numbersRange = $numbersRange;
	}
	public function setBaseHref($value)
	{
		$this->baseHref = $value;
	}
	public function hasPagination()
	{
		return $this->hasPagination;
	}
	public function getTotalPages()
	{
		return $this->totalPages;
	}

	public function getOffset()
	{
		return ((int)$this->currentPage - 1) * $this->perPage; 
	}
	public function getPerPage()
	{
		return $this->perPage; 
	}
	public function getCurrentPage($pageName = 'page')
	{
		$this->pageName = $pageName;
		$currentPage = (isset($_GET[$pageName])) ? (int)$_GET[$pageName] : 1;
		return abs(($currentPage) ? $currentPage : 1);
	}

	public function make($totalRecords)
	{
		$this->totalRecords = $totalRecords;
		$this->totalPages = ceil($totalRecords / $this->perPage);

		if ($this->totalPages <= 1) {
			$this->hasPagination = false;
		}
	}
	public function numbers($numbersRange = 5, $extraClasses = null)
	{
		$this->numbersRange = $numbersRange;

		$numbers = [];

		if ($this->hasPagination) {
			$this->startPage = $this->currentPage - $this->numbersRange;
			$this->endPage = $this->currentPage + $this->numbersRange;

			if ($this->startPage <= 0) {
				$this->endPage -= ($this->startPage - 1);
				$this->startPage = 1;
			}
			if ($this->endPage > $this->totalPages) {
				$this->endPage = $this->totalPages;
			}

			if ($this->startPage > 1) {
				$numbers[] = $this->createLink($this->currentPage - 1, '...');
			}

			for ($i = $this->startPage; $i <= $this->endPage; $i++) {
				$classesToLink = ($i == $this->currentPage) ? 'active' : null;
				$classesToLink .= ' ' . $extraClasses;
				$numbers[] = $this->createLink($i, null, trim($classesToLink));
				$classesToLink = '';
			}

			if ($this->endPage < $this->totalPages) {
				$numbers[] = $this->createLink($this->currentPage + 1, '...');
			}
		}

		return join($numbers, '');	
	}
	public function first($label = '&laquo;', $extraClasses = null)
	{
		if ($this->hasPagination) {
			return $this->createLink(1, $label, $extraClasses);
		}
	}
	public function prev($label = '&#139;', $extraClasses = null)
	{
		if ($this->currentPage > 1 && $this->hasPagination) {
			return $this->createLink($this->currentPage - 1, $label, $extraClasses);
		}
	}
	public function next($label = '&#155;', $extraClasses = null)
	{
		if ($this->currentPage < $this->totalPages && $this->hasPagination) {
			return $this->createLink($this->currentPage + 1, $label, $extraClasses);
		}
	}
	public function last($label = '&raquo;', $extraClasses = null)
	{
		if ($this->hasPagination) {
			return $this->createLink($this->totalPages, $label, $extraClasses);
		}
	}

	private function createLink($goTo, $label = null, $extraClasses = null)
	{
		if ($goTo) {
			$_GET[$this->pageName] = $goTo;
			$url = [];
			foreach ($_GET as $key => $value) {
				$url[] = $key .'='. $value;
			}

			$url = '?' . join($url, '&');
		} else {
			$url = 'javascript:void(0)';
		}
		$label = (!$label) ? $goTo : $label;

		$class = ($extraClasses) ? 'class="'.$extraClasses.'"' : '';

		return '<'.$this->tag.' '.$class.'><a href="'. $this->baseHref . $url .'">'.$label.'</a></'.$this->tag.'>';
	}
}