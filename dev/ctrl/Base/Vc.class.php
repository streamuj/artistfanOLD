<?php
/**
 * @author Tanya
 */

class Base_Vc extends Base
{

    public function __construct($glObj)
    {
        parent :: __construct($glObj);
    }

    /**
     * move processed videos and thumbnailes and delete them from queue
     * @return void
     */
    public function GetProcessedVideo()
    {
        $conf = include($this->GetRootPath() . 'dev/db/build/conf/artistfan-conf.php');
        
        //connect to vc base
        $gPdo = new PDO(VBASE, $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
        $gPdo->query('SET CHARACTER SET utf8');

        $limit = 10;

        $converted_from = array();
        $ids = array();
        
        //get $limit processed video
        $stmnt = $gPdo->query("SELECT id, from_fname, to_fname FROM " . VTABLE . " WHERE cdate > 0 AND in_proc = 0 LIMIT " . $limit);
        if($stmnt)
        {
            while ($v = $stmnt->fetch(PDO::FETCH_ASSOC))
            {
                $converted_from[] = $v['from_fname'];
                $ids[] = $v['id'];
            }
            unset($stmnt);
            unset($v);

            if(count($ids) > 0)
            {
                //delete found records from queue
                $gPdo->query("DELETE FROM " . VTABLE . " WHERE id IN(" . implode(', ', $ids) . ")");
            }
        }
        $gPdo = null;

        if(count($converted_from) > 0)
        {
            //connect to artistfan base
            $gPdo = new PDO($conf['datasources']['artistfan']['connection']['dsn'], $conf['datasources']['artistfan']['connection']['user'], $conf['datasources']['artistfan']['connection']['password']);
            $gPdo->query('SET CHARACTER SET utf8');

            include_once $this->GetRootPath() . 'libs/Crop/Image_Transform.php';
            include_once $this->GetRootPath() . 'libs/Crop/Image_Transform_Driver_GD.php';
            foreach($converted_from as $item)
            {   
                //select video from video table
                $stmnt = $gPdo->query("SELECT * FROM video WHERE video = '" . $item . "' OR video_preview = '" . $item . "'");
                if($stmnt)
                {
                    $v = $stmnt->fetch(PDO::FETCH_ASSOC);
                    if($item == $v['video_preview'])
                    {
                        $video_name = substr($v['video_preview'], 0, strrpos($v['video_preview'], '.'));
                        //move processed file
                        $dir = MakeUserDir('files/video/u', $v['user_id'], $this->GetRootPath());
                        copy(VPATH . 'result/video/' . $v['video_preview'] . '.mp4', $this->GetRootPath() . $dir . '/' . $video_name . '.mp4');
                        @unlink(VPATH . 'result/video/' . $v['video_preview'] . '.mp4');

                        //update record in video table
                        //check processed main video file
                        $video_name1 = substr($v['video'], 0, strrpos($v['video'], '.'));
                        if(file_exists($this->GetRootPath() . $dir . '/' . $video_name1 . '.mp4'))
                        {
                            //set status equal 2
                            $gPdo->query("UPDATE video SET video_preview = '" . $video_name . ".mp4', status = 2 WHERE id = " . $v['id']);
                        }
                        else
                        {
                            //update only filename
                            $gPdo->query("UPDATE video SET video_preview = '" . $video_name . ".mp4' WHERE id = " . $v['id']);
                        }
                    }
                    else if($item == $v['video'])
                    {
                        $video_name = substr($v['video'], 0, strrpos($v['video'], '.'));

                        //move processed file
                        $dir = MakeUserDir('files/video/u', $v['user_id'], $this->GetRootPath());
                      
                        copy(VPATH . 'result/video/' . $v['video'] . '.mp4', $this->GetRootPath() . $dir . '/' . $video_name . '.mp4');
                        @unlink(VPATH . 'result/video/' . $v['video'] . '.mp4');

                        //move thumbnail image
                        $dir_th = MakeUserDir('files/video/thumbnail', $v['user_id'], $this->GetRootPath());
                        copy(VPATH . 'result/images/' . $v['video'] . '_15.jpg', $this->GetRootPath() . $dir_th . '/' . $video_name . '.mp4.jpg');
                        @unlink(VPATH . 'result/images/' . $v['video'] . '_15.jpg');

                        //make preview of image 96x96
                        i_crop_copy(96, 96, $this->GetRootPath() . $dir_th . '/' . $video_name . '.mp4.jpg',
                                $this->GetRootPath() . $dir_th . '/s_' . $video_name . '.mp4.jpg', 1);
                        //make small preview of image 22x22
                        i_crop_copy(22, 22, $this->GetRootPath() . $dir_th . '/s_' . $video_name . '.mp4.jpg',
                                $this->GetRootPath() . $dir_th . '/x_' . $video_name . '.mp4.jpg', 1);

                        //delete source file
                        @unlink(VPATH . 'source/' . $v['video']);

                        //update record in video table
                        //check processed preview video file
                        if(!empty($v['video_preview']))
                        {
                            $video_name1 = substr($v['video'], 0, strrpos($v['video_preview'], '.'));
                            if(file_exists($this->GetRootPath() . $dir . '/' . $video_name1 . '.mp4'))
                            {
                                //set status equal 2
                                $gPdo->query("UPDATE video SET video = '" . $video_name . ".mp4', status = 2 WHERE id = " . $v['id']);
                            }
                            else
                            {
                                //update only filename
                                $gPdo->query("UPDATE video SET video = '" . $video_name . ".mp4' WHERE id = " . $v['id']);
                            }
                        }
                        else
                        {
                            $gPdo->query("UPDATE video SET video = '" . $video_name . ".mp4', status = 2 WHERE id = " . $v['id']);
                        }
                    }
                }
                unset($stmnt);
                unset($v);
            }
            unset($item);
            $gPdo = null;
        }
        echo 'Complete';
    }

    /**
     * Move recording broadcasts in Influxis to permanent destination directory
     * 
     */
    public function SaveEventRecordings()
    {
        $max = 1; //count flows processed per one script start
        $flows = BroadcastFlows::GetClosedFlows($max); //get closed flows or flows older 3 hours
        if(empty($flows))
        {
            echo 'No closed flows';
            exit();
        }
        //deb($flows);
        include_once $this->GetRootPath() . 'libs/ftp/ftp.class.php';
        //connect to server
        $server = new ftp(INFLUXIS_FTP_HOST, INFLUXIS_FTP_USER, INFLUXIS_FTP_PASSWORD);
        if ($server->connect())
        {
            $list = $server->dir_list(INFLUXIS_DIRNAME_SRC);
            if(empty($list))
            {
                echo 'No recordings in Influxes';
                exit();
            }
            foreach($flows as $flow)
            {
                if(in_array(INFLUXIS_DIRNAME_SRC . '/' . $flow['Flow'] . '.mp4', $list))
                {
                    //get file from Influxes - only for events, not ad-hoc
                    if($flow['EventId'] > 0)
                    {
                        $dest_dir = INFLUXIS_DIRNAME_DEST . '/' . $flow['UserId'];
                        $dir_list = $server->dir_list(INFLUXIS_DIRNAME_DEST);
                        if(!in_array($dest_dir, $dir_list))
                        {
                            //destination directory not exists - try to create it
                            if(!$server->make_dir($dest_dir))
                            {
                                echo 'Could not create directory ' . $dest_dir . ' in Influxes';
                                continue;
                            }
                        }
                        //copy file to destination directory
                        $result = $server->copy($dest_dir . '/' . $flow['Flow'] . '.mp4', INFLUXIS_DIRNAME_SRC . '/' . $flow['Flow'] . '.mp4');
                        if($result)
                        {
                            //add db record
                            EventVideo::Add($flow['Flow'] . '.mp4', $flow['UserId'], $flow['EventId'], $flow['Pdate']);

                            //delete file from Influxes source directory
                            $server->delete(INFLUXIS_DIRNAME_SRC . '/' . $flow['Flow'] . '.mp4');

                            //update flow status
                            BroadcastFlows::SetDownloadedFlow($flow['Id']);
                        }
                        else
                        {
                            //update flow status to error
                            BroadcastFlows::SetErrorFlow($flow['Id']);
                            echo 'Could not move file in Influxes';
                        }
                    }
                    else
                    {
                        //update flow status
                        BroadcastFlows::SetDownloadedFlow($flow['Id']);
                    }
                }
                else
                {
                    //update flow status to error
                    BroadcastFlows::SetErrorFlow($flow['Id']);
                    echo 'Recording ' . INFLUXIS_DIRNAME_SRC . '/' . $flow['Flow'] . '.mp4 not found';
                }
            }
        }
        else
        {
            echo 'Could not connect to Influxes';
            exit();
        }
    }
}