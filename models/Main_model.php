<?php


class MainModel extends BaseModel
    {

        private $conn = 'Some model.';

        function __construct()
        {   
            $this->conn = $this->connect();
        }

        public function parse_where($sql,$where){
            $sql_where='';
            $i=0;

            foreach($where as $key=>$value){
                $tmp='';
                if($i!==0){
                    $sql_where.=" AND "; 
                }
                $special=false;
                if(strpos($key, '!') !== false){
                    $tmp =$key;
                    $key = str_replace('!','', $key);
                    $sql_where.= " $key <> :$key";
                    if(!empty($where[$key]) && $where[$key]!==$value){
                        $sql_where.= " $key <> :".$key.($i+1);
                        $key=$key.($i+1);
                    }else{
                        $sql_where.= " $key <> :$key";
                    }
                    $where[$key]=$value;
                    unset($where[$tmp]);
                    $special=true;
                }
                if(strpos($key, '<') !== false){
                    $tmp =$key;
                    if(strpos($key, '<=') !== false){

                        $key = str_replace('<=','', $key);
                        if(!empty($where[$key]) && $where[$key]!==$value){
                            $sql_where.= " $key <= :".$key.($i+1);
                            $key=$key.($i+1);
                        }else{
                            $sql_where.= " $key <= :$key";
                        }

                    }else{
                        $key = str_replace('<','', $key);
                        if(!empty($where[$key]) && $where[$key]!==$value){
                            $sql_where.= " $key < :".$key.($i+1);
                            $key=$key.($i+1);
                        }else{
                            $sql_where.= " $key < :$key";
                        }
                    }
                    $where[$key]=$value;
                    unset($where[$tmp]);
                    $special=true;
                }
                if(strpos($key, '>') !== false){
                    $tmp =$key;
                    if(strpos($key, '>=') !== false){
                        $key = str_replace('>=','', $key);
                        if(!empty($where[$key]) && $where[$key]!==$value){
                            $sql_where.= " $key >= :".$key.($i+1);
                            $key=$key.($i+1);
                        }else{
                            $sql_where.= " $key >= :$key";
                        }

                    }else{
                        $key = str_replace('>','', $key);
                        if(!empty($where[$key]) && $where[$key]!==$value){
                            $sql_where.= " $key > :".$key.($i+1);
                            $key=$key.($i+1);
                        }else{
                            $sql_where.= " $key > :$key";
                        }

                    }
                    $where[$key]=$value;
                    unset($where[$tmp]);
                    $special=true;

                }


                if(!$special){
                    if(!empty($where[$key]) && $where[$key]!==$value){
                        $sql_where.= " $key = :".$key.($i+1);
                        $key=$key.($i+1);
                        $where[$key]=$value;
                    }else{
                        $sql_where.= " $key = :$key";
                    }
                }

                $i++;
            }
            $sql.=" WHERE ".$sql_where;
            return [$sql,$where];
        }

    public function parse_join_where($sql,$where){
        $sql_where='';
        $i=0;

        foreach($where as $key=>$value){
            $tmp='';
            if($i!==0){
                $sql_where.=" AND ";
            }
            $special=false;
            if(strpos($key, '!') !== false){
                $tmp =$key;
                $key = str_replace('!','', $key);
                $variable_name = explode('.', $key)[1];
                if(!empty($where[$variable_name]) && $where[$variable_name]!==$value){
                    $sql_where.= " $key <> :".$variable_name.($i+1);
                    $variable_name=$variable_name.($i+1);
                }else{
                    $sql_where.= " $key <> :$variable_name";
                }
                $where[$variable_name]=$value;
                unset($where[$tmp]);
                $special=true;
            }
            if(strpos($key, '<') !== false){
                $tmp =$key;
                if(strpos($key, '<=') !== false){

                    $key = str_replace('<=','', $key);
                    $variable_name = explode('.', $key)[1];

                    if(!empty($where[$variable_name]) && $where[$variable_name]!==$value){
                        $sql_where.= " $key <= :".$variable_name.($i+1);
                        $variable_name=$variable_name.($i+1);
                    }else{
                        $sql_where.= " $key <= :$variable_name";
                    }

                }else{
                    $key = str_replace('<','', $key);
                    $variable_name = explode('.', $key)[1];
                    if(!empty($where[$variable_name]) && $where[$variable_name]!==$value){
                        $sql_where.= " $key < :".$variable_name.($i+1);
                        $variable_name=$variable_name.($i+1);
                    }else{
                        $sql_where.= " $key < :$variable_name";
                    }
                }
                $where[$variable_name]=$value;
                unset($where[$tmp]);
                $special=true;
            }
            if(strpos($key, '>') !== false){
                $tmp =$key;
                if(strpos($key, '>=') !== false){
                    $key = str_replace('>=','', $key);
                    $variable_name = explode('.', $key)[1];
                    if(!empty($where[$variable_name]) && $where[$variable_name]!==$value){
                        $sql_where.= " $key >= :".$variable_name.($i+1);
                        $variable_name=$variable_name.($i+1);
                    }else{
                        $sql_where.= " $key >= :$variable_name";
                    }

                }else{
                    $key = str_replace('>','', $key);
                    $variable_name = explode('.', $key)[1];
                    if(!empty($where[$variable_name]) && $where[$variable_name]!==$value){
                        $sql_where.= " $key > :".$variable_name.($i+1);
                        $variable_name=$variable_name.($i+1);
                    }else{
                        $sql_where.= " $key > :$variable_name";
                    }

                }
                $where[$variable_name]=$value;
                unset($where[$tmp]);
                $special=true;

            }


            if(!$special){
                $variable_name = explode('.', $key)[1];
                if(!empty($where[$variable_name]) && $where[$variable_name]!==$value){

                    $sql_where.= " $key = :".$variable_name.($i+1);
                    $variable_name=$variable_name.($i+1);
                    $where[$variable_name]=$value;
                }else{
                    $sql_where.= " $key = :$variable_name";
                }
            }

            $i++;
        }
        $sql.=" WHERE ".$sql_where;
        return [$sql,$where];
    }

        public function retrieve_all($table, $columns, $where=null, $extra=null){
            $sql = "SELECT $columns FROM $table";
            if($where!=null){
                $sql = $this->parse_where($sql, $where);

                $where = $sql[1];
                $sql = $sql[0];
            }
            if($extra!=null){
                $sql .= ' '.$extra;
            }


            $stmt = $this->conn->prepare($sql);
            $stmt->execute($where);

            $rows = $stmt->fetchAll();
            return (object)$rows;
        }

        public function retrieve_all_with_join($table, $columns, $join, $where=null, $extra=null){
            $sql = "SELECT $columns FROM $table a INNER JOIN ".$join['table']." b ON ".$join['clause'];
            if($where!=null){
                $sql = $this->parse_join_where($sql, $where, $join);

                $where = $sql[1];
                $sql = $sql[0];
            }
            if($extra!=null){
                $sql .= ' '.$extra;
            }

            if($extra!=null){
                $sql .= ' '.$extra;
            }
//            print_r($where);
//            echo "<br>";
//            echo $sql;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($where);

            $rows = $stmt->fetchAll();
            return (object)$rows;
        }

        public function retrieve_row($table, $columns, $where=null){
            $sql = "SELECT $columns FROM $table";
            if($where!=null){
                $sql = $this->parse_where($sql, $where);
                $where = $sql[1];
                $sql = $sql[0];
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($where);
            $rows = $stmt->fetch();
            return (object)$rows;
        }

        public function insert_data($table, $data, $id=null){
            $keys = [];
            foreach($data as $key => $value){
                $keys[]= ':'.$key;

            }
            $sql = "INSERT INTO $table(".implode(', ',array_keys($data)).") values(".implode(', ',$keys).")";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            if($id==true){
                $last_id = $this->conn->lastInsertId();
                return $last_id;
            }else{
                return true;
            }
        }

        public function update_row($table, $data, $where=null){
            $set= [];
            foreach($data as $key => $value){
                $value= str_replace("'","''", $value);
                $set[]=$key.'='.":$key";
            }
            $sql = "UPDATE $table set ".implode(', ',$set);

            if($where!=null){
                $sql = $this->parse_where($sql, $where);
                $where = $sql[1];
                $sql = $sql[0];
            }
            $stmt = $this->conn->prepare($sql);

            $stmt->execute(array_merge($data,$where));
            return true;
        }

        public function delete($table,$where){
            $sql = "DELETE FROM $table";
            $sql = $this->parse_where($sql, $where);
            $where = $sql[1];
            $sql = $sql[0];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($where);
            return true;
        }

        public function check_if_exists($table, $columns,  $where){
            $sql = "SELECT $columns FROM $table";
            $sql = $this->parse_where($sql, $where);
            $where = $sql[1];
            $sql = $sql[0];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($where);
            $rows = $stmt->fetch();
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }