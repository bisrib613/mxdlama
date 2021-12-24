<?php
//==============================================//
//				FILE PARSER.PHP					//
//		PARSING FILE XML DARI SHURIKEN			//
//		DIBUAT TANGGAL 21 FEBRUARI 2021			//
//==============================================//
class Spintax
{
    public function process($text)
    {
        return preg_replace_callback(
            '/\{(((?>[^\{\}]+)|(?R))*)\}/x',
            array($this, 'replace'),
            $text
        );
    }
    public function replace($text)
    {
        $text = $this->process($text[1]);
        $parts = explode('|', $text);
        return $parts[array_rand($parts)];
    }
}
/* EXAMPLE USAGE */
$spintax = new Spintax();
class parser{
	public function parsexml($isinya){
		$hehe = preg_match_all('#<ns0:entry>(.*?)</ns0:entry>#s', $isinya, $gitulah);
		$parse = $gitulah[1];
		
		foreach($parse as $parsing){
			$entah = preg_match('#<ns0:title type=\"html\">(.*?)</ns0:title>#s', $parsing, $hooh);
			$entahjuga = preg_match('#<ns0:content type=\"html\">(.*?)</ns0:content>#s', $parsing, $keren);
			$itulah['title'] = $hooh[1];
			$itulah['content'] = $keren[1];
			
			$ddd[] = $itulah;
			unset($itulah);
		}
		return $ddd;
	}
	
	public function parsecsv($file){
		while (($line = fgetcsv($file)) !== FALSE) {
			$itulah['title'] = $line[0];
			$itulah['content'] = $line[1];
			$ddd[] = $itulah;
			unset($itulah);
		}
		return $ddd;
	}
}