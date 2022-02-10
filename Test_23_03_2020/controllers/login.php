<?
require_once('controller.php');
class login extends Controller {
    function action_view(){        
        if ($this->DATA['login']) {
            $par =[];
            if (isset($_SESSION['user'])) $par['message']='Вы успешно авторизовались';
            $par['n_page']=$this->DATA['n_page'];
            $par['sort_name']=$this->DATA['sort_name'];
            $par['sort_dir']=$this->DATA['sort_dir'];
            reload_page('index.php',$par);
            //header('Location: index.php'.(isset($_SESSION['user'])? '?message=Вы успешно авторизовались': ''));
        }
        parent::action_view();
    }
}
?>