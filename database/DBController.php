<?php
class DBController
{
    // DB connection properties    
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $database = 'quanlydanhgia';

    // Connection properties
    public $con = null;

    // Call Constructer
    public function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if ($this->con->connect_errno) {
            echo "Fail" . $this->con->connect_errno;
        } /*else {
            echo "You Rock keep it going Huy, I know you can do it";
        }*/
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    // MySqli Closing connection
    protected function closeConnection()
    {
        if ($this->con != null) {
            $this->con->close();
            $this->con = null;
        }
    }
}
