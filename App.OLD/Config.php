<?php
namespace App;

class Config
{

    use Singleton;
    use GetterSetter;
    private $config_file;

    public function __construct($config_file = 'config')
    {
        $this->config_file = $config_file . '.php';
        include_once $this->config_file;
        $this->data = $data;
    }

    public function save()
    {
        $config_string = "<?php\r\n";
        foreach ($this->data as $k=>$v){
            $config_string .= "\$data['" . $k . "'] = " . var_export($v, TRUE) . ";\r\n";
        }
        return file_put_contents($this->config_file, $config_string);
    }

}