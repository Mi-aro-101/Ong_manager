<?php
        error_reporting(0);
        ini_set('display_errors', '0');
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
            if($value===""){
                return "Vous devez remplir <strong>$valiny</strong>pour pouvoir continuer";}
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
        function getErrorDate($post,$name){
            $error=array();
            for ($i=0; $i < count($post); $i++) {
                $temp=getDateFromArrayString($post, $i);
                if($temp!=null){
                    $now=new DateTime();$space=strtoupper(splitMe($name[$i]));
                    $format=$now->format('Y-m-d');
                    if($temp>$now){$error[]="<strong>$space</strong> doit etre <strong>$format</strong> ou avant";}
                }
            }
            return $error;
        }

        function getDateFromArrayString($array, $ind){
            $temp=$array[$ind]; $valiny="";
            if($temp==null){return null;}
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
            // $temp="";
            // if(isset($_POST[$name])){$temp=$_POST[$name];}
            // return $temp;
            return $_POST[$name];
        }

        function insertPosition($data, $indString, $index){
            for ($i=0; $i < count($indString); $i++) { 
                $valiny[$indString[$i]]=$data[$indString[$i]][$index];
            }
            return $valiny;
        }

        //SPECIFIC FUNCTION FOR HELPING INSERT INDIVIDU
        function getDataIndividu($ind){
            $index=((int)$ind)%2;
            $name=array('nom','prenom','dateNaissance'
            ,'lieuNaissance','nationaliteIndividu','idSituationMatrimoniale','adressePersonelle'
            ,'emploi','societeEmployeur', 'experienceHumanitaire', 'telephone',
            'mail');
            $data=namepost($name);
            $data=insertPosition($data,$name, $index);
            return $data;
        }

        function getErrorIndividu($ind){
            $index=$ind;
            $name=array('nom','prenom','dateNaissance'
            ,'lieuNaissance','nationaliteIndividu','idSituationMatrimoniale','adressePersonelle'
            ,'emploi','societeEmployeur', 'experienceHumanitaire', 'telephone',
            'mail');
            $data=namepost($name);
            $data=insertPosition($data,$name,$index);
            $empty=emptyTable($data, $name);
            $data=StringToIndexKey($data,$name);
            var_dump($empty);
            return fusion($empty, getErrorDate($data,$name));
        }

        function StringToIndexKey($data,$name){
            $valiny=array();
            for ($i=0; $i < count($name); $i++) { 
                $temp=$data[$name[$i]];
                if($temp==null){$temp="";}
                $valiny[]=$temp;
            }
            return $valiny;
        }
        //END
        //END
?>
