<?php
class Format
{
    private $data = [];
    private $highRails = [];  # 高铁 动车
    private $ordinaryRails = []; # 直达 特快 快速 其他
    private $highSpeedRails = []; # 高铁
    private $moveSpeedRails = []; # 动车
    private $directlyRails = []; # 直达
    private $specialRails = []; # 特快
    private $fastRails = []; # 快速
    private $otherRails = []; # 其他
    
    public function __construct($sourceData)
    {
        $this->data = []; 
        $sourceData = json_decode($sourceData, true);
        foreach ($sourceData['data'] as $info) {
            if ($info['queryLeftNewDTO']['canWebBuy'] != 'N') {
                $this->data[] = $info['queryLeftNewDTO'];
                $this->checkCategory($info['queryLeftNewDTO']);
            }
        }
    }

    public function checkCategory($info)
    {
        $name = $info['station_train_code']{0};
        switch($name){
            case 'G':
                $this->highSpeedRails[] = $info;
            break;
            case 'D':
                $this->moveSpeedRails[] = $info;
            break;
            case 'T':
                $this->specialRails[] = $info;
            break;
            case 'Z':
                $this->directlyRails[] = $info;
            break;
            case 'K':
                $this->fastRails[] = $info;
            break;
            default :
                $this->otherRails[] = $info;
            break;
        }
        if (in_array($name, ['G', 'D'])) {
            $this->highRails[] = $info; 
        } else {
            $this->ordinaryRails[] = $info; 
        }
    }

    public function getHighRails()
    {
        return $this->highRails;
    }

    public function getOrdinaryRails()
    {
        return $this->ordinaryRails;
    }

    public function getHighSpeedRails()
    {
        $this->highSpeedRails;
    }

    public function getmoveSpeedRails()
    {
        $this->moveSpeedRails;
    }

    public function getDirectlyRails()
    {
        $this->directlyRails;
    }

    public function getSpecialRails()
    {
        $this->specialRails;
    }

    public function getFastRails()
    {
        $this->fastRails;
    }

    public function getOtherRails()
    {
        $this->otherRails;
    }
}
