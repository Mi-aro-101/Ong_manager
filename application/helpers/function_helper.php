<?php
        //FUNCTION FOR ERROR
        function fusion($tab, $table){
            $temp=$tab;
            for ($i=0; $i < count($table); $i++) {
                $temp[]=$table[$i];
            }
            return $temp;
        }

        function vide($value, $name){
            $valiny=strtoupper(splitMe($name));
            if($value===""){return "Vous devez remplir $valiny pour pouvoir continuer";}
            return false;
        }

        function emptyTable($tableValue, $name){
            $error=array();
            for ($i=0; $i < count($tableValue); $i++) {
                if(vide($tableValue[$name[$i]], $name[$i])!==false){$error[]=vide($tableValue[$name[$i]], $name[$i]);}
            }return $error;
        }

        function namepost($name){
            $data=array();
            for ($i=0; $i < count($name); $i++) {
                $data[$name[$i]]=getPost($name[$i]);
            }
            return $data;
        }

        function splitMe($value){
            $parts = preg_split('/(?<=[a-z])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][a-z])/', $value);
            $valiny="";
            for ($i=0; $i < count($parts); $i++) {
                $valiny.=$parts[$i]." ";
            }
            return $valiny;
        }

        //EXCEPTION FOR THE DATE
        function getErrorDate($name){
            $error=array();$post=getAllPostValue($name);
            for ($i=0; $i < count($post); $i++) {
                $temp=getDateFromArrayString($post, $i);
                if($temp!=null){
                    $now=new DateTime();$space=strtoupper(splitMe($name[$i]));
                    $format=$now->format('Y-m-d');
                    if($temp>$now){$error[]="$space doit etre $format ou avant";}
                }
            }
            return $error;
        }

        function getDateFromArrayString($array, $ind){
            $temp=$array[$ind]; $valiny="";
            if($temp==""){return null;}
            try {
                $valiny=new DateTime($temp);
            } catch (Exception $th) {
                return null;
            }
            return new DateTime($temp);
        }

        function getAllPostValue($postName){
            $valiny=array();
            for ($i=0; $i < count($postName); $i++) {
                $valiny[]=getPost($postName[$i]);
            }
            return $valiny;
        }
        //END
        function getPost($name){
            return $_POST[$name];
        }
        //END
?>
