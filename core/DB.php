<?php
class DB {

	private $select = [];
	private $condition= [[]];
	private $conditionType = [];
	private $tableName;
	protected $conn;

	public function __construct($dbhost, $dbuser, $dbpass, $dbname) {
		try {
            $this->conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            //echo "Connected to $dbname at $dbhost successfully.";
        } catch (PDOException $pe) {
            die("Could not connect to the database $dbname :" . $pe->getMessage());
        }
	}
	
	public function select($colName = [],$tableName)
	{
	    $this->select=$colName;
	    $this->tableName=$tableName;
		return $this;
	}
	
	public function where($condition = [[]],$conditionType = [])
	{
		//"where $colName $conditionType $value";
		$this->condition = $condition;
		$this->conditionType =  $conditionType;
		return $this;
	}
	
	public function get()
	{
        //'select name from users where email="user@gmail.com" and password="password"';
        //return 'the data'
        //echo ($this->select[0]);
        $select = 'SELECT ';
        $from = 'FROM ';
        $where = ' WHERE ';
        $x = 0;
        // var_dump($this->condition[1][2]);
        // die;
        for($x;$x<count($this->select)-1;$x++){
            $select .= $this->select[$x] . ',';
        }
        $select .= $this->select[$x] .' ' .$from .$this->tableName;
        //echo count($this->conditionType) ."\n";
        
        $data = array();
        $result = array();
        
        if(count($this->conditionType)>=1)
        {
            $select .= $where;
            $select .= $this->condition[0][0].' '.$this->condition[0][1].' :'.$this->condition[0][0].' ';
            $select .=$this->conditionType[0].' ';
            
            //var_dump($this->condition[0][2]);
            
            if(gettype($this->condition[0][2])=='string' || gettype($this->condition[0][2])=='boolean')
            {
                $data += [':'.$this->condition[0][0] => $this->condition[0][2]];
                //echo "Hi";
            }
            else
            {
                $data += [':'.$this->condition[0][0] => $this->condition[0][2]];
                //echo "Hello";
            }

            
            $x=1;
            for($x;$x<count($this->conditionType);$x++)
            {
                $y=0;
                $select .= $this->condition[$x][$y].' '.$this->condition[$x][$y+1].' :'.$this->condition[$x][$y].' ';

                //var_dump($this->condition[$x][$y+2]);
                if(gettype($this->condition[$x][$y])=='string' || gettype($this->condition[$x][$y])=='boolean')
                {
                    $data += [':'.$this->condition[$x][$y] => $this->condition[$x][$y+2]];
                    //echo "Hi";
                }
                else
                {
                    $data += [':'.$this->condition[$x][$y] => $this->condition[$x][$y+2]];
                    //echo "Hello";
                }
            }
            $y=0;
            $select .=$this->conditionType[$x-1].' ';
            $select .= $this->condition[$x][$y].' '.$this->condition[$x][$y+1].' :'.$this->condition[$x][$y].' ';
            
            //var_dump($this->condition[$x][$y+2]);
            
            if(gettype($this->condition[$x][$y])=='string' || gettype($this->condition[$x][$y])=='boolean')
            {
                
                $data += [':'.$this->condition[$x][$y] => $this->condition[$x][$y+2]];
                //echo "Hi";
            }
            else
            {
                $data += [':'.$this->condition[$x][$y] => $this->condition[$x][$y+2]];
                // "Hello";
            }
        }
        else
        {
            $x=0;
            $y=0;
            $select .= $where;
            $select .=$this->condition[$x][$y].' '.$this->condition[$x][$y+1].' :'.$this->condition[$x][$y].' ';
            
            //var_dump($this->condition[$x][$y+2]);
            
            if(gettype($this->condition[$x][$y])=='string' || gettype($this->condition[$x][$y])=='boolean')
                $data += [':'.$this->condition[$x][$y] => $this->condition[$x][$y+2]];
            else
                $data += [':'.$this->condition[$x][$y] => $this->condition[$x][$y+2]];
                
        }
        //$select .=';';
        //echo $select."\n";
        // echo "\n";
        // foreach($data as $x => $x_value) {
        //     echo $x . "=" . $x_value;
        //     echo "\n";
        //     echo gettype($x_value);
        //     echo "\n";
        // }
        // var_dump($select);
        // exit;
        // var_dump($data);
        // exit;
        $q = $this->conn->prepare($select);
        $q->execute($data);
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $result = $q->fetch();
        // var_dump($result);
        // exit;
        return $result;
	}

    public function insert($tablename,$col = [],$value = [])
    {
        $insert = 'INSERT INTO ';
        $values = [];
        $insert .=$tablename.'(';
        $i = 0;
        while($i < count($col)-1)
        {
            $insert .=$col[$i].',';
            $i++;
        }
        $insert .=$col[$i];
        $insert .=') '.'VALUES '.'(';
        $i = 0;
        while($i < count($value)-1)
        {
            $insert .=':'.$col[$i].',';
            $values += [':'.$col[$i] => $value[$i]];
            $i++;
        }
        $insert .=':'.$col[$i];
        $values += [':'.$col[$i] => $value[$i]];
        $insert .=')';
        // var_dump($values);
        // exit;

        //echo $insert."\n";
        // foreach($values as $x => $x_value) {
        //     echo $x . "=" . $x_value;
        //     echo "\n";
        // }

        $q = $this->conn->prepare($insert);

        return $q->execute($values);

    }

    public function update($tableName,$cols = [],$setValues = [],$conditions = [[]],$operators = [])
    {
        $update = 'UPDATE '.$tableName.' SET ';
        $i = 0;
        $set = [];
        while($i < count($cols)-1)
        {
            $update .=$cols[$i].'='.':'.$cols[$i].',';
            $set +=[':'.$cols[$i] => $setValues[$i]];
            $i++;
        }
        $update .=$cols[$i].'='.':'.$cols[$i];
        $set +=[':'.$cols[$i] => $setValues[$i]];

        $update .=' WHERE ';
        $i = 0;
        while($i < count($operators))
        {
            $update .=$conditions[$i][0].' '.$conditions[$i][1].' :'.$conditions[$i][0].' ';
            $update .=$operators[$i].' ';
            $set +=[':'.$conditions[$i][0] => $conditions[$i][2]];
            $i++;
        }
        $update .=$conditions[$i][0].' '.$conditions[$i][1].' :'.$conditions[$i][0].';';
        $set +=[':'.$conditions[$i][0] => $conditions[$i][2]];

        echo $update."\n";

        // foreach($set as $x => $x_value) {
        //     echo $x . "=" . $x_value;
        //     echo "\n";
        // }
    }

    public function delete($tableName,$conditions = [[]],$operators = [])
    {
        $delete = 'DELETE FROM '.$tableName.' WHERE ';
        $i = 0;
        $values = [];
        while($i < count($operators))
        {
            $delete .=$conditions[$i][0].' '.$conditions[$i][1].' :'.$conditions[$i][0].' ';
            $delete .=$operators[$i].' ';
            $values +=[':'.$conditions[$i][0] => $conditions[$i][2]];
            $i++;
        }
        $delete .=$conditions[$i][0].' '.$conditions[$i][1].' :'.$conditions[$i][0].';';
        $values +=[':'.$conditions[$i][0] => $conditions[$i][2]];

        echo $delete."\n";
        // foreach($values as $x => $x_value) {
        //     echo $x . "=" . $x_value;
        //     echo "\n";
        // }

        // $q = $this->conn->prepare($delete);
        // return $q->execute($values);
    }
}

// $newdb = new DB();
// $slectResult = [];
// $selectResult = $newdb->select(['name','salary','email'],'users')->where([['email','LIKE','abc@gmail.com'],['salary','>=',20000],['age','BETWEEN','20 AND 40']],['AND','OR'])->get();
// $insert = $newdb->insert('users',['name','phone','email'],['Subhajit',7384884890,'abc@gmail.com']);
// $update = $newdb->update('users',['name','email'],['abc','abc@gmail.com'],[['salary','>=',25000],['age','<',35]],['AND']);
// $delete = $newdb->delete('users',[['name','=','abc'],['age','>',40]],['AND']);