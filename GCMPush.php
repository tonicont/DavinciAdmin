<?php
  
class GCMPush
{
    protected $url = 'https://android.googleapis.com/gcm/send';
    // Para obtener una apikey para tu aplicacion puedes hacerlo
    // en https://code.google.com/apis/console/
    protected $serverApiKey = "TU API KEY DE GOOGLE";
    protected $dispositivos = array();
    protected static $instance = null;
     
    protected function __construct()
    {
        //No se construye lo no edificable ;)
    }
    protected function __clone()
    {
        //No me gustan los clones
    }
     
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
     
     
    public function set_dispositivos($dispositivoIds)
    {
        if (is_array($dispositivoIds)) {
            $this->dispositivos = $dispositivoIds;
        } else {
            $this->dispositivos = array(
                $dispositivoIds
            );
        }
    }
     
    public function enviar($mensaje)
    {
        if (!is_array($this->dispositivos)
            || count($this->dispositivos) == 0) {
            $this->error("No hay dispositivos a los que enviar la notificación");
        }
        if (strlen($this->serverApiKey) < 8) {
            $this->error("No se ha indicado la apiKey");
        }
         
        $campos = array(
            'registration_ids' => $this->dispositivos,
            'data' => array(
                "mensaje" => $mensaje
            )
        );
         
        $cabeceras = array(
            'Authorization: key=' . $this->serverApiKey,
            'Content-Type: application/json'
        );
         
         
        // Para aprender más sobre la librería
        // cURL pues visitar
        // http://web.ontuts.com/tutoriales/aprendiendo-a-utilizar-la-libreria-curl-en-php/
        $ch = curl_init();
 
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $cabeceras);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($campos));
         
         
        $resultado = curl_exec($ch);
         
        curl_close($ch);
         
        return $resultado;
    }
     
    function error($msg)
    {
        echo "Fallo el envío de notificaciones con Android con el siguiente error:";
        echo "\t" . $msg;
        exit(1);
    }
}
  
?>
