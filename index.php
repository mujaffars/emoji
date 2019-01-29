<?php
$dir = 'EmojiOne4';
$cnt = 0;
$shown = false;
// Open a directory, and read its contents

if (count($_POST)) {
    $imagePath = $dir . "/" . $_POST['oldfilename'];
    $newPath = "ext/";
    $ext = '.png';
    $newName = $newPath . $_POST['filename'] . "_" . generateRandomString() . $ext;

    if (isset($_POST['filename']) && $_POST['filename'] !== "") {
        $copied = copy($imagePath, $newName);
    }else{
        $copied = true;
    }
    if ((!$copied)) {
        echo "Error : Not Copied";
    } else {
        unlink($imagePath);
    }
}

if (1) {
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($cnt > 1 && !$shown) {
                    ?>
                    <form name="changename" method="post" style="margin: 0 auto; text-align: center;">
                        <img src="EmojiOne4/<?php echo $file; ?>"/><br/><br/>
                        <input type="hidden" name="oldfilename" id="oldfilename" value="<?php echo $file; ?>"/>
                        <input type="text" name="filename" tabindex="1" autofocus id="filename" value=""/>
                        <input type="submit" value="submit"/>
                    </form>
                    <?php
                    $shown = true;
                }
                $cnt++;
            }
            closedir($dh);
        }
    }
}

function generateRandomString($length = 4) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>