<?php  class cleanto_provider_off_day{		public $off_day_id;	public $user_id;	public $off_date;		public $lastmodify;	public $status;	public $conn;	public $table_name="ct_off_days";		public function add_off_day(){		$query="insert into `".$this->table_name."` (`id`,`user_id`,`off_date`,`lastmodify`,`status`) values(NULL,'".$this->user_id."','".$this->off_date."','".$this->lastmodify."','0')";		$result=mysqli_query($this->conn,$query);				return $result;	}		public function delete_off_day(){		$query="delete from `".$this->table_name."` where `user_id`='".$this->user_id."' and `off_date`='".$this->off_date."'";		$result=mysqli_query($this->conn,$query);		return $result;	}		public function select_date(){		$query="select * from `".$this->table_name."` where `user_id`='".$this->user_id."'";		$result=mysqli_query($this->conn,$query);		return $result;	}		public function countdate(){		$query="select count(`off_date`) as `total` from `".$this->table_name."` where `user_id`='".$this->user_id."' and `off_date`='".$this->off_date."'";		$result=mysqli_query($this->conn,$query);				$value=mysqli_fetch_array($result);				return $value;	}		function create_monthoff() {         global $wpdb;                $ym= explode("-",$this->off_year_month);        $year = $ym[0];        $month = $ym[1];        $month_size='';        if($month==1 || $month==3  || $month==5|| $month==7|| $month==8|| $month==10|| $month==12) { $month_size=31; }        if($month==4 || $month==6  || $month==9|| $month==11) { $month_size=30; }        if($month==2) { if($year%4==0) {$month_size=29; } else { $month_size=28; }}                for($i=1;$i<=$month_size;$i++) {            $offdate = $this->off_year_month.'-'.$i;            $result ="INSERT INTO `ct_off_days` (`id`, `user_id`, `off_date`, `lastmodify`, `status`) values (NULL,'" . $this->user_id . "', '" . $offdate . "', '".$this->lastmodify."','0')";            $value=mysqli_query($this->conn,$result);        }                        if ($value) {            echo "Inserted";            return true;        }else{            echo "Failed";            return false;        }            }		function delete_monthoff() {         global $wpdb;                $ym= explode("-",$this->off_year_month);        $year = $ym[0];        $month = $ym[1];        $month_size='';        if($month==1 || $month==3  || $month==5|| $month==7|| $month==8|| $month==10|| $month==12) { $month_size=31; }        if($month==4 || $month==6  || $month==9|| $month==11) { $month_size=30; }        if($month==2) { if($year%4==0) {$month_size=29; } else { $month_size=28; }}                        for($i=1;$i<=$month_size;$i++) {            $offdate = $this->off_year_month.'-'.$i;            $result ="delete FROM `ct_off_days` WHERE `user_id` = '" . $this->user_id . "' and `off_date` = '" . $offdate . "'";            $value=mysqli_query($this->conn,$result);                    }                        if ($value) {            echo "Deleted";            return true;        } else {            echo "Failed";            return false;        }    }		function check_full_month_off() {      	$ym= explode("-",$this->off_year_month);	$year = $ym[0];	$month = $ym[1];	$fullMonthSelected =  true;		$month_size='';	if($month==1 || $month==3  || $month==5|| $month==7|| $month==8|| $month==10|| $month==12) { $month_size=31; }	if($month==4 || $month==6  || $month==9|| $month==11) { $month_size=30; }	if($month==2) { if($year%4==0) {$month_size=29; } else { $month_size=28; }}	for($i=1;$i<=$month_size;$i++) {	$offdate = $this->off_year_month.'-'.$i;	$query = "select `id` FROM  `ct_off_days` WHERE `user_id` = '" . $this->user_id . "' and `off_date` = '" . $offdate . "'";	$result=mysqli_query($this->conn,$query);	$value=mysqli_fetch_array($result);	if(isset($value) && sizeof((array)$value)>0) {	} else {	$fullMonthSelected = false;	}	}	return $fullMonthSelected;	}	}?>