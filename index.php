<?php

header("Access-Control-Allow-Origin: *");																			 
header('Content-Type: application/json');
error_reporting(E_ERROR | E_PARSE);

function searchPicture($name){
	
	return 'none';
	
}

if (isset($_GET['name']) && !empty($_GET['name']))
	{
	    {
		$All = [];
		$Arg = $_GET['name'];
		$searchLength = 0;
		$Arg = str_replace(" ", "+", $Arg);
			{
			if (isset($_GET['x1337pages']) && !empty($_GET['x1337pages']))
				{
				$pages = $_GET['x1337pages'];
				}
			  else
				{
				$pages = 1;
				}

			if ($pages < 1)
				{
				$pages = 1;
				}

			for ($b = 1; $b <= $pages; $b++)
				{
				$link = 'https://1337xx.to/search/' . $Arg . '/' . $b . '/';
				$jsonData = file_get_contents($link);
				$dom = new DOMDocument;
				$dom->loadHTML($jsonData);
				if ($dom->getElementsByTagName('tbody')->length > 0)
					{
					$as = $dom->getElementsByTagName('tbody')->item(0)->getElementsByTagName('a');
					foreach($as as $a)
						{
						$href = $a->getAttribute("href");
						if (strpos($href, 'torrent') !== false)
							{
							$searchLength++;
							$Link = 'https://1337xx.to' . $href;
							$jsonData = file_get_contents($Link);
							$dom2 = new DOMDocument;
							$dom2->loadHTML($jsonData);
							$links = $dom2->getElementsByTagName('ul')->item(5)->getElementsByTagName('a')->item(0);
							array_push($All, array(
								'link' => $links->getAttribute("href") ,
								"name" => $a->nodeValue,
								"picture" => searchPicture($name)
							));
							}
						}
					}
				}
			}
		echo json_encode($All, JSON_PRETTY_PRINT);
	  }
	}
?>
