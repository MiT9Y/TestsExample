<?
$this->DATA = $user_data;

$mysqli = new mysqli("localhost","forTest","123","testing");
if ($mysqli->connect_errno) {echo 'Не удалось подключиться: '.$mysqli->connect_error;exit();}

if (isset($this->DATA['id'])&&is_numeric($this->DATA['id'])&&$this->DATA['act']!="add") {

    switch ($this->DATA['act']){
        case 'edit':
            $this->DATA['success'] = 1;
            if ($_SESSION['isAdmin']==1) {
                $this->DATA['success'] = 0;
                if (isset($this->DATA['comment'])){
                    $this->DATA['completed'] = ((isset($this->DATA['completed']))?1:0);
                    if ($this->DATA['comment'] != "") {
                        if ($stmt = $mysqli->prepare("UPDATE tasks SET completed = ?, edit = IF(edit=0,IF(COMMENT != ?,1,0),1), COMMENT = ? WHERE id = ?")) {
                            if ($stmt->bind_param("issi", $this->DATA['completed'], $this->DATA['comment'], $this->DATA['comment'], $this->DATA['id']) )
                                if ($stmt->execute()) {$this->DATA['message']='Запись отредактированна';$this->DATA['success'] = 1;}
                            $stmt->close();
                        }
                    } else {$this->DATA['success'] = 0; $this->DATA['message']='Комментарий не может быть пустым';}
                }
            } else $this->DATA['message']='Недостаточно прав';
            break;
        case 'del':
            $this->DATA['success'] = 1;
            if ($_SESSION['isAdmin']==1) {
                $this->DATA['message']='Запись не удалена';
                if ($stmt = $mysqli->prepare("DELETE FROM tasks where id=?")) {
                    if ($stmt->bind_param("i", $this->DATA['id']))
                        if ($stmt->execute()) $this->DATA['message']='Запись удалена';
                    $stmt->close();
                }
            } else $this->DATA['message']='Недостаточно прав';
            break;
    }

    if ($this->DATA['success'] == 0 && !isset($this->DATA['comment'])) {
        if ($stmt = $mysqli->prepare("SELECT comment,completed FROM tasks WHERE id = ?")) {
            if ($stmt->bind_param("i", $this->DATA['id'])) {
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows==1) $this->DATA = array_merge($this->DATA,$result->fetch_assoc());
                else {$this->DATA['success'] = 1; $this->DATA['message']='Задача не найдена';}
            }
            $stmt->close();
        }
    }

} else { 
    if ($this->DATA['act']=="add"){
        $this->DATA['success'] = 1;
        if ($_SESSION['isAdmin']!=1) {
            if (isset($this->DATA['name'])&&isset($this->DATA['email'])&&isset($this->DATA['comment'])){
                if ($this->DATA['name']=='' || $this->DATA['email']=='' || $this->DATA['comment'] == '') {
                    if ($this->DATA['email']!=''&&!filter_var($this->DATA['email'], FILTER_VALIDATE_EMAIL)) 
                    { $this->DATA['success'] = 0; $this->DATA['message']='Некорректно указана почта';}
                    else{$this->DATA['success'] = 0; $this->DATA['message']='Заполнены не все обязательные поля';}
                } else {
                    if (filter_var($this->DATA['email'], FILTER_VALIDATE_EMAIL)) {
                        $this->DATA['message']='Запись не добавлена';
                        if ($stmt = $mysqli->prepare("INSERT INTO tasks(name,email,comment) values(?,?,?)")) {
                            if ($stmt->bind_param("sss", $this->DATA['name'], $this->DATA['email'], $this->DATA['comment']) )
                                if ($stmt->execute()) {$this->DATA['message']='Запись добавлена';$this->DATA['success'] = 1;}
                            $stmt->close();
                        }                        
                    } else {$this->DATA['success'] = 0; $this->DATA['message']='Некорректно указана почта';}
                }
            } else $this->DATA['success'] = 0;
        } else $this->DATA['message']='Операция недоступна данной роли';
    } else {$this->DATA['success'] = 1; $this->DATA['message']='Задача не выбрана';}
}
$mysqli->close();
?>