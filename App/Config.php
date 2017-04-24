<?php
namespace App;

use App\Traits\Singleton;

class Config
{

    use Singleton;
    
    private $config_file;

    public function __construct()
    {
        $this->config_file = '../Profiles/' . ucfirst(PROFILE) . '/main.php';
        $this->data = require $this->config_file;
    }

    public function __get($k)
    {
        if (is_array($this->data[$k])){
            return new ConfigItem($this->data[$k]);
        } else {
            return $this->data[$k];
        }
    }

    public function save()
    {
        $config_string = var_export($this->data, true);
        $pattern = '/array\s*\((\s*\'.+\'\s*=>\s*\'.*?\'\s*)\)/ims';
        do {
            $tmp = $config_string;
            $config_string = preg_replace($pattern, '[$1]', $tmp);
        } while ($tmp!=$config_string);
        return file_put_contents($this->config_file, "<?php\r\n" . 'return ' . $config_string . ';');
    }

}