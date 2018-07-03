<?php

class Videos
{
    public static function insertVideoArtigo($id_artigo)
    {
        $allowedExts = array("mp3", "mp4", "wmv");
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        if (    (($_FILES["file"]["type"] == "video/mp4")
            || ($_FILES["file"]["type"] == "audio/mp3")
            || ($_FILES["file"]["type"] == "video/wmv"))
                    && ($_FILES["file"]["size"] < 50000)
                    && in_array($extension, $allowedExts))

        {
            if ($_FILES["file"]["error"] > 0)
            {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            }
            else
            {
                echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                echo "Type: " . $_FILES["file"]["type"] . "<br />";
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

                if (file_exists("upload/" . $_FILES["file"]["name"]))
                {
                    echo $_FILES["file"]["name"] . " already exists. ";
                }
                else
                {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                    "upload/" . $_FILES["file"]["name"]);
                    echo "Stored in: " . "upload/" . $_FILES["file"]["name"];

                    $db = new Database();
                    $arrParam = [
                        ":url" => "upload/" . $_FILES["file"]["name"],
                        ":id_artigo" => intval($id_artigo)
                    ];

                    $sql = "INSERT INTO video_artigo (url, id_artigo) VALUES (:url, :id_artigo)";
                    $result = $db->EXE_NON_QUERY($sql,$arrParam, false);
                }
            }
        }
        else
        {
            echo "Invalid file";
        }
    }

    public static function insertVideoTreino($id_treino, $desc)
    {
        $arrMensagem = [
            "status"=>0, 
            "message"=>""
        ];

        if(empty($_FILES))
            return;

        $folder = "../uploads/";

        if(!file_exists($folder)){
            mkdir($folder, 777);
        } 
        $db = new Database();
        foreach ($_FILES as $file){
            for ( $i=0; $i < count($file["tmp_name"]); $i++ ){
                if($file["tmp_name"][$i]){
                    $tipo = $file["type"][$i];
                    if(strstr($tipo, "video/")){
                        $extencao = strchr($file["name"][$i],'.');
                        $filename = md5(time()).$extencao;
                        
                        if(move_uploaded_file($file["tmp_name"][$i], $folder.$filename)){
                            //echo "Ficheiro submetido";
                            // Primeiro Inserir o video nos videos
                            $arrParamVideo = [
                                ":urlSite" =>  $_SERVER["HTTP_ORIGIN"].substr($_SERVER["REQUEST_URI"],0,strrpos($_SERVER["REQUEST_URI"], '/'))."/".$folder.$filename,
                                ":descp" => $desc,
                            ];

                            /*echo $_SERVER["HTTP_ORIGIN"].substr($_SERVER["REQUEST_URI"],0,strrpos($_SERVER["REQUEST_URI"], '/'))."/".$folder.$filename;*/
                            //echo strlen($_SERVER["HTTP_ORIGIN"].substr($_SERVER["REQUEST_URI"],0,strrpos($_SERVER["REQUEST_URI"], '/'))."/".$folder.$filename);
                            $sql = "INSERT INTO video (url, descricao) VALUES (:urlSite, :descp) RETURNING id";
                            $result = $db->EXE_NON_QUERY($sql,$arrParamVideo, false);

                            // Arranjar ID do video que foi upload e pôr na tabela treino video
                            $id_video = $result->fetch(PDO::FETCH_ASSOC);

                            $arrParamVideoTreino = [
                                ":id_treino" =>  intval($id_treino),
                                ":id_video" => intval($id_video["id"])
                            ];

                            $sql = "INSERT INTO treino_video (treinoid, videoid) VALUES (:id_treino, :id_video)";
                            $result = $db->EXE_NON_QUERY($sql,$arrParamVideoTreino, false);
                            $arrMensagem["message"] = $arrMensagem["message"] . "Ficheiro " . $file["name"][$i] . " submetido com sucesso <br>";
                            $arrMensagem["status"] = 1;


                        }else {
                            $arrMensagem["message"] .= "Erro ao submeter o ficheiro ". $file["name"][$i] . "<br>";
                            $arrMensagem["status"] = 0;
                        }
                    }else {
                        $arrMensagem["message"] .= "Tipo de ficheiro " . $file["name"][$i] ." inválido <br>";
                        $arrMensagem["status"] = 0;
                    }
                }
            }
        }
        return $arrMensagem;
        
    }

}
?>