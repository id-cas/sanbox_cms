<?php
class Utils {
	public function translit($string) {
		/**
		 * Конвертирует русские буквы в английское написание
		 */
		$string=trim($string);
		$alfavitlover = explode(',', 'ё,й,ц,у,к,е,н,г,ш,щ,з,х,ъ,ф,ы,в,а,п,р,о,л,д,ж,э,я,ч,с,м,и,т,ь,б,ю,q,w,e,r,t,y,u,i,o,p,a,s,d,f,g,h,j,k,l,z,x,c,v,b,n,m');
		$alfavitupper = explode(',', 'Ё,Й,Ц,У,К,Е,Н,Г,Ш,Щ,З,Х,Ъ,Ф,Ы,В,А,П,Р,О,Л,Д,Ж,Э,Я,Ч,С,М,И,Т,Ь,Б,Ю,Q,W,E,R,T,Y,U,I,O,P,A,S,D,F,G,H,J,K,L,Z,X,C,V,B,N,M');
		for ($wr = 0; $wr < count($alfavitlover); $wr++) {
			$string = str_replace($alfavitupper[$wr], $alfavitlover[$wr], $string);
		}
		$LettersFrom = explode(",", "ё,й,у,к,е,н,г,з,х,ф,ы,в,а,п,р,о,л,д,э,с,м,и,т,б");
		$LettersTo = explode(',', 'e,j,u,k,e,n,g,z,x,f,y,v,a,p,r,o,l,d,e,s,m,i,t,b');
		static $Consonant = "бвгджзйклмнпрстфхцчшщ";
		static $Vowel = "аеёиоуыэюя";
		static $BiLetters = array (
			"ж" => "zh",
			"ц" => "ts",
			"ч" => "ch",
			"ш" => "sh",
			"щ" => "sch",
			"ю" => "ju",
			"я" => "ja",

		);

		/*$string = preg_replace("/[_\s,?!\[\](){}\-\+\/]+/", "_", $string);
		$string = preg_replace("/-{2,}/", "--", $string);
		$string = preg_replace("/_-+_/", "--", $string);*/

		//here we replace ъ/ь
		$string = preg_replace("/(ь|ъ)([" . $Vowel . "])/", "j\\2", $string);
		$string = preg_replace("/(ь|ъ)/", "", $string);
		$string = str_replace($LettersFrom, $LettersTo, $string);
		// $string = strtr($string, $LettersFrom, $LettersTo );
		$string = strtr($string, $BiLetters);
		$string = preg_replace("/j{2,}/", "j", $string);

		$string = preg_replace("/[^a-z0-9_]/", "_", $string);
		$string = preg_replace("/__+/","_",$string);
		return $string;
	}
}