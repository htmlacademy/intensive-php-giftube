<?php
$path = 'examples\packages';
$dirs = array_diff(scandir($path), array('..', '.'));

$xml_str = '<?xml version="1.0" encoding="utf-8"?><examples></examples>';

foreach ($dirs as $dir) {
	$xml = new SimpleXMLElement($xml_str);

	$module_path = $path . "/" . $dir;
	$states = array_values(array_diff(scandir($module_path), array('..', '.')));

	if (file_exists($module_path . "/info.xml")) {
		continue;
	}

	$module_info = json_decode(file_get_contents($module_path . "/info.json"), true);

	foreach ($states as $i => $state) {
		if ($state == 'info.json') {
			continue;
		}

		$index = $i - 1;

		$files_path = $module_path . "/" . $state;
		$state_data = $module_info['examples'][$index];

		$example_node = $xml->addChild('example');
		$example_node->addAttribute('name', $state_data['name']);
		$example_node->addAttribute('index', $i);

		$files = array_values(array_diff(scandir($files_path), array('..', '.')));

		$example_node->addChild('description', 'to do');
		$files_node = $example_node->addChild('files');

		foreach ($files as $i => $file) {
			$file_node = $files_node->addChild('file');

			$file_node->addAttribute('name', $file);
			$file_node->addAttribute('main', 'false');
			$file_node->addAttribute('show', 'true');

			$states_node = $file_node->addChild('states');

			if ($i == 0) {
				foreach ($state_data['states'] as $step) {
					$states_node->addChild('state', $step);
				}
			}
		}
	}

	$info_str = $xml->asXML($module_path . "/info.xml");
}