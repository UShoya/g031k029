<?php
	class Mashup extends AppModel{
		public $name = "Mashup";
		public $useTable = false;
		public function api(){
			$result = array();
 			$aid = 'dj0zaiZpPWVvNWwyVk1lNWE0SiZzPWNvbnN1bWVyc2VjcmV0Jng9YWU-';
			$url = "http://b.hatena.ne.jp/g031k029/rss";
			$xml = file_get_contents($url);
			$obj = simplexml_load_string($xml);
			$result["me"] = '<a href="'.$obj->channel->link.'">'.$obj->channel->title.'</a><br>';
			for($i=0;$i<count($obj->item);$i++){
				$Url = "http://jlp.yahooapis.jp/KeyphraseService/V1/extract?appid=".$aid;
				$Url .= "&sentence=".urlencode($obj->item->$i->title);
				$Xml  = simplexml_load_file($Url);
				$result["title"]["$i"] = '<a href="'.$obj->item->$i->link.'">'.$obj->item->$i->title.'</a><br>';
				$result["key"]["$i"] = "キーワード:";
				foreach ($Xml->Result as $cur) {
        			$result["key"]["$i"] .= $cur->Keyphrase." ";
    			}
    			$result["key"]["$i"] .= "<br>";
			}
			$result["i"] = "$i";
			return $result;
		}
	}
?>