<?php
namespace app\models;

use mini\Model;

/**
 * This is the model class for table "posts".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 */
class PostModel extends Model 
{
    public $id;
    public $title;
    public $content;

    function __construct() {
        parent::__construct();
    }
    
    public function load($data)
    {
        //TO-DO: Validate $data input
        if (isset($data['title']) && isset($data['content'])) {
            $this->title = htmlspecialchars(stripslashes(trim($data['title'])));
            $this->content = htmlspecialchars(stripslashes(trim($data['content'])));
            return true;
        } else {
            return false;
        }
    }
    
    //TO-DO: this function should create new post in case of creating
    //or update in other case. Then we dont need update() function below!
    public function save() 
    {
        return PostModel::$db->insert('posts', [
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }
    
    public function update()
    {
        return PostModel::$db->update('posts', [
            'title' => $this->title,
            'content' => $this->content,
        ], ['id' => $this->id]);
    }
    
    static public function delete($id)
    {
        return PostModel::$db->delete('posts', ['id' => $id]);
    }

    static public function find($condition = [])
    {
        return PostModel::$db->select('posts', $condition);
    }
    
    static public function findOne($condition)
    {
        $os = PostModel::$db->select('posts', $condition);
        if (empty($os)) {
            return null;
        } else {
            $o = $os[0];
            $obj = new PostModel();
            $obj->id = $o->id;
            $obj->title = $o->title;
            $obj->content = $o->content;
            return $obj;
        }
    }
}