<?php
/**
 *@author  Xu Ding
 *@email   thedilab@gmail.com
 *@website http://www.StarTutorial.com
 **/
class Calendar {

    /**
     * Constructor
     */
    public function __construct(){
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    /********************* PROPERTY ********************/
    private $dayLabels = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");

    private $currentYear=0;

    private $currentMonth=0;

    private $currentDay=0;

    private $currentDate=null;

    private $daysInMonth=0;

    private $naviHref= null;
    private $idObjet=null;

    /********************* PUBLIC **********************/
    /**
     * @param int $id de l'objet
     * @return string
     */

    public function afficheCalendrierObjet($id)
    {
        $loc=new Location();
        $info=array("id_objet"=>$id,"statut_location"=>2);
        $this->idObjet=$id;
        $res=$loc->find($info);
        $c=array();

        function dateRange( $first, $last,&$array, $step = '+1 day', $format = 'Y-m-d' ) {

            $current = strtotime( $first );
            $last = strtotime( $last );

            while( $current <= $last ) {

                $array[] = date( $format, $current );
                $current = strtotime( $step, $current );
            }

        }
        foreach ($res as $k)
        {
            $d=date("Y-m-d",strtotime($k['date_debut']));
            $v=date("Y-m-d",strtotime($k['date_fin']));
            dateRange($d,$v,$c);
        }
        return $this->show($c);
    }
    /**
     * print out the calendar
     * @param array $color
     * @return string
     */
    public function show($color=array()) {
        $year  = null;

        $month = null;

        if(null==$year&&isset($_POST['year'])){

            $year = $_POST['year'];

        }else if(null==$year){

            $year = date("Y",time());

        }

        if(null==$month&&isset($_POST['month'])){

            $month = $_POST['month'];

        }else if(null==$month){

            $month = date("m",time());

        }

        $this->currentYear=$year;

        $this->currentMonth=$month;

        $this->daysInMonth=$this->_daysInMonth($month,$year);

        $content='<div class="box">'.
            $this->_createNavi().
            '</div>'.
            '<div class="box-content">'.
            '<ul class="label">'.$this->_createLabels().'</ul>';
        $content.='<div class="clear"></div>';
        $content.='<ul class="dates">';

        $weeksInMonth = $this->_weeksInMonth($month,$year);
        // Create weeks in a month
        for( $i=0; $i<$weeksInMonth; $i++ ){

            //Create days in a week
            for($j=1;$j<=7;$j++){
                if(in_array($year.'-'.$month.'-'.($i*7+$j),$color))
                {
                    $content .= $this->_showDay($i * 7 + $j, true);
                }else
                {
                    $content .= $this->_showDay($i * 7 + $j, false);
                }
            }
        }

        $content.='</ul>';

        $content.='<div class="clear"></div>';

        $content.='</div>';
        return $content;
    }

    /********************* PRIVATE **********************/
    /**
     * create the li element for ul
     * @param $cellNumber
     * @param bool $red
     * @return string
     */
    private function _showDay($cellNumber,$red){

        if($this->currentDay==0){

            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));

            if(intval($cellNumber) == intval($firstDayOfTheWeek)){

                $this->currentDay=1;

            }
        }

        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){

            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));

            $cellContent = $this->currentDay;

            $this->currentDay++;

        }else{

            $this->currentDate =null;

            $cellContent=null;
        }


        return '<li id="li-'.$this->currentDate.'" class="'.($red?"red":"").
            ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
    }

    /**
     * create navigation
     */
    private function _createNavi(){

        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;

        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;

        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;

        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;

        return
            '<div class="header">'.
            '<a class="prev" onClick="calendrier('.$preMonth.','.$preYear.')">Précédent</a>'.
            '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
            '<a class="next" onClick="calendrier('.$nextMonth.','.$nextYear.')">Suivant</a>'.
            '</div>';
    }

    /**
     * create calendar week labels
     */
    private function _createLabels(){

        $content='';

        foreach($this->dayLabels as $index=>$label){

            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';

        }

        return $content;
    }


    /**
     * calculate number of weeks in a particular month
     * @param null $month
     * @param null $year
     * @return int
     */
    private function _weeksInMonth($month=null,$year=null){

        if( null==($year) ) {
            $year =  date("Y",time());
        }

        if(null==($month)) {
            $month = date("m",time());
        }

        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);

        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);

        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));

        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));

        if($monthEndingDay<$monthStartDay){

            $numOfweeks++;

        }

        return $numOfweeks;
    }

    /**
     * calculate number of days in a particular month
     * @param null $month
     * @param null $year
     * @return false|string
     */
    private function _daysInMonth($month=null,$year=null){

        if(null==($year))
            $year =  date("Y",time());
        if(null==($month))
            $month = date("m",time());

        return date('t',strtotime($year.'-'.$month.'-01'));
    }

}