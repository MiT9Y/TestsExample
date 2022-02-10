<?
session_start();

function init_controller($c_name){
    $controller_path = "controllers/".$c_name;
    if(file_exists($controller_path)) include $controller_path; else exit(header('Location: 404.htm'));
}

function reload_page($url, $parameters=[]){
    if (count($parameters)>0) $url .= '?';
    foreach ($parameters as $k => $v) {
        $url .= $k.'='.$v.'&';
    }
    header('Location: '.$url);
    exit();
}

function prepare_text($str){
    return str_replace(">","&gt",str_replace("<", "&lt", $str));
}

switch($_GET['controller']) {
    case "add_edit":
        init_controller ('edit.php');
        $c = new edit('edit.php',$_REQUEST);
        $c->action_view();
        break;
    case "login":
        init_controller ('login.php');
        $c = new login('login.php',$_REQUEST);
        $c->action_view();
        break;
    default:
        init_controller ('main.php');
        $c = new main('main.php',$_REQUEST);
        $c->action_view();
}
?>