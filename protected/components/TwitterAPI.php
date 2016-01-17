<?php 
class CekJadwal extends CApplicationComponent {
 
 public function simpan_tweet() {
			
 
			$level = Yii::app()->user->getState("level");
			$id_unit = Yii::app()->user->getState("unitkerja");
			$unit = Yii::app()->user->getState('namaunitkerja');
			
			$tahun = date('Y');
			$tw1start = date('Y-m-d',strtotime("01-01-$tahun"));
			$tw1end = date('Y-m-d',strtotime("31-03-$tahun"));
			
			$tw2start = date('Y-m-d',strtotime("01-04-$tahun"));
			$tw2end = date('Y-m-d',strtotime("30-06-$tahun"));
			
			$tw3start = date('Y-m-d',strtotime("01-07-$tahun"));
			$tw3end = date('Y-m-d',strtotime("30-09-$tahun"));
			
			$tw4start = date('Y-m-d',strtotime("01-10-$tahun"));
			$tw4end = date('Y-m-d',strtotime("31-12-$tahun"));
			
			$sekarang = date('Y-m-d');
		if($level != "superadmin")
		{
			if( $sekarang >= $tw1start && $sekarang <= $tw1end)
			{
			     $pkld = "tw1";
				 
				 $criteria = new CDbCriteria();
				 $criteria->condition = 'tw = :tw AND id_unit = :id_unit';
				 $criteria->params = array(':tw' => $pkld,':id_unit' => $id_unit);
				 $count = MasterProgram::model()->count($criteria);
				 
				$criteria = new CDbCriteria();
				 $criteria->condition = 'tw = :tw AND id_unit = :id_unit and progress=0';
				 $criteria->params = array(':tw' => $pkld,':id_unit' => $id_unit);
				 $count2 = MasterProgram::model()->count($criteria);
				 
				 
				 
				 
				 if($count == 0 or $count2 > 0 )
				 {
				    $hasil = "<b>$unit</b> belum input PKLD TW 1, Harap input secepatnya sebelum jatuh tempo !!";
				 }
					
			}
			if( $sekarang >= $tw2start && $sekarang <= $tw2end)
			{
			     $pkld = "tw2";
			
				 $criteria = new CDbCriteria();
				 $criteria->condition = 'tw = :tw AND id_unit = :id_unit';
				 $criteria->params = array(':tw' => $pkld,':id_unit' => $id_unit);
				 $count = MasterProgram::model()->count($criteria);
				 
				 $criteria = new CDbCriteria();
				 $criteria->condition = 'tw = :tw AND id_unit = :id_unit and progress=0';
				 $criteria->params = array(':tw' => $pkld,':id_unit' => $id_unit);
				 $count2 = MasterProgram::model()->count($criteria);
				 
				 
				 if($count == 0 or $count2 > 0 )
				 {
				    $hasil = "<b>$unit</b> belum input PKLD TW 2, Harap input secepatnya sebelum jatuh tempo !!";
				 }
			}
			if( $sekarang >= $tw3start && $sekarang <= $tw3end)
			{
			   $pkld = "tw3";
			   
				 $criteria = new CDbCriteria();
				 $criteria->condition = 'tw = :tw AND id_unit = :id_unit';
				 $criteria->params = array(':tw' => $pkld,':id_unit' => $id_unit);
				 $count = MasterProgram::model()->count($criteria);
				 
				 
				 $criteria = new CDbCriteria();
				 $criteria->condition = 'tw = :tw AND id_unit = :id_unit and progress=0';
				 $criteria->params = array(':tw' => $pkld,':id_unit' => $id_unit);
				 $count2 = MasterProgram::model()->count($criteria);
				 
				 
				 
				 if($count == 0 or $count2 > 0 )
				 {
				    $hasil = "<b>$unit</b> belum input PKLD TW 3, Harap input secepatnya sebelum jatuh tempo !!";
				 }
			}
			if( $sekarang >= $tw4start && $sekarang <= $tw4end)
			{
			   $pkld = "tw4";
			   
			     $criteria = new CDbCriteria();
				 $criteria->condition = 'tw = :tw AND id_unit = :id_unit';
				 $criteria->params = array(':tw' => $pkld,':id_unit' => $id_unit);
				 $count = MasterProgram::model()->count($criteria);
				 
					 $criteria = new CDbCriteria();
				 $criteria->condition = 'tw = :tw AND id_unit = :id_unit and progress=0';
				 $criteria->params = array(':tw' => $pkld,':id_unit' => $id_unit);
				 $count2 = MasterProgram::model()->count($criteria);
				 
				 
				 
				 
				 if($count == 0 or $count2 > 0 )
				 {
				   $hasil = "<b>$unit</b> belum input PKLD TW 4, Harap input secepatnya sebelum jatuh tempo !!";
				 }
			}
 
 
     return $hasil;
	 }
 }
 

}