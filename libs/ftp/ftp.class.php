<?php
class Ftp
{
    private $conn_id;
    private $host;
    private $username;
    private $password;
    private $port;
    public  $timeout = 90;
    public  $passive = false;
    public  $ssl 	 = false;
    public  $system_type = '';


    public function __construct($host, $username, $password, $port = 21)
    {
        $this->host     = $host;
        $this->username = $username;
        $this->password = $password;
        $this->port     = $port;
    }

    public function connect()
    {
        if ($this->ssl == false)
        {
            $this->conn_id = ftp_connect($this->host, $this->port);
        }
        else
        {
            if (function_exists('ftp_ssl_connect'))
            {
                $this->conn_id = ftp_ssl_connect($this->host, $this->port);
            }
            else
            {
                return false;
            }
        }

        $result = ftp_login($this->conn_id, $this->username, $this->password);

        if ($result == true)
        {
            ftp_set_option($this->conn_id, FTP_TIMEOUT_SEC, $this->timeout);

            if ($this->passive == true)
            {
                ftp_pasv($this->conn_id, true);
            }
            else
            {
                ftp_pasv($this->conn_id, false);
            }

            $this->system_type = ftp_systype($this->conn_id);

            return true;
        }
        else
        {
            return false;
        }
    }

    public function put($local_file_path, $remote_file_path, $mode = FTP_BINARY)
    {
        if (ftp_put($this->conn_id, $remote_file_path, $local_file_path, $mode))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get($local_file_path, $remote_file_path, $mode = FTP_ASCII)
    {
        if (ftp_get($this->conn_id, $local_file_path, $remote_file_path, $mode))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
    public function copy($remote_file_path_dest, $remote_file_path_src)
    {
        $result = 0;
        try
        {
            if(!$src_stream = @fopen('ftp://' . $this->username . ':' . $this->password . '@' . $this->host . '/' . $remote_file_path_src, 'r'))
            {
                throw new Exception('Unable to open remote source file');
            }

            if(!$dest_stream = @fopen('ftp://' . $this->username . ':' . $this->password . '@' . $this->host . '/' . $remote_file_path_dest, 'w'))
            {
                throw new Exception('Unable to open remote destination file');
            }

            $fileSize = filesize('ftp://' . $this->username . ':' . $this->password . '@' . $this->host . '/' . $remote_file_path_src);
            while (!feof($src_stream))
            {
                //read from source file
                $buffer = fread($src_stream, 1);

                //write to dest file
                if (fwrite($dest_stream, $buffer) === FALSE)
                {
                    throw new Exception('Unable to write to remote destination file: ' . $remote_file_path_dest);
                }
            }
            $result = 1;
        }
        catch (Exception $e)
        {
            $result = 0;
            //echo $e->getMessage();
        }
        // Close streams
        if(!empty($src_stream))
        {
            fclose($src_stream);
        }
        if(!empty($dest_stream))
        {
            fclose($dest_stream);
        }
        return $result;
    }

    public function chmod($permissions, $remote_filename)
    {
        if ($this->is_octal($permissions))
        {
            $result = ftp_chmod($this->conn_id, $permissions, $remote_filename);
            if ($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            throw new Exception('$permissions must be an octal number');
        }
    }

    public function chdir($directory)
    {
        ftp_chdir($this->conn_id, $directory);
    }

    public function delete($remote_file_path)
    {
        if (@ftp_delete($this->conn_id, $remote_file_path))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function make_dir($directory)
    {
        if (@ftp_mkdir($this->conn_id, $directory))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function rename($old_name, $new_name)
    {
        if (@ftp_rename($this->conn_id, $old_name, $new_name))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function remove_dir($directory)
    {
        if (@ftp_rmdir($this->conn_id, $directory))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function dir_list($directory)
    {
        $contents = ftp_nlist($this->conn_id, $directory);
        return $contents;
    }

    public function cdup()
    {
        ftp_cdup($this->conn_id);
    }

    public function current_dir()
    {
        return ftp_pwd($this->conn_id);
    }

    private function is_octal($i)
    {
        return decoct(octdec($i)) == $i;
    }
	
	function ftp_mkdir_recusive($path){
		$parts = explode("/",$path);
        $return = true;
        $fullpath = "";
		$this->chdir('/');
        foreach($parts as $part){
			if(!$part) continue;
			$fullpath .= "/".$part;
			if($this->chdir($part)){
			   //ftp_chdir($con_id, $fullpath);
			}else{
				if($this->make_dir($fullpath)){
					$this->chdir($fullpath);
				}else{
					$return = false;
				}
			}
        }
        return $return;
	}

    public function __destruct()
    {
        if ($this->conn_id)
        {
            ftp_close($this->conn_id);
        }
    }
}
?>