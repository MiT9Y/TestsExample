<?
require_once('controller.php');
class edit extends Controller {
    function action_view(){
        if ($this->DATA['success']==1) {
            $par =[];
            if (isset($this->DATA['message'])) $par['message']=$this->DATA['message'];
            $par['n_page']=$this->DATA['n_page'];
            $par['sort_name']=$this->DATA['sort_name'];
            $par['sort_dir']=$this->DATA['sort_dir'];
            reload_page('index.php',$par); 
        }
        parent::action_view();
    }
}
?>