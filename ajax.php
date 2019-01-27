<?
class Currencies {
	private $cur_from='EUR';
	private $cur_to='RUB';
	private $convert_funcs = array('convert_ecb', 'convert_cbrf');
	private function convert_ecb() {
		@$xmlstr = file_get_contents('http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');
		if ($xmlstr===false)
			return;
		$xml = new SimpleXMLElement($xmlstr);
		foreach ($xml->Cube->Cube->Cube  as $curency) {
			if ($curency->attributes()->currency == $this->cur_to) {
				return '{"Nominal":1,"Value":'.current($curency->attributes()->rate).'}';
			}
		};
	}
	private function convert_cbrf() {
		$json = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js');
		$json = json_decode($json, 1);
		if ($res = $json['Valute'][$this->cur_from])
			return '{"Nominal":' . $res['Nominal'] . ',"Value":' . $res['Value'].'}';
	}
	public function convert(){
		foreach ($this->convert_funcs as $convert_func) {
			if ($res = $this->$convert_func())
				return $res;
		}
	}
}
$c = new Currencies;
echo $c->convert();