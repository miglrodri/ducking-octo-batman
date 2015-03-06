<?php

/*
 * Make HTTP Request to $app_url (iOS)
 * Return: $image_url
 */
function getGamesZapping($url) {
	$output = '';
	$info = '';
	
	$curl = curl_init($url);
	if ($curl) {
		curl_setopt($curl, CURLOPT_FAILONERROR, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$output = curl_exec($curl);
	}

	if ($output) {
		$doc = new DOMDocument();
		if (@$doc->loadHTML($output)) {
			$table = $doc->getElementById('box');
            //return $table;
			$games = $table->getElementsByTagName('div');
			foreach ($games as $item) {
				$cenas = $item->getAttribute('class');
				if ($cenas == 'jogo') {
                    $game_elements = $item->getElementsByTagName('div');
                    
					print_r($game_elements->item(0)->childNodes);
                    
                    
                    //print_r($game_elements);
                    //for ($i = 0; $i < count($game_elements); $i++) {
                        //print_r($game_elements[$i]->nodeValue);
                        //document.write(x[i].childNodes[0].nodeValue);
                        //document.write("<br>");
                    //}
                    print_r($item->nodeValue);
					//return $image_url = $image->getAttribute('src-swap');
				}
            }
		}
	}
	
	// something wrong happened
	return false;
	
}
