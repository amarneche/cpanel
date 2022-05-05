<?php
namespace Amarneche\CpanelApi;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Config;
use GuzzleHttp\Psr7\Response;

class Cpanel {
    
    /**
     * username of Cpanel account
     *
     * @var mixed
     */
    private $username;
    
    /**
     * password of Cpanel account 
     *
     * @var mixed
     */
    private $password;
    
    /**
     * hostName eg : host.example.com 
     *
     * @var mixed
     */
    private $hostName;
    
    /**
     * port used for Api Calls usualy it is : 2083 
     *
     * @var mixed
     */
    private $port;


    public function __construct($username=null, $password=null, $hostName=null, $port=null){
        //check if they are not null or get from config file.
        $config=null;
        try{
            $config = Config::get('cpanel');
        }
        catch(\Exception $e){

        }
        catch(\Error $e){

        }
        if(!$config){
            $config = include(__DIR__ . '/../config/cpanel.php');
        }

        
        if($username){
            $this->setUsername($username);
        }
        else {
            $this->setUsername($config['username']);
        }

        if($password){
            $this->setPassword($password);
        }
        else {
            $this->setPassword($config['password']);
        }

        if($hostName){
            $this->setHostName($hostName);
        }
        else {
            $this->setHostName($config['hostName']);
        }

        if($port){
            $this->setPort($port);
        }
        else {
            $this->setPort($config['port']);
        }        
    

        
    }

            
    /**
     * execute a given cpanel function 
     *
     * @param  mixed $module Module name from Cpanel 
     * @param  mixed $function name
     * @param  mixed $params 
     * @return Response
     */
    public function execute(string $module ,string $function ,Array $params=[]) :   Response {            
        $client = new Client();        
        $response =$client->request('GET',"https://{$this->getHostName()}:{$this->getPort()}/execute/{$module}/{$function}" ,[
            'auth'=>[$this->getUsername(),$this->getPassword()],
            'query'=>$params,                
            
        ]);       
        return $response;        

    }

 




    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of hostName
     */ 
    public function getHostName()
    {
        return $this->hostName;
    }

    /**
     * Set the value of hostName
     *
     * @return  self
     */ 
    public function setHostName($hostName)
    {
        $this->hostName = $hostName;

        return $this;
    }

    /**
     * Get the value of port
     */ 
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set the value of port
     *
     * @return  self
     */ 
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }
}