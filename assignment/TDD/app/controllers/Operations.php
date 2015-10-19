<?php


class Operations {

     public function calculateStandardDeviation($j){

         return sqrt($this->calculateVariance($j));
     }

     public function calculateVariance($arr){

         try {
         $mean = $this->calculateMean($arr);
         $total = 0;
         $len = count($arr);

         //calculate variance
         foreach ( $arr as $i )
         {
             $temp = current($i);
             $temp -= $mean;
             $total += ( $temp * $temp );
         }

             return $total / $len;
         }
         catch(Exception $e){
             return;
         }
     }

     public function calculateMean($arr){

         try {
         $total = 0;
         $len = count($arr);

         foreach ( $arr as $i )
         {
             $total += current($i);
         }

             return $total / $len;
         }
         catch(Exception $e){
             return;
         }
     }

}
?>