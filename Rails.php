<?php
class Rails
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

    private $format;
    
    public function __construct($sourceData)
    {
        $this->format = new Format();
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

    public function getHighRails($hide = false)
    {
        return $this->format->getHighRails($this->highRails, $hide);
    }

    public function getOrdinaryRails($hide = false)
    {
        return $this->format->getOrdinaryRails($this->ordinaryRails, $hide);
    }

    public function getHighSpeedRails($hide = false)
    {
        return $this->format->getHighRails($this->highSpeedRails, $hide);
    }

    public function getmoveSpeedRails($hide = false)
    {
        return $this->format->getHighRails($this->moveSpeedRails, $hide);
    }

    public function getDirectlyRails($hide = false)
    {
        return $this->format->getOrdinaryRails($this->directlyRails, $hide);
    }

    public function getSpecialRails($hide = false)
    {
        return $this->format->getOrdinaryRails($this->specialRails, $hide);
    }

    public function getFastRails($hide = false)
    {
        return $this->format->getOrdinaryRails($this->fastRails, $hide);
    }

    public function getOtherRails($hide = false)
    {
        return $this->format->getOrdinaryRails($this->otherRails, $hide);
    }
}
