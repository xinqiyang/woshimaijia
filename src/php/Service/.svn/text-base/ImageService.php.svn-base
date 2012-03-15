<?php

/**
 * Image service
 * @author xinqiyang
 *
 */
class ImageService  {

    public static function dataNewImages($image_id, $icon = 'm') {
        switch ($icon) {
            case 's': //22
                $end = '-s';
                break;
            case 'm': //48
                $end = '-m';
                break;
            case 'l': //100
                $end = '-l';
                break;
            case 'a': //原来的尺寸
                $end = '';
                break;
            case 'b':
                $end = '-brand';
                break;
            case 'p': //原来的尺寸
                $end = '-p';
                break;
        }
        $url = C('imageservice.url') . '/image/' . $image_id . '.jpg' . $end;
        return $url;
    }

    public static function actSave($imageurl = '', $account_id = '') {
        //add image url
        try {
            $imagePath = C('image.image');
            $id = objid();
            $filename = $id . '.jpg';
            //本地保存一份
            $path = $imagePath['path'] . 'image' . DIRECTORY_SEPARATOR . $filename;
            if (empty($imageurl)) {
                //这里识别上传的文件
                //@TODO:这里需要修改的地方
                $r = move_uploaded_file($_FILES['bigAvatar']['tmp_name'], $path);
            } else {
                file_put_contents($path, file_get_contents($imageurl));
            }
            //上传数据到图片云
            $img = Base::instance('ImageUpload');
            $save = $img->save($account_id, $filename, $path, $id);
            if (isset($save['code']) && $save['code'] !== Error::SUCCESS) {
                logNotice(__CLASS__ . '/' . __FUNCTION__ . ":SAVE IMAGE ERROR %s %s %s %s %s", $filename, $path, $id, userID());
            }
            logDebug('UPLOAD FILE ID  %s  CODE %s', $id, $save['code']);
            return $id;
        } catch (MException $e) {
            logWarning(__CLASS__ . '/' . __FUNCTION__ . ':' . $e->__toString());
            return false;
        }
    }

}
