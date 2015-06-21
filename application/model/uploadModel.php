<?php

  class UploadModel
  {

    public function uploadImg($image)
    {

      function uploadimg($image, $extension)
      {
        $new_filename = substr(md5(uniqid(rand(), true)), 14) ."." .$extension;
        move_uploaded_file($image["tmp_name"], getcwd() ."\\public\\img\\" .$new_filename);

        return $new_filename;
      }

      $img_info = getimagesize($image["tmp_name"]);
      switch($img_info["mime"])
      {
        case "image/jpeg":
            $img_name = array(true, uploadimg($image, "jpg"));
          break;
        case "image/png":
            $img_name = array(true, uploadimg($image, "png"));
          break;
        case "image/gif":
            $img_name = array(true, uploadimg($image, "gif"));
          break;

        default:
          $img_name = array(false, "Bildformat wird nicht unterstützt.");
      }

      return $img_name;
    }
  }

?>
