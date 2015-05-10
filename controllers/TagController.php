<?php                                   

class TagController extends BaseController {
    private $tagModel;

    protected function onInit() {
        $this->title = 'Tag';
        $this->tagModel = new TagModel();
    }       
    
    public function get($id) {
        if (isset($id) && is_numeric($id)) {
            $this->posts = $this->tagModel->getPosts($id);    
        } else {                                                                          
            $this->addErrorMessage("Tag id is incorrect");
            $this->redirect("home");
        }                            
    }
}
