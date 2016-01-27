<?php
class todo{
    private $db;
    protected $title = null;
    protected $id = null;
    protected $completed = false;


    function __construct($DB_con){
        $this->db = $DB_con;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param boolean $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }


    public function add(){
        try{
            $stmt = $this->db->prepare("INSERT INTO tbltodo(title) VALUES(:title)");
            $stmt->bindparam(":title",$this->title);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }


    public function get($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbltodo WHERE id=:id");
        $stmt->execute(array(":id"=>$id));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function remove(){
        $stmt = $this->db->prepare("DELETE FROM tbltodo WHERE id=:id");
        $stmt->bindparam(":id",$this->id);
        $stmt->execute();
        return true;
    }


    function all(){
        $stmt = $this->db->prepare("SELECT * FROM tbltodo ORDER BY id DESC ");
        $stmt->execute();

        if($stmt->rowCount() >0){
            while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <li>
                    <h1> <?php print($row['title']); ?> </h1>
                    <h3> Status :<?php print($row['completed']); ?> </h3>
                    <form method="post">
                        <?php
                        if ($row['completed'] == 1){
                            echo "<input type='radio' name=rad-{$row['id']} value='1' checked /> Completed task <br/>";
                            echo "<input type='radio' name=rad-{$row['id']} value='0' /> An incomplete task <br/>";

                        }
                        else{
                            echo "<input type='radio' name=rad-{$row['id']} value='1' /> Completed task <br/>";
                            echo "<input type='radio' name=rad-{$row['id']} value='0' checked /> An incomplete task <br/>";
                            echo "<button type='submit' value={$row['id']} class='' name='btn-complete'> Complete </button>";
                        }
                        ?>
                        <button type="submit" value= <?php print($row['id']); ?> class="" name="btn-edit"> Edit </button>
                        <button type="submit" value= <?php print($row['id']); ?> class="" name="btn-delete"> Delete </button>
                    </form>
                </li>
            <?php
            }
        }else {
            echo "<h1> There is no list </h1>";
        }
    }
    // *************************************************************************************
    // ****** the next function can be used to return the completed and incompleted ********
    //**************************************************************************************
    public function completed($status)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbltodo WHERE completed=:completed");
        $stmt->execute(array(":completed"=>$status));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function active($status)
    {
        $stmt = $this->db->prepare("SELECT * FROM tbltodo WHERE completed=:completed");
        $stmt->execute(array(":completed"=>$status));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }


    public function complete(){
        try{
            $stmt = $this->db->prepare("UPDATE tbltodo SET completed='1'
                                        WHERE id=:id ");
            $stmt->bindparam(":id",$this->id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }

    public function edit(){
        try{
            $stmt = $this->db->prepare("UPDATE tbltodo SET completed=:completed,
                                        title =:title WHERE id=:id ");
            $stmt->bindparam(":id",$this->id);
            $stmt->bindparam(":title",$this->title);
            $stmt->bindparam(":completed",$this->completed);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }



}
