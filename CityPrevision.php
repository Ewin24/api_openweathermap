<?php

class CityPrevision
{
    private $data;

    public function __construct($data)
    {
        $this->listDays = $data->list; // days list with weather data
    }
    /**
     * To get day name in Spanish
     * @param int $numDay : day number
     * @return string : day name
    */
    private function getNameDay($numDay)
    {
        switch ($numDay) {
            case '0':
                return "Domingo";
                break;
            case '1':
                return "Lunes";
                break;
            case '2':
                return "Martes";
                break;
            case '3':
                return "Miércoles";
                break;
            case '4':
                return "Jueves";
                break;
            case '5':
                return "Viernes";
                break;
            case '6':
                return "Sábado";
                break;
        }
    }

    /**
     * To get days list with weather data
     * @return array : days weather
     */
    public function getList()
    {
        return $this->listDays;
    }

    /*public function findDateSec($index){
        $date = $this->listDays[$index]->dt;
        return $date;
    }*/

    /**
     * To get day and month in french
     * @param int $index : day index (forecast)
     * @return string : date
     */
    public function getDay($index)
    {
        $day = getDate($this->listDays[$index]->dt);
        return $this->getNameDay($day['wday']) . " " . $day['mday'];
    }

    /**
     * To get icon code picture of one day
     * @param int $index : day index (forecast)
     * @return string : icon code picture
     */
    public function getIconDay($index)
    {
        return ($this->listDays[$index]->weather[0]->icon);
    }

    /**
     * To get temperature in °C
     * @param int $index : day index (forecast)
     * @return string : temp °C
     */
    public function getTempC($index)
    {
        return ceil(($this->listDays[$index]->temp->day) - 273.15) . '°C';
    }
}
