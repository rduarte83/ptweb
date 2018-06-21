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

        if(empty($_FILES))
            return;
            
        foreach ($_FILES as $file){
            var_dump($file);
            $allowedExts = array("mp3", "mp4", "wmv");
            //$extension = pathinfo($file['file']['name'], PATHINFO_EXTENSION);

            if (    (($file["type"][0] == "video/mp4")
                || ($file["type"][0]  == "audio/mp3")
                || ($file["type"][0]  == "video/wmv"))
                        && ($file["size"][0]  < 100000))

            {
                if ($file["error"][0] > 0)
                {
                    echo "Return Code: " . $file["error"][0] . "<br />";
                }
                else
                {
                    echo "Upload: " . $file["file"]["name"] . "<br />";
                    echo "Type: " . $file["file"]["type"] . "<br />";
                    echo "Size: " . ($file["file"]["size"] / 1024) . " Kb<br />";
                    echo "Temp file: " . $file["file"]["tmp_name"] . "<br />";

                    if (file_exists("upload/" . $file["file"]["name"]))
                    {
                        echo $file["file"]["name"] . " already exists. ";
                    }
                    else
                    {
                        move_uploaded_file($file["file"]["tmp_name"],
                        "upload/" . $file["file"]["name"]);
                        echo "Stored in: " . "upload/" . $file["file"]["name"];

                        $db = new Database();
                        $arrParam = [
                            ":url" => "upload/" . $file["file"]["name"],
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
        
    }

}
?>