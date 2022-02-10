<?
class Controller {
    public $DATA = [];
    protected $template_view = 'template.php';
    protected $view = null;

    function __construct($view_model, $user_data) {
        $this->view = $view_model;
        if (file_exists('models/'.$view_model)) include 'models/'.$view_model;
    }
    
    function action_view(){
        include 'views/'.$this->template_view;
    }
}
?>