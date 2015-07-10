<?php
namespace php\admin;

class Dao
{       //获取活动列表
    public function getActs(){
        $db = $this->getDb();
    
        $sql = "select food_act.*,vendor.vendor_name from food_act,vendor where food_act.vendor_id=vendor.vendor_id";
        

        if( (boolean)$result = $db->query($sql) ){
            $arr = array();
            $i=0;
            $item = null;
            while( (boolean)$item = $result->fetch_assoc() )
                $arr[$i++]= $item;
            
            $result->free();
        }
        $db->close();
        return $arr;
    }
    
    //获取活动
    public function getAct( $actid ){
        $db = $this->getDb();
        
        echo 'getAct:';
        print_r($actid);
        $sql = "select food_act.*,vendor.* from food_act,vendor where food_act.vendor_id=vendor.vendor_id && act_id=$actid";
        
        
        $item = null;
        if( (boolean)$result = $db->query($sql) ){
            if( (boolean)$item = $result->fetch_assoc() ){
                
            }
            
            $result->free();
        }
        
        $db->close();
        return $item;
    }
    
    //更新活动
    public function updateAct( $params ){
        $db = $this->getDb();
        $sql = "UPDATE food_act SET act_name=?, vendor_id=?, st_date=?,end_date=? WHERE act_id=?";
        
        print_r($params);
        $stmt = $db->prepare($sql);
        
        $stmt->bind_param("sissi", $params['act-name'],$params['vendor'],$params['act-st-time'],$params['act-end-time'],$params['actid']);
        
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        
        
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    
    //获取商家列表
    public function getVendors(){
        $db = $this->getDb();
        
        $sql = "SELECT * FROM vendor";
        
        if( (boolean)$result = $db->query($sql) ){
        
            $arr = array();
            $i=0;
            $item = null;
            while( (boolean)$item = $result->fetch_assoc() )
                $arr[$i++]= $item;
            $result->free();
        }
        $db->close();
        return $arr;
    }
    
    public function insertVendor( $params ){
        $db = $this->getDb();
        $sql = "INSERT INTO vendor(`vendor_name`, `person_name`, `phone`, `vendor_imgurl`, `vendor_guanzhu`, `vendor_address`) VALUES (?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        
        $stmt->bind_param("ssssss", $params['vendor-name'],$params['contact-name'],$params['contact-tel'],$params['img-url'],$params['gz-url'],$params['vendor-address'] );
        $stmt->execute();
    
        if( $stmt->fetch() ){
         
        }
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    
    public function checkVendor( $name ){
        $db = $this->getDb();
        $sql = "select count(*) from vendor where vendor_name=?";
        $stmt = $db->prepare($sql);
        
        $stmt->bind_param("s", $name );
        $stmt->execute();
        
        $count = 0;
        $stmt->bind_result($count);
        
        if( $stmt->fetch() ){
             
        }
        
        $stmt->close();
        $db->close();
        return $count;
    }
    
    public function getAdvers( $actid ){
        $db = $this->getDb();
        
        $sql = "SELECT * FROM adver where act_id=$actid";
        
        if( (boolean)$result = $db->query($sql) ){
        
            $arr = array();
            $i=0;
            $item = null;
            while( (boolean)$item = $result->fetch_assoc() )
                $arr[$i++]= $item;
            
            $result->free();
        }
        $db->close();
        return $arr;
    }
    public function getAdver( $adverid ){
        $db = $this->getDb();
        
        $sql = "select * from adver where adver_id=$adverid";
        
        $item = null;
        if( (boolean)$result = $db->query($sql) ){
            if( (boolean)$item = $result->fetch_assoc() ){
        
            }
        
            $result->free();
        }
        
        $db->close();
        return $item;
    }
    public function insertAdver( $params ){
        $db = $this->getDb();
        $sql = "INSERT INTO adver(img_url, url, act_id, adver_tit, st_date, end_date) VALUES (?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        
        print_r($params);
        $stmt->bind_param("ssisss", $params['img-url'],$params['link-url'],$params['actid'],$params['name'],$params['st-date'],$params['end-date'] );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    public function checkAdver( $name ){
        $db = $this->getDb();
        $sql = "select count(*) from adver where adver_tit=?";
        $stmt = $db->prepare($sql);
        
        $stmt->bind_param("s", $name );
        $stmt->execute();
        
        $count = 0;
        $stmt->bind_result($count);
        
        if( $stmt->fetch() ){
             
        }
        
        $stmt->close();
        $db->close();
        return $count;
    }
    public function updateAdver( $params ){
        $db = $this->getDb();
        $sql = "UPDATE adver SET img_url=?, url=?, act_id=?, adver_tit=?, st_date=?, end_date=? where adver_id=?";
        $stmt = $db->prepare($sql);
        
        print_r($params);
        $stmt->bind_param("ssisssi", $params['img-url'],$params['link-url'],$params['actid'],$params['name'],$params['st-date'],$params['end-date'],$params['adverid'] );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    
    public function insertShare( $params ){
        $db = $this->getDb();
        $sql = "INSERT INTO share(share_title,share_img_url,share_desc,act_id) VALUES (?,?,?,?)";
        $stmt = $db->prepare($sql);
        
        print_r($params);
        $stmt->bind_param("sssi", $params['title'],$params['img-url'],$params['desc'],$params['actid'] );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    public function checkShare( $actid ){
        $db = $this->getDb();
        $sql = "select count(*) from share where act_id=?";
        $stmt = $db->prepare($sql);
        
        $stmt->bind_param("i", $actid );
        $stmt->execute();
        
        $count = 0;
        $stmt->bind_result($count);
        
        if( $stmt->fetch() ){
             
        }
        
        $stmt->close();
        $db->close();
        return $count;
    }
    public function updateShare( $params ){
        $db = $this->getDb();
        $sql = "UPDATE share SET share_title=?, share_img_url=?, share_desc=? where act_id=?";
        $stmt = $db->prepare($sql);
        
        print_r($params);
        $stmt->bind_param("sssi", $params['title'],$params['img-url'],$params['desc'],$params['actid'] );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    public function getShare( $actid ){
        $db = $this->getDb();
        
        $sql = "select * from share where act_id=$actid";
        
        $item = null;
        if( (boolean)$result = $db->query($sql) ){
            if( (boolean)$item = $result->fetch_assoc() ){
        
            }
        
            $result->free();
        }
        
        $db->close();
        return $item;
    }
    
    public function checkRule( $actid ){
        $db = $this->getDb();
        $sql = "select count(*) from rule where act_id=?";
        $stmt = $db->prepare($sql);
        
        $stmt->bind_param("i", $actid );
        $stmt->execute();
        
        $count = 0;
        $stmt->bind_result($count);
        
        if( $stmt->fetch() ){
             
        }
        
        $stmt->close();
        $db->close();
        return $count;
    }
    public function getRule( $actid ){
        $db = $this->getDb();
        
        $sql = "select * from rule where act_id=$actid";
        
        $item = null;
        if( (boolean)$result = $db->query($sql) ){
            if( (boolean)$item = $result->fetch_assoc() ){
        
            }
        
            $result->free();
        }
        
        $db->close();
        return $item;
    }
    public function getRuleDetail( $ruleid ){
        $db = $this->getDb();
        
        $sql = "select * from rule_detail where rule_id=$ruleid";
        
        $arr = array();
        $ix = 0;
        $item = null;
        if( (boolean)$result = $db->query($sql) ){
            while( (boolean)$item = $result->fetch_assoc() ){
                $arr[$ix++] = $item;
            }
        
            $result->free();
        }
        $db->close();
        return $arr;
    }
    public function updateRule( $params ){
        $db = $this->getDb();
        $sql = "UPDATE rule SET rule_title=?, rule_desc=? where act_id=?";
        $stmt = $db->prepare($sql);
        
        print_r($params);
        $stmt->bind_param("ssi", $params['name'],$params['desc'],$params['actid'] );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    public function insertRule( $params ){
        $db = $this->getDb();
        $sql = "INSERT INTO rule(date,rule_title,rule_desc,act_id) VALUES (?,?,?,?)";
        $stmt = $db->prepare($sql);
        
        print_r($params);
        $stmt->bind_param("sssi", (new \DateTime('NOW'))->format("c"),$params['name'],$params['desc'],$params['actid'] );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    public function updateRuleDetail( $params,$leng ){
        $db = $this->getDb();
        $sql = "UPDATE rule_detail SET rule_content=? where rule_id=? and rule_detail_id=?";
        $stmt = $db->prepare($sql);
          
        $ix = 1;
        while( $ix <= $leng ){
            $stmt->bind_param("sii", $params['ruledetail'][$ix-1],$params['ruleid'],$ix );
            $stmt->execute();
            
            if( $stmt->fetch() ){
                 
            }
            
            $ix ++;
        }
        
        $stmt->close();
        $db->close();
        return $ix-1;
    }
    public function insertRuleDetail( $params,$d_ix ){
        $db = $this->getDb();
        $sql = "INSERT INTO rule_detail(rule_detail_id,rule_id,rule_content) VALUES(?,?,?)";
        $stmt = $db->prepare($sql);
    
        $list = $params['ruledetail'];
        $leng = count($list);
        
        while( $d_ix <= $leng ) {
            $stmt->bind_param("iis", $d_ix,$params['ruleid'],$list[$d_ix-1] );
            $stmt->execute();
            if( $stmt->fetch() ){
                 
            }
            $d_ix++;
        }
    
        $stmt->close();
        $db->close();
    }
    public function deleteRuleDetail( $params ){
        $db = $this->getDb();
        $sql = "DELETE FROM rule_detail WHERE(rule_detail_id>? AND rule_id=?)";
        $stmt = $db->prepare($sql);
        
        $cout = count($params['ruledetail']);
        $stmt->bind_param("ii",$cout,$params["ruleid"] );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    
    public function getFoods( $actid ){
        $db = $this->getDb();
        
        $sql = "select * from act_food where act_id=$actid";
        
        $item = null;
        if( (boolean)$result = $db->query($sql) ){
            if( (boolean)$item = $result->fetch_assoc() ){
        
            }
        
            $result->free();
        }
        
        $db->close();
        return $item;
    }
    public function checkFood( $foodid ){
        $db = $this->getDb();
        $sql = "select count(*) from food where food_id=?";
        $stmt = $db->prepare($sql);

        echo "params:";
        print_r($foodid);
        echo "<br>";
        
        $stmt->bind_param("s", $foodid );
        $stmt->execute();
        
        $count = 0;
        $stmt->bind_result($count);
        
        if( $stmt->fetch() ){
             
        }
        
        echo 'co:    '.$count;
        $stmt->close();
        $db->close();
        return $count;
    }
    public function getFood( $foodid ){
        $db = $this->getDb();
        
        $sql = "select * from food where food_id=$foodid";
        
        $item = null;
        if( (boolean)$result = $db->query($sql) ){
            if( (boolean)$item = $result->fetch_assoc() ){
        
            }
        
            $result->free();
        }
        
        $db->close();
        return $item;
    }
    public function updateFood( $params ){
        $db = $this->getDb();
        $sql = "UPDATE food SET food_name=?, food_desc=?,food_img_url=? where food_id=?";
        $stmt = $db->prepare($sql);
        
        print_r($params);
        $stmt->bind_param("sssi", $params['food-name'],$params['food-desc'],$params['food-img-url'],$params['foodid'] );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    public function insertFood( $params ){
        $db = $this->getDb();
        $sql = "INSERT INTO food(food_name,food_desc,food_img_url) VALUES (?,?,?)";
        $stmt = $db->prepare($sql);
        
        print_r($params);
        $stmt->bind_param("sss", $params['food-name'],$params['food-desc'],$params['food-img-url'] );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $id = $stmt->insert_id;
        
        $stmt->close();
        $db->close();
        
        return $id;
    }
    public function insertFoodMats( $params ){
        $db = $this->getDb();
        $sql = "INSERT INTO food_detail(food_id,material_id,material_kg) VALUES (?,?,?)";
        $stmt = $db->prepare($sql);
        
        echo 'insertMats:';
        print_r($params);
        echo "<br>";
        
        foreach ( $params['materials'] as $key=>$value ){
            if( (int)$value > 0 ){
                $stmt->bind_param("iii", $params['foodid'],$key,$value );
                $stmt->execute();
                
                if( $stmt->fetch() ){
                     
                }
                
            }
        }

        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    public function updateFoodMats( $params ){
        $db = $this->getDb();
        $sql = "UPDATE food_detail SET material_kg=? where food_id=? and material_id=?";
        $stmt = $db->prepare($sql);
        
        foreach ( $params['materials'] as $key=>$value ){
            //if( (int)$value > 0 ){
                $stmt->bind_param("iii", $value,$params['foodid'],$key );
                $stmt->execute();
        
                if( $stmt->fetch() ){
                     
                }
        
            //}
        }
        
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    public function fiterFoodMats( $foodid ){
        $db = $this->getDb();
        $sql = "DELETE FROM food_detail WHERE food_id=? AND material_kg<1";
        $stmt = $db->prepare($sql);
        
        $stmt->bind_param("i",$foodid );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $rows = $stmt->affected_rows;
        
        $stmt->close();
        $db->close();
        
        return $rows;
    }
    
    public function getActFoods( $actid ){
        $db = $this->getDb();
        
        $sql = "select food_img_url,food_name,act_id,food.food_id,kg,max_kg,min_kg from food,act_food where food.food_id = act_food.food_id and act_id=".$actid;
        
        $arr = array();
        $ix = 0;
        $item = null;
        if( (boolean)$result = $db->query($sql) ){
            while( (boolean)$item = $result->fetch_assoc() ){
                $arr[$ix++] = $item;
            }
        
            $result->free();
        }
        $db->close();
        return $arr;
    }
    public function insertActFood( $actid,$foodid ){
        $db = $this->getDb();
        $sql = "INSERT INTO act_food(act_id,food_id) VALUES (?,?)";
        $stmt = $db->prepare($sql);
        
        $stmt->bind_param("ii", $actid,$foodid );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $id = $stmt->insert_id;
        
        $stmt->close();
        $db->close();
        
        return $id;
    }
    
    public function insertMaterial( $params ){
        $db = $this->getDb();
        $sql = "INSERT INTO food_material(material_name,material_img_url) VALUES (?,?)";
        $stmt = $db->prepare($sql);
        
        $stmt->bind_param("ss", $params['name'],$params['img-url'] );
        $stmt->execute();
        
        if( $stmt->fetch() ){
             
        }
        $id = $stmt->insert_id;
        
        $stmt->close();
        $db->close();
        
        return $id;
    }
    
    public function getMaterials($foodid){
        $db = $this->getDb();
        
        $fid = isset($foodid)?$foodid:'NULL';
        $sql = "SELECT	a.material_id,a.material_name,a.material_img_url,b.material_kg FROM	food_material a LEFT JOIN (SELECT	* FROM	food_detail	WHERE food_id = ".$fid.")b ON a.material_id = b.material_id";
        
        $arr = array();
        $ix = 0;
        $item = null;
        if( (boolean)$result = $db->query($sql) ){
            while( (boolean)$item = $result->fetch_assoc() ){
                $arr[$ix++] = $item;
            }
        
            $result->free();
        }
        
        $db->close();
        return $arr;
    }
    
    public function countRuleDetail( $ruleid ){
        $db = $this->getDb();
        $sql = "select count(*) from rule_detail where rule_id=?";
        $stmt = $db->prepare($sql);
        
        $stmt->bind_param("i", $ruleid );
        $stmt->execute();
        
        $count = 0;
        $stmt->bind_result($count);
        
        if( $stmt->fetch() ){
             
        }
        
        $stmt->close();
        $db->close();
        return $count;
    }
    
    //获取数据库
    public function getDb(){
        $dbPara = $this->getConfigPara()['db'];

        @$db = new \mysqli($dbPara['url'],$dbPara['user'],$dbPara['password'],$dbPara['dbname'],$dbPara['port']);
        $db->query("set names utf8");
        
        if( mysqli_connect_errno() )
            throw new \Exception("db load error");
        else return $db;
    }
      
    //获取参数
    public function getConfigPara(){
        $ini = parse_ini_file("config.ini",true);
        return $ini;
    }
    
    //检测用户
    public function checkUser(){
    
    }
}

?>