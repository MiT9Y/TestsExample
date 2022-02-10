<?
  $this->DATA = $user_data;
  if (isset($_SESSION['user'])) unset($_SESSION['user']);
  if (isset($_SESSION['isAdmin'])) unset($_SESSION['isAdmin']);
  $this->DATA['error'] = false;
  $this->DATA['login'] = false;

  if (!isset($user_data['exit'])) {
    if (isset($user_data['login'])&&isset($user_data['password'])){
        if (!($user_data['login']==""||$user_data['password']=="")) {
        $mysqli = new mysqli("localhost","forTest","123","testing");
        if ($mysqli->connect_errno) {echo 'Не удалось подключиться: '.$mysqli->connect_error;exit();}
        if ($stmt = $mysqli->prepare("SELECT * FROM users where login=?")) {
            $stmt->bind_param("s", $user_data['login']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows==1) {
                $row = $result->fetch_assoc();
                $this->DATA['user_name'] = $row["login"];
                if ($row["password"] == $user_data['password']) {
                    $_SESSION['user'] = $user_data['login'];
                    $_SESSION['isAdmin'] = $row["isAdmin"];
                    $this->DATA['login'] = true;
                } else {$this->DATA['error'] = true; $this->DATA['error_message'] = 'Пароль введён неверно';}
            } else {$this->DATA['error'] = true; $this->DATA['error_message'] = 'Пользователь не найден';}
            $stmt->close();
        }
        $mysqli->close();
    
        } else {$this->DATA['error'] = true; $this->DATA['error_message'] = 'Не заполнены обязательные поля';}
    }    
  } else $this->DATA['login'] = true;
?>