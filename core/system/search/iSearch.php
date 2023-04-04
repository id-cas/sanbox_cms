<?php
interface iSearch {
	public function updateIndex($objId, $itext): bool;
	public function pull($str): array;
}