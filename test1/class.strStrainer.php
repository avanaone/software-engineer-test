<?
class strStrainer{
	var $strMatch = "(";
	
	function getLng($str) {
		return strlen($str);
    }
	
	function getPosPair($str,$pos){
		if (is_int($pos)){
			if (substr($str,$pos,1)==$this->strMatch){
				$strLn = $this->getLng($str);
				$depth = 1;
				for ($i = $pos + 1; $i < $strLn; $i++) {
					switch (substr($str,$i,1)){
						case '(':
							$depth++;
							break;
						case ')':
							$depth--;
							if ($depth == 0) {
								return $i;
							}
							break;
					}
				}
				return 'not found'; 
			}else{
				return 'mismatch';
			}
		}else{
			return 'error';
		}
	}
}
?>