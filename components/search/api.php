<?php
class ApiSearch extends Api {
	public Search $search;

	public function __construct(){
		$this->search = Search::getInstance();
	}

	public function getSearchString(): string{
		return getRequestParam('q');
	}

	public function pull(): array{
		$q = $this->getSearchString();

		if(empty($q) || strlen($q) < 3){
			return [];
		}

		return $this->search->pull($q);
	}
}