<?php

include_once("../Funciones/conexion_db.php");

//$enlace = openconn();
//echo $enlace;

class dataRecovery{

    var $table = "";
    var $idCat = "";
    var $sql = "";
    var $statement = "";
    var $article = "";
    var $category = "";
    var $enlace = "";
    var $indexArticles = "";
    
    public function dataRecovery($enlace)
    {
        $this->enlace = $enlace;
    }
    
    function statement($table)
    {
        return;
    }
    
    public function listCategory()
    {
        $this->sql = "SELECT * FROM categoria";
        $statement= mysql_query( $this->sql ) or die(mysql_error());
        if($statement)
        {
            $result = mysql_fetch_array($statement);
            $name = $result['nombre_categoria'];
            $id = $result['id_categoria'];
            echo $name." ".$id,"<br/>";
        }
    }
    
    public function setCategory($name)
    {
        $this->sql = "SELECT * FROM categoria where nombre_categoria = '".$name."'";
        $statement= mysql_query( $this->sql ) or die(mysql_error());
        if($statement)
        {
            $result = mysql_fetch_array($statement);
            $name = $result['nombre_categoria'];
            $id = $result['id_categoria'];
            //echo $name." - ".$id;
            $this->category = new category($name);
            $this->category->setId($id);
        }
    }
    
    public function setArticle($i)
    {
        $this->sql = "SELECT * FROM articulo";// where id_categoria = ".$this->category->id;
        //echo $this->sql;
        $statement= mysql_query( $this->sql ) or die(mysql_error());
        if($statement)
        {
            $index = 0;
            while($result = mysql_fetch_array($statement))
            {
                $title = $result['titulo_articulo'];
                $id = $result['id_articulo'];
                $idCat = $result['id_categoria'];
                $idSubCat = 0;
                $content = $result['texto_articulo'];
                $path = "";
                $this->indexArticles[$index] = $id;
                
                if($index == $i)
                {
                    $this->article = new article($id,$title,$idCat,$idSubCat,$content,$path);
                }
                
                $index++;
                
            }
        }
    }
    
    function setImgPath()
    {
        //magenes (url_imagen, tipo_despliegue, id_articulo)
        $sql = "SELECT * FROM imagenes where id_articulo = ".$this->article->id;
        $statement= mysql_query( $sql ) or die(mysql_error());
        if($statement)
        {
            $result = mysql_fetch_array($statement);
            $url = $result['url_imagen'];
            $this->article->imgs = $url;
            /*$path_array = explode("/",$url);
            $path ="";
            for($i = 0; $i < count($path_array) - 1; $i++)
            {
                $path .= $path_array[$i]."/";
            }
            $this->path = $path;  */
        }
    }
    
}

class category{

    var $id = "";
    var $name = "";
    
    function category($name)
    {
        $this->name = $name;
    }
    
    function setId($id)
    {
        $this->id = $id;
    }

}

class article{

    var $title = "";
    var $idCat = "";
    var $idSubCat = "";
    var $content = "";
    var $path = "";
    var $imgs = "";
    var $id ="";
    
    function article($id,$title,$idCat,$idSubCat,$content,$path)
    {
        $this->id = $id;
        $this->title = $title;
        $this->idCat = $idCat;
        $this->idSubCat = $idSubCat;
        $this->content = $content;
        $this->path = $path;
    }
    
    function writeTitle(){
        echo $this->title;
    }
    
    
    function writeImg()
    {
        echo $this->imgs;
    }
    
    function writePath()
    {
        echo $this->path;
    }
}

/*$data = new dataRecovery($enlace);
$data->listCategory();
$data->setCategory("La moda que no incomoda");
$data->setArticle(0);
$data->article->writeTitle();



closeconn($enlace);*/



?>