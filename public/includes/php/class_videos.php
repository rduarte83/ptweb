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

}
?>