<?
    $mysqli = new mysqli("localhost","forTest","123","testing");
    if ($mysqli->connect_errno) {echo 'Не удалось подключиться: '.$mysqli->connect_error;exit();}
    if ($result = $mysqli->query("SELECT count(*) FROM tasks")) {
        $this->DATA['c_page'] = $result->fetch_row()[0];
        $result->close();
    }

    if ($this->DATA['c_page']>0){

        $sort_q = "ORDER BY ";
        if ($user_data['sort_dir']!=1) $this->DATA['sort'] = ['dir'=>0]; else $this->DATA['sort'] = ['dir'=>1];
        switch ($user_data['sort_name']){
            case "email": 
                $this->DATA['sort']['name']="email";
                $sort_q .= "email ".(($this->DATA['sort']['dir']==0)? "ASC " : "DESC ");
                break;
            case "status":
                $this->DATA['sort']['name']="status";
                $dir = (($this->DATA['sort']['dir']==0)? "ASC " : "DESC ");
                $sort_q .= "completed ".$dir.", edit ".$dir;
                break;
            default:
                $this->DATA['sort']['name']="user";
                $sort_q .= "name ".(($this->DATA['sort']['dir']==0)? "ASC " : "DESC ");
        }

        if ($this->DATA['c_page']>3) $this->DATA['c_page'] = ceil($this->DATA['c_page']/3); else $this->DATA['c_page'] = 1;
        if (!isset($user_data['n_page']) || !is_numeric($user_data['n_page'] ) || $user_data['n_page']<0) $this->DATA['n_page'] = 1;
        else $this->DATA['n_page'] = $user_data['n_page'];
        if ($this->DATA['n_page']>$this->DATA['c_page']) $this->DATA['n_page'] = $this->DATA['c_page'];

        if ($result = $mysqli->query("SELECT * FROM tasks ".$sort_q." LIMIT ".(($this->DATA['n_page']-1)*3).",3" )) {
            $this->DATA['list'] = $result->fetch_all();
            $result->close();
        }
    }

    $mysqli->close();

    if (isset($user_data['message'])) $this->DATA['message'] = $user_data['message'];
?>