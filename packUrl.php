<?php

class packUrl
{
    private $baseUrl = 'https://kyfw.12306.cn/otn/leftTicket/queryT?';
    private $urlParam = [];

    public function setDate($date)
    {
        $this->urlParam = array_merge($this->urlParam, ['leftTicketDTO.train_date' => $date]);
        return $this->urlParam;
    }

    public function setFromStation($station)
    {
        $this->urlParam = array_merge($this->urlParam, ['leftTicketDTO.from_station' => $station]);
        return $this->urlParam;
    }

    public function setToStation($station)
    {
        $this->urlParam = array_merge($this->urlParam, ['leftTicketDTO.to_station' => $station]);
        return $this->urlParam;
    }

    public function buildUrl()
    {
        $this->urlParam = array_merge($this->urlParam, ['purpose_codes' => 'ADULT']);
        return $this->baseUrl . http_build_query($this->urlParam); 
    }
}
